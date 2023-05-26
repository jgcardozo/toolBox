<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('description')->nullable(); //replace notes
            $table->boolean('actived')->default(1);
            $table->boolean('deleted')->default(0);
            $table->mediumInteger('limit')->nullable();
            $table->mediumInteger('discount')->nullable();
            $table->string('type', 100)->nullable();
            $table->timestamp('available_until')->default(Carbon::now()->addYear());
            //$table->unsignedBigInteger('coupondetail_id');
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
        Schema::dropIfExists('coupons');
    }
}
