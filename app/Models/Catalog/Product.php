<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id_product';
    public $incrementing = true;

    public function Descriptions()
    {
        return $this->hasMany(ProductDescription::class, 'id_product', 'id_product');
    }    
}

class ProductDescription extends Model
{
    protected $table = 'product_description';
    protected $primaryKey = null;
    public $incrementing = false;    
}

