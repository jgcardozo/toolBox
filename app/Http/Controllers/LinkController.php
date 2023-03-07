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
    }

    public function index()
    {
        $links = Link::orderBy('updated_at','desc')->get();
        return view('links.index', compact('links'));
    }//index
  
    public function create()
    {
        $domains = Domain::all();
        return view('links.create', compact('domains'));
    } //create


    public function store(Request $request)
    {
        $request->validate([
            'domain_id' => 'required|not_in:0',
            'long_url' => 'required|min:20',
            'alias' => 'required|min:3',        
        ]);

        $fields = $request->only(['domain_id', 'long_url', 'alias', 'short_url']);
        $fields['user_id'] = Auth::user()->id;
        $fields['short_url'] = $request->short_url;
        Link::create($fields);
        $this->ftp->aliasExists($request->domain_id, trim($request->alias), $request->long_url);
        $this->ftp->close();
        return redirect()->route('links.index')->with('info', 'created successfully');
    } //store


    public function edit(Link $link)
    {
        return view('links.edit', compact('link'));
    }


    public function update(Request $request, Link $link)
    {
        $request->validate([
            'alias' => 'required|min:3',
        ]);
        $fields['user_id'] = Auth::user()->id;
        $fields['long_url'] = $request->long_url;
        $link->update($fields);
        $this->ftp->aliasExists($link->domain_id, trim($request->alias), $request->long_url);
        $this->ftp->close();
        return redirect()->route('links.index')->with('info', 'Link has been Updated Successfully');
    } //update


    public function destroy(Link $link)
    {
        $link->delete();
        $this->ftp->deleteAlias($link->domain_id, $link->alias);
        $this->ftp->close();
        return redirect()->route('links.index')->with('info', 'Link has been deleted');
    }//destroy

}//class
