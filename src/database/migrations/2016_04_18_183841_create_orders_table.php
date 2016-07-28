<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('date');
            //$table->string('who maked');
            $table->decimal('total', 10, 2);
            $table->decimal('Shipping', 10, 2);
            $table->decimal('total_shipping', 10, 2);
            $table->decimal('user_discount', 10, 2);
            $table->decimal('grand_total', 10, 2);
            $table->integer('validation')->default(0);
            $table->integer('cancel')->default(0);
            $table->integer('delivered')->default(0);
            $table->string('note');
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
        Schema::drop('orders');
    }
}
