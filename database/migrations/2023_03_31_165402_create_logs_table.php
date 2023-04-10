<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('action', 20);
            $table->string('keyword', 100); //column keyword at that model . ie: links ->alias
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('json_old');
            $table->text('json_new')->nullable();
            $table->unsignedBigInteger('logable_id');
            $table->string('logable_type');
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
        Schema::dropIfExists('logs');
    }
}
