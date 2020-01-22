<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications',function (Blueprint $table){
                $table->string('status');
                $table->string('filename');     //subject to change depending on storage of applications
                $table->timestamps();
           	$table->unsignedBigInteger('driver_id');
                $table->unsignedBigInteger('sponsor_id');
                $table->foreign('sponsor_id')->references('id')->on('sponsors')->onDelete('cascade');
                $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
