<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Link;
use App\Models\Domain;
use App\Classes\FtpServers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{

    private $ftp;

    public function __construct(FtpServers $ftp)
    {
        $this->ftp = $ftp;
        /*
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.create')->only('create', 'store');
        $this->middleware('can:users.edit')->only('edit', 'update');
        $this->middleware('can:users.destroy')->only('destroy');  */
    }

    private function urlValid($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode == 0 || $httpcode == 404) {
            return false;
        } else {
            return true;
        }

    } //urlValid

    public function index()
    {
        $logs = Log::where('logable_type', 'App\Models\Link')->get();;
        return view('livewire.links.index', compact('logs'));
    } //index

    public function create()
    {
        $domains = Domain::orderBy('name', 'asc')->get();
        return view('livewire.links.create', compact('domains'));
    } //create


    public function store(Request $request)
    {
        $request->validate([
            'domain_id' => 'required|not_in:0',
            'long_url' => 'required|min:20',
            'alias' => 'required|min:2',
        ]);

        //https://stackoverflow.com/questions/1239068/ping-site-and-return-result-in-php

        $fields = $request->only(['domain_id', 'long_url', 'alias', 'short_url']);
        $fields['user_id'] = Auth::user()->id;
        $fields['short_url'] = $request->short_url;


        if (!$this->urlValid($request->long_url)) {
            $message = "[$request->alias] redirect was not created because destinationUrl $request->long_url is not valid";
            return redirect()->route('links.index')->with('info', $message);
        } //if urlValid 

        if ($this->ftp->aliasExists($request->domain_id, $request->alias, $request->long_url)) {
            $message = "[$request->alias] redirect was not created because already exists";
        } else {
            $this->ftp->crudAlias($request->alias, $request->long_url, $request->domain_id, 'create');
            Link::create($fields);
            $message = 'created successfully';
        }
        $this->ftp->close();
        return redirect()->route('links.index')->with('info', $message);
    } //store


    public function edit(Link $link)
    {
        return view('livewire.links.edit', compact('link'));
    }


    public function update(Request $request, Link $link)
    {
        $request->validate([
            'alias' => 'required|min:2',
        ]);
        

        if (!$this->urlValid($request->long_url)) {
            $message = "[$request->alias] redirect was not updated because destinationUrl $request->long_url is not valid";
        } //if urlValid 
        else {
            if($link->long_url != $request->long_url){
                $fields['user_id'] = Auth::user()->id;
                $fields['long_url'] = $request->long_url;
    
                $log = new Log();
                $log['action'] = 'updated';
                $log['user_id'] = $fields['user_id'];
                $log['keyword'] = strtolower(trim($request->alias));
                $log['json_old'] = "LongUrl: $link->long_url";
                $log['json_new'] = "LongUrl: $request->long_url";
                $log->logable()->associate($link);
                $log->save();

                $this->ftp->crudAlias($request->alias, $request->long_url, $link->domain_id, 'update');
                $this->ftp->close();
                $link->update($fields);
            }
            $message = 'Link has been Updated Successfully';
        }
        return redirect()->route('links.index')->with('info', $message);
    } //update


    public function destroy(Link $link)
    {
        //https://www.larashout.com/laravel-collection-using-tojson-method
        //https://es.stackoverflow.com/questions/567674/log-de-modificaciones-en-laravel
        //dd($link->toJson(JSON_PRETTY_PRINT));
        //soft delete = https://codeanddeploy.com/blog/laravel/complete-laravel-8-soft-delete-restore-deleted-records-tutorial


        $log = new Log();
        $log['action'] = 'deleted';
        $log['json_old'] = $link->toJson();
        $log->logable()->associate($link);
        $log->save();

        /*
        $fields['json_old']=''; 
        $log = Log::create($fields);
        */





        /*
        $this->ftp->crudAlias($link->alias, $link->long_url, $link->domain_id, 'delete');
        $this->ftp->close(); 
        $link->delete();
        return redirect()->route('links.index')->with('info', 'Link has been deleted');
        */
    } //destroy

} //class
