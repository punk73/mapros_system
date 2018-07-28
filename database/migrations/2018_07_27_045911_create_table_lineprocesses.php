<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLineprocesses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lineprocesses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('type')->default(1); //internal =1; external=2; chamber=3
            $table->integer('endpoint_id')->nullable(); 
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
        Schema::dropIfExists('lineprocesses');
    }
}
