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
        //$pass = bcrypt('Wg6wKx!%10jW'); //crhis
        //$pass = bcrypt('egE7M0o0&^Dx'); //romm
        //$pass = bcrypt('Tb@#Zv,rV5:,'); //richard

        /*
        $pass = bcrypt('e9L4VD++T$sy'); //kristin 
        $pass = bcrypt('8)nzWRQ]"]gu'); //dani 
        $pass = bcrypt('yuae96+yXS8A'); //heba 
        $pass = bcrypt('WFJ89HrH8@T+'); //suzane
        */
       // $pass = bcrypt('<v8B-zqj$6DZ'); //tracy
       // $pass = bcrypt('n@LK?[2]^kyZ'); //meghan
       // dd($pass);
        return view('livewire.users.index');
    }//index

    public function edit(User $user){
        $roles = Role::all();
        return view('livewire.users.edit', compact('user', 'roles'));
    }//edit

    public function update(Request $request, User $user){
        $request->validate([
            'name' => 'required|min:4|max:40',
        ]);
        $user->update($request->only(['name']));
        $user->roles()->sync($request->roles);
        return redirect()->route('users.index')->with('info', 'User has been Updated');
    }//update


    public function create(){
        $roles = Role::all();
        return view('livewire.users.create', compact('roles'));
    }//create

    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:4|max:40',
            'email' => 'required|email',
            //'password' => 'required|min:8',
        ]);

        //$newUser = User::create($request->only(['name', 'email']));
        $newUser = new User();
        $newUser->name     = $request->name;
        $newUser->email    = $request->email;
        $newUser->password = bcrypt('12345678');
        $newUser->save();
        $newUser->roles()->sync($request->roles);
        return redirect()->route('users.index')->with('info', 'User has been Created');
    } //store

    public function destroy(User $user)
    {
        //$user->delete();
        $que = $user->active ?  'disabled':'enabled';
        $user->active = !$user->active;
        $user->save(); 
        return redirect()->route('users.index')->with('info', "You have {$que} access to {$user->name} - {$user->email}");
    }//destroy

    public function show()
    {
    }//show





}//class
