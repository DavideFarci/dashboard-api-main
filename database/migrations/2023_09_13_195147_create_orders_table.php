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
            $table->string('name', 50);
            $table->string('phone', 20);
            $table->string('email', 100);
            $table->string('message', 1000)->nullable();
            $table->unsignedBigInteger('total_price')->default(0);
            $table->smallInteger('total_pz');
            $table->string('date_slot', 16);
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
