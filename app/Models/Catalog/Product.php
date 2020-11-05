<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id_product';
    public $incrementing = true;

    public function Descriptions(int $id = null,string $language = null)
    {
        if ($id != null) {
            return $this->hasMany(ProductDescription::class, 'id_product', 'id_product')->where('language', '=', $language)->where('id_product', '=', $id)->first();
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

    public function Images()
    {
        return $this->hasMany(ProductImage::class, 'id_product', 'id_product');
    }

    public function GrupoAtributo(string $language = null)
    {
        if ($language != null) {
            return $this->hasMany(ProductAttributeGroup::class, 'id_attribute_group_description', 'id_attribute_group_description')->where('language', '=', $language)->first();
        }
        return $this->hasMany(ProductAttributeGroup::class, 'id_attribute_group_description', 'id_attribute_group_description');    
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

class ProductImage extends Model
{
    protected $table = 'product_image';
    protected $primaryKey = 'id_product_image';
    public $incrementing = true; 
    
    protected $fillable = ['id_product'];
}

class ProductAttributeGroup extends Model
{
    protected $table = 'attribute_group_description';
    protected $primaryKey = 'id_attribute_group_description';
    public $incrementing = true;
    public $timestamps = false;
}

class ProductAttribute extends Model
{
    protected $table = 'attribute';
    protected $primaryKey = 'id_attribute';
    public $incrementing = true;
    public $timestamps = false;
}

class ProductyAttribute extends Model
{
    protected $table = 'product_attribute';
    public $incrementing = true;
    public $timestamps = false;
}


