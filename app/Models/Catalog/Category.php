<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'category_id';
    public $incrementing = true;

    public function Descriptions()
    {
        return $this->hasMany('App\Models\Catalog\CategoryDescription', 'id_category', 'id_category');
    }    
}

class CategoryDescription extends Model
{
    protected $table = 'category_description';
    protected $primaryKey = null;
    public $incrementing = false;    
}

