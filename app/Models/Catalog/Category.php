<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id_category';
    public $incrementing = true;

    public $name = '';
    public $description = '';

    public function Descriptions(string $language = null)
    {
        if ($language != null) {
            return $this->hasMany(CategoryDescription::class, 'id_category', 'id_category')->where('language', '=', $language)->first();
        }
        return $this->hasMany(CategoryDescription::class, 'id_category', 'id_category');
    }

    public function Childrens()
    {
        return $this->hasMany(Category::class, 'id_parent');
    }

    public function Parent()
    {
        return $this->belongsTo(Category::class, 'id_parent');
    }
}

class CategoryDescription extends Model
{
    protected $table = 'category_description';
    protected $primaryKey = 'id_category_description';
    public $incrementing = true; 
}

