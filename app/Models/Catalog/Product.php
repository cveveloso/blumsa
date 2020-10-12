<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id_product';
    public $incrementing = true;

    public function Descriptions(string $language = null)
    {
        if ($language != null) {
            return $this->hasMany(ProductDescription::class, 'id_product', 'id_product')->where('language', '=', $language)->first();
        }
        return $this->hasMany(ProductDescription::class, 'id_product', 'id_product');        
    }  
    
    public function Categories(int $id = null)
    {
        if ($id != null) {
            return $this->hasMany(ProductCategory::class, 'id_product', 'id_product')->where('id_product', '=', $id)->first();
        }
        return $this->hasMany(ProductCategory::class, 'id_product', 'id_product');            
    }
}

class ProductDescription extends Model
{
    protected $table = 'product_description';
    protected $primaryKey = null;
    public $incrementing = false;    
}

class ProductCategory extends Model
{
    protected $table = 'product_categories';
    protected $primaryKey = 'id_product_categories';
    public $incrementing = true;
    public $timestamps = false;
}



