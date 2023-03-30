<?php

namespace App\Http\Controllers;

use App\Classes\FtpServers;
use App\Models\Domain;
use App\Models\Link;
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

    public function index()
    {
        /*
        $links = Link::orderBy('updated_at','desc')->get();
        return view('links.index', compact('links'));*/
        return view('livewire.links.index');
    }//index
  
    public function create()
    {
        $domains = Domain::orderBy('name','asc')->get();
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
        
        if ($this->ftp->aliasExists($request->domain_id, $request->alias, $request->long_url)){
            $message = "[$request->alias] redirect was not created because already exists";
        }else{
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
        $fields['user_id'] = Auth::user()->id;
        $fields['long_url'] = $request->long_url;
        $this->ftp->crudAlias($request->alias, $request->long_url, $link->domain_id, 'update');
        $this->ftp->close();
        $link->update($fields);
        return redirect()->route('links.index')->with('info', 'Link has been Updated Successfully');
    } //update


    public function destroy(Link $link)
    {   
        $this->ftp->crudAlias($link->alias, $link->long_url, $link->domain_id, 'delete');
        $this->ftp->close();
        $link->delete();
        return redirect()->route('links.index')->with('info', 'Link has been deleted');
    }//destroy

}//class