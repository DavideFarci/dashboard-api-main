<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('status', 100)->nullable();
            $table->string('total_price', 100)->nullable();
            $table->string('time', 30)->nullable();
            $table->string('date', 30)->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
