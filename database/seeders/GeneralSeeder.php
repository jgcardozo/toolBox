<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\User;
use App\Models\Brand;
use Illuminate\Database\Seeder;
use App\Models\IdentificationType;
use App\Models\ProductType;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class GeneralSeeder extends Seeder
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

        Permission::create(['name' => 'clients.index', 'description' => 'Clientes listado'])->assignRole($roleAdmin);
        Permission::create(['name' => 'clients.create', 'description' => 'Clientes crear'])->assignRole($roleAdmin);
        Permission::create(['name' => 'clients.edit', 'description' => 'Clientes editar'])->assignRole($roleAdmin);
        Permission::create(['name' => 'clients.destroy', 'description' => 'Clientes eliminar'])->assignRole($roleAdmin);

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

        City::create(['description' => 'Cali']);
        City::create(['description' => 'Yumbo']);
        City::create(['description' => 'La Cumbre']);
        City::create(['description' => 'Mulalo']);
        City::create(['description' => 'Vijes']);
        City::create(['description' => 'Jamundi']);
        City::create(['description' => 'Palmira']);
        City::create(['description' => 'Candelaria']);
        City::create(['description' => 'Rozo']);
        City::create(['description' => 'Dagua']);
        City::create(['description' => 'El Cerrito']);
        City::create(['description' => 'Florida']);
        City::create(['description' => 'Pradera']);

        IdentificationType::create(['description' => 'Cedula Ciudadania']);
        IdentificationType::create(['description' => 'Nit']);
        IdentificationType::create(['description' => 'Pasaporte']);
        IdentificationType::create(['description' => 'Cedula Extranjeria']);
        IdentificationType::create(['description' => 'Contraseña']);
        IdentificationType::create(['description' => 'Tarjeta de Identidad']);
        IdentificationType::create(['description' => 'Registro Civil']);

        ProductType::create(['description' => 'SmartPhone']);
        ProductType::create(['description' => 'SmartWatch']);
        ProductType::create(['description' => 'Laptop']);
        ProductType::create(['description' => 'Consola']);
        ProductType::create(['description' => 'Estereo']);
        ProductType::create(['description' => 'Tablet']);
        ProductType::create(['description' => 'Accesorio']);
        ProductType::create(['description' => 'SmartTv']);
 

        Brand::create(['description' => 'Apple']);
        Brand::create(['description' => 'Motorola']);
        Brand::create(['description' => 'Samsung']);
        Brand::create(['description' => 'Huawei']);
        Brand::create(['description' => 'Xiaomi']);
        Brand::create(['description' => 'Krip']);
        Brand::create(['description' => 'Vivo']);
        Brand::create(['description' => 'Sony']);
        Brand::create(['description' => 'Xbox']);
        Brand::create(['description' => 'Nintendo']);

        
        /*
        $table->string('reference')->nullable();
        $table->string('reference2')->nullable();
        $table->string('description');
        $table->double('price', 15, 2);
        $table->string('photo1')->nullable();
        $table->string('photo2')->nullable();
        $table->string('photo3')->nullable(); //cambiar a morph tambien la tabla clients 
        $table->foreignId('producttype_id')->references('id')->on('product_types')->onDelete('cascade');
        $table->foreignId('brand_id')->references('id')->on('brands')->onDelete('cascade');
        */
    }//run



}//class
