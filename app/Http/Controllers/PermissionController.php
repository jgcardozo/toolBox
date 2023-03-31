<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function __construct()
    {
        /*
        $this->middleware('can:permissions.index')->only('index');
        $this->middleware('can:permissions.create')->only('create', 'store');
        $this->middleware('can:permissions.edit')->only('edit', 'update');
        $this->middleware('can:permissions.destroy')->only('destroy'); */
    } //construct

    public function index()
    { 
        $permissions = Permission::orderBy('name', 'asc')->paginate(20);
        return view('permissions.index', compact('permissions'));
    } //index



    public function create()
    {
        $permissions = Permission::get();
        return view('permissions.create');
    } //create



    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:50|unique:permissions,name',
            'description' => 'required',
        ]);

        $fields = $request->all();
        $fields['guard_name'] = 'web';
        Permission::Create($fields);
      
        return redirect()->route('permissions.index')
            ->with('info', 'Permission has been created');

    } //store



    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit', compact('permission'));
    } //edit




    public function update(Request $request, Permission $permission)
    {

        $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:50',
        ]);

        $permission->update($request->all());

        return redirect()->route('permissions.index')
            ->with('info', 'Permission has been updated.');

    } //update

    public function destroy(Permission $perm)
    {
        $perm->delete();
        return redirect()->route('permissions.index')->with('info', 'Permission has been deleted');
    } //destroy

} //class
