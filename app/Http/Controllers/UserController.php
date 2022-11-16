<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.create')->only('create', 'store');
        $this->middleware('can:users.edit')->only('edit','update');
        $this->middleware('can:users.destroy')->only('destroy');
    }//construct
    
    public function index(){  
        return view('users.index');
    }//index

    public function edit(User $user){
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }//edit

    public function update(Request $request, User $user){
        return $request;
        $user->roles()->sync($request->roles);
        return redirect()->route('users.index')->with('info', 'Guardado Exitosamente');
    }//update


    public function create(){

    }

    public function store(){

    }

    public function destroy(User $user){

    }





}//class
