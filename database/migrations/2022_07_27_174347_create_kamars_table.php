<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('kosan_id');
            $table->string('name');
            $table->integer('total_room');
            $table->integer('room_filled');
            $table->integer('room_available');
            $table->integer('price');
            $table->text('description');

            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade');
            $table->foreign('kosan_id')->references('id')->on('kosans')->onDelete('cascade');

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
        Schema::dropIfExists('kamars');
    }
};
