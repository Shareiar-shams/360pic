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
        Schema::create('datetimepickers', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->nullable();
            $table->string('username')->nullable();
            $table->string('date');
            $table->string('time');
            $table->string('datetime_id');
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
        Schema::dropIfExists('datetimepickers');
    }
};
