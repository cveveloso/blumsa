<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    public $incrementing = true;

    public function Descriptions()
    {
        return $this->hasMany('App\Models\Catalog\ProductsDescription', 'id_product', 'id_product');
    }    
}

class ProductsDescription extends Model
{
    protected $table = 'products_description';
    protected $primaryKey = null;
    public $incrementing = false;    
}

