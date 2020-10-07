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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id_product');
            $table->string('sku');
            $table->string('model');
            $table->timestamps();
        });

        Schema::create('products_description', function (Blueprint $table) {
            $table->bigInteger('id_product')->unsigned();
            $table->string('language');
            $table->string('name');
            $table->string('description')->nullable();   
            $table->timestamps();

            $table->foreign('id_product')->references('id_product')->on('products')->onDelete('cascade');
        });   
        
        Schema::create('products_attributes', function (Blueprint $table) {
            $table->bigInteger('products_attributes')->unsigned();
            $table->bigInteger('id_product')->unsigned();
            $table->bigInteger('superficie')->nullable(); 
            $table->bigInteger('longitud')->nullable(); 
            $table->bigInteger('ancho')->nullable(); 
            $table->string('description')->nullable();   
            $table->timestamps();

            $table->foreign('id_product')->references('id_product')->on('products')->onDelete('cascade');            
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
        Schema::dropIfExists('products_description');
    }
}
