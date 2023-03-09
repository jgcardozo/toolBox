<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function index(){
        $domains = Domain::all();
        return view('domains.index', compact('domains'));
    }


    public function create()
    {
        return view('domains.create');
    } //create


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:6|max:30|unique:domains',
            'ftp_url' => 'required|min:20',
            'ftp_user' => 'required|min:10',
            'ftp_password' => 'required|min:10',
            'type' => 'required|not_in:0',
        ]);
        // str_replace( ) 'ftp://' 'ftps://'   '/site/wwwroot'
                Domain::create($request->only(['name', 'ftp_url','ftp_user', 'ftp_password', 'type']) );
        return redirect()->route('domains.index')->with('info', 'created successfully');   
    } //store


    public function edit(Domain $domain)
    {
        return view('domains.edit', compact('domain'));
    }


    public function update(Request $request, Domain $domain)
    {
        $request->validate([
            'name' => 'required|min:6|max:30',
            'ftp_url' => 'required|min:20',
            'ftp_user' => 'required|min:10',
            'ftp_password' => 'required|min:10',
            'type' => 'required|not_in:0',
        ]);
        $domain->update($request->only(['name', 'ftp_url', 'ftp_user', 'ftp_password', 'type']) );
        return redirect()->route('domains.index')->with('info', 'Domain has been Updated Successfully');
    } //update


    public function destroy(Domain $domain)
    {
        $domain->delete();
        return redirect()->route('domains.index')->with('info', 'Domain has been deleted');
    }//destroy


}//class
