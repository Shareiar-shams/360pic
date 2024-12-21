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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->float('subtotal');
            $table->integer('order_quantity');
            $table->float('total');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->string('tracking_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('billing_area');
            $table->string('work_area');
            $table->string('addressline')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->text('special_note')->nullable();
            $table->text('short_answer')->nullable();
            $table->enum('order_status',['Default','Pending','Processing_Order','Delivery_in_progess','Received','Canceled'])->default('Default');
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
        Schema::dropIfExists('orders');
    }
};
