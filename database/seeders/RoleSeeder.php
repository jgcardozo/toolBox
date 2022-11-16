<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
   
    public function run()
    {

        $roleAdmin  = Role::create(['name' => 'Admin' ,'description'=>'Admin System has access to all the menus and options' ]);
        $roleAsesor = Role::create(['name' => 'Asesor Interno' ,'description'=>'Puede hacer cotizaciones' ]);
        $roleAsesorE = Role::create(['name' => 'Asesor Externo', 'description' => 'Se le pagan comisiones, % sobre la venta']);
        $roleValidador = Role::create(['name' => 'Validador' ,'description'=>'Valida documentación de credito' ]);

        //Permission::create(['name' => 'dashboard'])->syncRoles([$roleAdmin, $roleAsesor, $roleValidador]);
        Permission::create(['name' => 'users.settings', 'description'=>'Usuarios menu' ])->assignRole($roleAdmin);
        Permission::create(['name' => 'users.index', 'description'=>'Usuarios listado' ])->assignRole($roleAdmin);
        Permission::create(['name' => 'users.create', 'description'=>'Usuarios crear' ])->assignRole($roleAdmin);
        Permission::create(['name' => 'users.edit', 'description'=>'Usuarios editar' ])->assignRole($roleAdmin);
        Permission::create(['name' => 'users.destroy', 'description'=>'Usuarios eliminar' ])->assignRole($roleAdmin);

        Permission::create(['name' => 'roles.index', 'description'=>'Roles listado' ])->assignRole($roleAdmin);
        Permission::create(['name' => 'roles.create', 'description'=>'Roles crear' ])->assignRole($roleAdmin);
        Permission::create(['name' => 'roles.edit', 'description'=>'Roles editar' ])->assignRole($roleAdmin);
        Permission::create(['name' => 'roles.destroy', 'description' => 'Roles eliminar'])->assignRole($roleAdmin);

        /*
        Permission::create(['name' => 'permissions.index', 'description'=>'des' ])->assignRole($roleAdmin);
        Permission::create(['name' => 'permissions.create', 'description'=>'des' ])->assignRole($roleAdmin);
        Permission::create(['name' => 'permissions.edit', 'description'=>'des' ])->assignRole($roleAdmin);
        Permission::create(['name' => 'permissions.destroy', 'description'=>'des' ])->assignRole($roleAdmin);
        */

        Permission::create(['name' => 'products.index', 'description'=>'Productos listado' ])->assignRole($roleAdmin);


        $userAdmin = User::create([
            'name'           => 'AdminCrm',
            'email'          => 'admin@gmail.com',
            'password'       => bcrypt('admin'),
            //'active'         => 1,
        ])->assignRole($roleAdmin);
        $user1 = User::create([
            'name'           => 'Lina Cardozo',
            'email'          => 'lina@gmail.com',
            'password'       => bcrypt('12345678'),
            //'active'         => 1,
        ])->assignRole($roleAsesor, $roleValidador);

    }//run




}//class
