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
        Schema::create('room_actives', function (Blueprint $table) {
            $table->id();
            $table->integer('owner_id');
            $table->integer('kosan_id');
            $table->integer('kamar_id');
            $table->integer('user_id');
            $table->enum('status', ['Active']);
            $table->date('date_in');
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
        Schema::dropIfExists('room_actives');
    }
};
