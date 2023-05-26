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
            $table->string('url_page');
            $table->string('url_waitlist')->nullable();
            $table->timestamp('close_at');
            $table->string('timezone',30)->default('America/Chicago');
            $table->boolean('done')->default(0);
            $table->text('code_old')->nullable();
            $table->text('code_new')->nullable();
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
