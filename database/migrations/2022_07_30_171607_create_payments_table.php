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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('kosan_id');
            $table->unsignedBigInteger('kamar_id');
            $table->unsignedBigInteger('user_id');
            $table->date('date_pay');
            $table->integer('price_room');
            $table->integer('pay_amount');
            $table->integer('leftover');
            $table->integer('change');
            $table->enum('type_order', ['DP', 'Lunas']);
            $table->string('image');
            $table->enum('status', ['Confirmed', 'On Reviewed', 'Rejected']);
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kosan_id')->references('id')->on('kosans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kamar_id')->references('id')->on('kamars')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
