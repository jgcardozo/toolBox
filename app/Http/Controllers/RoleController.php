<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    protected $paginationTheme = "bootstrap";
    
    public function index()
    {
        $roles = Role::orderBy('name', 'Asc')->get(); 
        return view('roles.index', compact('roles'));
    }//index

   
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));   
    }//create

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:6|max:30',
            'description' => 'required|min:10',
        ]);
      
        $newRole = Role::create($request->only(['name','description']));
        $newRole->permissions()->sync($request->permissions); 
        return redirect()->route('roles.index')->with('info', 'Creado con exito');
    }//store

   
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

  
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|min:6|max:30',
            'description' => 'required|min:10',
        ]);
        $role->update($request->only(['name', 'description']));
        $role->permissions()->sync($request->permissions);
        return redirect()->route('roles.index')->with('info', 'Actualizado con exito');
    }//update

    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }
   
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('info', 'Se ha eliminado el Role'); 
    }//destroy


}//class
