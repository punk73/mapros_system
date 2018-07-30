<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ticket_no_master');
            $table->string('guid_master')->nullable();
            $table->string('status');
            $table->integer('scanner_id');
            $table->string('scan_nik');
            $table->string('model_name');
            $table->string('serial_no')->nullable();
            $table->string('judge')->default('OK');
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
        Schema::dropIfExists('masters');
    }
}
