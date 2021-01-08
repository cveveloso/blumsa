<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id_product');
            $table->string('sku');
            $table->float('price')->nullable();
            $table->integer('discount')->default(0);     
            $table->boolean('enabled')->default(0); 
            $table->timestamps();
        });

        Schema::create('product_description', function (Blueprint $table) {
            $table->bigInteger('id_product')->unsigned();
            $table->string('language');
            $table->string('name');
            $table->string('description')->nullable();   
            $table->timestamps();

            $table->foreign('id_product')->references('id_product')->on('product')->onDelete('cascade');
        });    
        
        Schema::create('product_image', function (Blueprint $table) {
            $table->id('id_product_image');
            $table->bigInteger('id_product')->unsigned();            
            $table->string('path');            
            $table->timestamps();

            $table->foreign('id_product')->references('id_product')->on('product')->onDelete('cascade');
        });   
        
        Schema::create('product_attribute', function (Blueprint $table) {
            $table->bigInteger('id_product')->unsigned();
            $table->string('name_attribute');
            $table->string('value_attribute')->nullable();
            $table->string('lang');
            $table->timestamps();

            $table->foreign('id_product')->references('id_product')->on('product')->onDelete('cascade');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::dropIfExists('product_image');
        Schema::dropIfExists('product_description'); 
        Schema::dropIfExists('product_attribute');  
        Schema::dropIfExists('product');                  
    }
}
