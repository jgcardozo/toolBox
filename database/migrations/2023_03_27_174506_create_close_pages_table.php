<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClosePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('close_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domain_id')->references('id')->on('domains')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('url');
            $table->string('alias', 20)->nullable();
            $table->dateTime('close_time');
            $table->bigInteger('close_timestamp');
            $table->string('code_old');
            $table->string('code_new');
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
        Schema::dropIfExists('close_pages');
    }
}
