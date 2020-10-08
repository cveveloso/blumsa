<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_group', function (Blueprint $table) {
            $table->id('id_attribute_group');            
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('attribute_group_description', function (Blueprint $table) {
            $table->id('id_attribute_group_description');            
            $table->bigInteger('id_attribute_group')->unsigned();
            $table->string('language');
            $table->string('name');
            $table->timestamps();

            $table->foreign('id_attribute_group')->references('id_attribute_group')->on('attribute_group')->onDelete('cascade');
        });

        Schema::create('attribute', function (Blueprint $table) {
            $table->id('id_attribute');
            $table->bigInteger('id_attribute_group')->unsigned();
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->foreign('id_attribute_group')->references('id_attribute_group')->on('attribute_group')->onDelete('cascade'); 
        });

        Schema::create('attribute_description', function (Blueprint $table) {
            $table->id('id_attribute_description');            
            $table->bigInteger('id_attribute')->unsigned();
            $table->string('language');
            $table->string('name');
            $table->timestamps();

            $table->foreign('id_attribute')->references('id_attribute')->on('attribute')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_group_description');
        Schema::dropIfExists('attribute_description');
        Schema::dropIfExists('attribute');
        Schema::dropIfExists('attribute_group');
    }
}
