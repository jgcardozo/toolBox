<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //realmente debe ser table modelo, pero por ahora se llamara producto
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->nullable();
            $table->string('reference2')->nullable();
            $table->string('description');
            $table->double('price', 15, 2);
/*             $table->string('photo1')->nullable();
            $table->string('photo2')->nullable();
            $table->string('photo3')->nullable(); //cambiar a morph tambien la tabla clients  */
            $table->foreignId('producttype_id')->references('id')->on('product_types')->onDelete('cascade');
            $table->foreignId('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
