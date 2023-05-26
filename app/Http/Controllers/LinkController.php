<?php

namespace App\Http\Controllers;

use App\Traits\UrlValid;
use App\Classes\FtpServers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;
use App\Models\Link;
use App\Models\Domain;

class LinkController extends Controller
{
    use UrlValid;
    private $ftp;

    public function __construct(FtpServers $ftp)
    {
        $this->ftp = $ftp;
        $this->middleware('can:links.index')->only('index');
        $this->middleware('can:links.create')->only('create', 'store');
        $this->middleware('can:links.edit')->only('edit', 'update');
        $this->middleware('can:links.destroy')->only('destroy');
    }



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


    public function htproceso($domain)
    {
       //'askmethod.com'    230419-15:39       403 records
       //'bucket.io'        230419-17:52       419 records   421
       //'quizfunnel.com'   230420-09:00       653 records   655
       //'theaskstore.com'  230420-                          657 solo tenia 2                
       $this->ftp->htproceso($domain);
    } //htproceso

} //class
