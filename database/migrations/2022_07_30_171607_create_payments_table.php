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
            $table->integer('owner_id');
            $table->integer('kosan_id');
            $table->integer('kamar_id');
            $table->integer('user_id');
            $table->date('date_pay');
            $table->integer('price_room');
            $table->integer('pay_amount');
            $table->integer('leftover');
            $table->integer('change');
            $table->enum('type_order', ['DP', 'Lunas']);
            $table->string('image');
            $table->enum('status', ['Confirmed', 'On Reviewed', 'Rejected']);
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
        Schema::dropIfExists('payments');
    }
};
