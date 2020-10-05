<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->id('id_category');
            $table->bigInteger('id_parent')->default(0)->nullable();
            $table->string('code')->unique();
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->integer('sort_order')->default(0);
            $table->integer('level')->default(0);
            $table->boolean('status');            
            $table->timestamps();
        });

        Schema::create('category_description', function (Blueprint $table) {
            $table->bigInteger('id_category')->unsigned();            
            $table->string('language');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('id_category')->references('id_category')->on('category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_description');
        Schema::dropIfExists('category');        
    }
}
