<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Coupon;
use App\Models\Domain;
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
        Permission::create(['name' => 'users.settings', 'description'=>'Usuarios menu' ])->assignRole($roleAdmin, $devMember);
        Permission::create(['name' => 'users.index', 'description'=>'Usuarios listado' ])->assignRole($roleAdmin, $devMember);
        Permission::create(['name' => 'users.create', 'description'=>'Usuarios crear' ])->assignRole($roleAdmin, $devMember);
        Permission::create(['name' => 'users.edit', 'description'=>'Usuarios editar' ])->assignRole($roleAdmin, $devMember);
        Permission::create(['name' => 'users.destroy', 'description'=>'Usuarios eliminar' ])->assignRole($roleAdmin, $devMember);

        Permission::create(['name' => 'roles.index', 'description'=>'Roles listado' ])->assignRole($roleAdmin, $devMember);
        Permission::create(['name' => 'roles.create', 'description'=>'Roles crear' ])->assignRole($roleAdmin, $devMember);
        Permission::create(['name' => 'roles.edit', 'description'=>'Roles editar' ])->assignRole($roleAdmin, $devMember);
        Permission::create(['name' => 'roles.destroy', 'description' => 'Roles eliminar'])->assignRole($roleAdmin, $devMember);

        Permission::create(['name' => 'permissions.index', 'description'=>'list permissions' ])->assignRole($roleAdmin, $devMember);
        Permission::create(['name' => 'permissions.create', 'description'=>'create permissions' ])->assignRole($roleAdmin, $devMember);
        Permission::create(['name' => 'permissions.edit', 'description'=> 'edit permissions' ])->assignRole($roleAdmin, $devMember);
        Permission::create(['name' => 'permissions.destroy', 'description'=> 'delete permissions' ])->assignRole($roleAdmin, $devMember);

        Permission::create(['name' => 'domains.index', 'description' => 'List/see Domains'])->assignRole($roleAdmin, $devMember);
        Permission::create(['name' => 'domains.create', 'description' => 'Create Domains'])->assignRole($roleAdmin, $devMember);
        Permission::create(['name' => 'domains.edit', 'description' => 'Edit Domains'])->assignRole($roleAdmin, $devMember);
        Permission::create(['name' => 'domains.destroy', 'description' => 'Delete Domains'])->assignRole($roleAdmin, $devMember);

        Permission::create(['name' => 'links.index', 'description' => 'List/see Links'])->assignRole($roleAdmin, $devMember, $salesMember);
        Permission::create(['name' => 'links.create', 'description' => 'Create Links'])->assignRole($roleAdmin, $devMember, $salesMember);
        Permission::create(['name' => 'links.edit', 'description' => 'Edit Links'])->assignRole($roleAdmin, $devMember, $salesMember);
        Permission::create(['name' => 'links.destroy', 'description' => 'Delete Links'])->assignRole($roleAdmin, $devMember, $salesMember);

        Permission::create(['name' => 'coupons.index', 'description' => 'List/see Coupons'])->assignRole($roleAdmin);
        Permission::create(['name' => 'coupons.create', 'description' => 'Create Coupons'])->assignRole($roleAdmin);
        Permission::create(['name' => 'coupons.edit', 'description' => 'Edit Coupons'])->assignRole($roleAdmin);
        Permission::create(['name' => 'coupons.destroy', 'description' => 'Delete Coupons'])->assignRole($roleAdmin);


        $userAdmin = User::create([
            'name'           => 'Admin',
            'email'          => 'juan.cardozo@ideaware.co',
            'password'       => bcrypt('admin'),
            //'active'         => 1,
        ])->assignRole($roleAdmin);

        $erick = User::create([
            'name'           => 'Erick Acevedo',
            'email'          => 'erick.acevedo@ideaware.co',
            'password'       => bcrypt('12345678'),
            //'active'         => 1,
        ])->assignRole($devMember);
        //])->assignRole($roleAsesor, $roleValidador);

        User::create([
            'name' => 'Daniel Barros',
            'email' => 'daniel.barros@bucket.io',
            'password' => bcrypt('12345678'),
            //'active'         => 1,
        ])->assignRole($devMember);


        User::create([
            'name' => 'Daniel Mantilla',
            'email' => 'daniel.mantilla@ideaware.co',
            'password' => bcrypt('12345678'),
            //'active'         => 1,
        ])->assignRole($salesMember);

        User::create([
            'name' => 'Jose Arcila',
            'email' => 'jose.arcila@ideaware.co',
            'password' => bcrypt('12345678'),
            //'active'         => 1,
        ])->assignRole($salesMember);



        Domain::create([
            'name' => 'askmethod.com',
            'ftp_url' => 'ftps://waws-prod-dm1-165.ftp.azurewebsites.windows.net/site/wwwroot',
            'ftp_user' => 'askmethod\$askmethod',
            'ftp_password' => 'LnWjscXYY4oulZRi63KyoD3evwa3pJFClEyMiZti3LMZB2xxwLReRB9rTxu1',
            'type' => 'Apache'
        ]);

        Domain::create([
            'name' => 'bucket.io',
            'ftp_url' => 'waws-prod-dm1-165.ftp.azurewebsites.windows.net/site/wwwroot',
            'ftp_user' => 'bucketio\$bucketio',
            'ftp_password' => 'Q50ZgLMlyThd8wAR09Qr8RoWTQfNkPStpjhjyE2K1xqq49zfb4RPjiRKbpc4',
            'type' => 'Apache'
        ]);

        Domain::create([
            'name' => 'quizfunnel.com',
            'ftp_url' => 'waws-prod-dm1-165.ftp.azurewebsites.windows.net/site/wwwroot',
            'ftp_user' => 'Quizfunnelworkshop\$Quizfunnelworkshop',
            'ftp_password' => 'cSPrDSNxwu232iPWobSrdNrqAjNfqgTrRfojBDuyvPAtfNzpDZqQapjYE30K',
            'type' => 'Apache'
        ]);

        Domain::create([
            'name' => 'theaskstore.com',
            'ftp_url' => 'waws-prod-dm1-165.ftp.azurewebsites.windows.net/site/wwwroot',
            'ftp_user' => 'getaskmethodclass\$getaskmethodclass',
            'ftp_password' => 'tMtWjniFA6DR5ieS7z1FeqqltkgXSxC3XG3WKZxB0MHy6rwY61CY0txrpThj',
            'type' => 'Apache'
        ]);



        Domain::create([
            'name'         => 'test.askmethod.com',
            'ftp_url'      => 'waws-prod-dm1-165.ftp.azurewebsites.windows.net/site/wwwroot',
            'ftp_user'     => 'testaskmethod\$testaskmethod',
            'ftp_password' => 'nmRRdd5D8aBujF06dQeMBqRsFX0mgWZwRvf1lRm9ce9xj3nYF3Ym2amRb1rd',
            'type' => 'Nginx'     
        ]);

        Domain::create([
            'name' => 'HybridExpert.com',
            'ftp_url' => 'waws-prod-dm1-165.ftp.azurewebsites.windows.net/site/wwwroot',
            'ftp_user' => 'HybridExpert\$HybridExpert',
            'ftp_password' => 'YluS8Xv3G10XMvczj2sbSSS5knqlr0DlwxnsekSjZo8t6bsf5pBZSnCyP07k',
            'type' => 'Nginx'
        ]);

        Domain::create([
            'name' => 'asktxt.me',
            'ftp_url' => 'ftps://waws-prod-dm1-165.ftp.azurewebsites.windows.net/site/wwwroot',
            'ftp_user' => 'asktxt\$asktxt',
            'ftp_password' => 'jjsM2rcjatMnJYr2fgxpCQHiw1QKsemitRELP4rMReJ5KfwwTG3PPoSdAA5J',
            'type' => 'Nginx'
        ]);

        Coupon::create([
            'name' => 'AskMet',
            'discount' => 100,
            'description' => 'using for testing of the devTeam',
            'limit' => 200
        ]);
        Coupon::create([
            'name' => '30off',
            'discount' => 30,
            'description' => 'gives you 30 usd OFF',
            'limit' => 3000
        ]);



    }//run

}//class
