<?php

namespace Database\Seeders;

use App\Models\Domain;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class GeneralSeeder extends Seeder
{
   
    public function run()
    {

        $roleAdmin   = Role::create(['name' => 'Admin' ,'description'=>'Admin System has access to all the menus and options' ]);
        $devMember   = Role::create(['name' => 'DevMember' ,'description'=>'Can manage Roles, users, and Domains' ]);
        $salesMember = Role::create(['name' => 'SalesMember', 'description' => 'Can manage Links']);
        //$customServiceMember = Role::create(['name' => 'CustomerServiceMember' ,'description'=>'Just can list/see Shorten Links' ]);

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

        Permission::create(['name' => 'permissions.index', 'description'=>'list permissions' ])->assignRole($roleAdmin);
        Permission::create(['name' => 'permissions.create', 'description'=>'create permissions' ])->assignRole($roleAdmin);
        Permission::create(['name' => 'permissions.edit', 'description'=> 'edit permissions' ])->assignRole($roleAdmin);
        Permission::create(['name' => 'permissions.destroy', 'description'=> 'delete permissions' ])->assignRole($roleAdmin);

        Permission::create(['name' => 'domains.index', 'description' => 'List/see Domains'])->assignRole($roleAdmin);
        Permission::create(['name' => 'domains.create', 'description' => 'Create Domains'])->assignRole($roleAdmin);
        Permission::create(['name' => 'domains.edit', 'description' => 'Edit Domains'])->assignRole($roleAdmin);
        Permission::create(['name' => 'domains.destroy', 'description' => 'Delete Domains'])->assignRole($roleAdmin);

        Permission::create(['name' => 'links.index', 'description' => 'List/see Links'])->assignRole($roleAdmin, $salesMember);
        Permission::create(['name' => 'links.create', 'description' => 'Create Links'])->assignRole($roleAdmin, $salesMember);
        Permission::create(['name' => 'links.edit', 'description' => 'Edit Links'])->assignRole($roleAdmin, $salesMember);
        Permission::create(['name' => 'links.destroy', 'description' => 'Delete Links'])->assignRole($roleAdmin, $salesMember);


        $userAdmin = User::create([
            'name'           => 'Admin',
            'email'          => 'juan.cardozo@ideaware.co',
            'password'       => bcrypt('admin'),
            //'active'         => 1,
        ])->assignRole($roleAdmin);

        $erick = User::create([
            'name'           => 'Erick Acevedo',
            'email'          => 'erick.acevedo@ideaware.co',
            'password'       => bcrypt('Warzone'),
            //'active'         => 1,
        ])->assignRole($devMember);
        //])->assignRole($roleAsesor, $roleValidador);

        User::create([
            'name' => 'Kristin',
            'email' => 'kristin@ideaware.co',
            'password' => bcrypt('12345678'),
            //'active'         => 1,
        ])->assignRole($salesMember);


        Domain::create([
            'name'         => 'test.askmethod.com',
            'ftp_url'      => 'waws-prod-dm1-165.ftp.azurewebsites.windows.net/site/wwwroot',
            'ftp_user'     => 'testaskmethod\$testaskmethod',
            'ftp_password' => 'nmRRdd5D8aBujF06dQeMBqRsFX0mgWZwRvf1lRm9ce9xj3nYF3Ym2amRb1rd',
            'type' => 'Nginx'     
        ]);

        Domain::create([
            'name' => 'bucket.io',
            'ftp_url' => 'waws-prod-dm1-165.ftp.azurewebsites.windows.net/site/wwwroot',
            'ftp_user' => 'bucketio\$bucketio',
            'ftp_password' => 'Q50ZgLMlyThd8wAR09Qr8RoWTQfNkPStpjhjyE2K1xqq49zfb4RPjiRKbpc4',
            'type' => 'Apache'
        ]);

        Domain::create([
            'name' => 'HybridExpert.com',
            'ftp_url' => 'waws-prod-dm1-165.ftp.azurewebsites.windows.net/site/wwwroot',
            'ftp_user' => 'HybridExpert\$HybridExpert',
            'ftp_password' => 'YluS8Xv3G10XMvczj2sbSSS5knqlr0DlwxnsekSjZo8t6bsf5pBZSnCyP07k',
            'type' => 'Nginx'
        ]);


    }//run



}//class
