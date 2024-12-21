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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('additional_info')->nullable();
            $table->text('desc');
            $table->string('slug')->unique();
            $table->string('SKU')->unique();
            $table->string('display_image');
            $table->string('additional_image')->nullable();
            $table->double('price');
            $table->double('special_price')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->text('meta_desc')->nullable();
            $table->string('fst_additional_btn')->nullable();
            $table->string('fst_btn_content')->nullable();
            $table->string('snd_additional_btn')->nullable();
            $table->string('snd_btn_content')->nullable();
            $table->string('trd_additional_btn')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('products');
    }
};
