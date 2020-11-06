<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attribute';
    protected $primaryKey = 'id_attribute';
    public $incrementing = true;

    public $name = '';    

    public function Descriptions(string $language = null)
    {
        if ($language != null) {
            return $this->hasMany(AttributeDescription::class, 'id_attribute', 'id_attribute')->where('language', '=', $language)->first();
        }
        return $this->hasMany(AttributeDescription::class, 'id_attribute', 'id_attribute');
    }    

    public function Group()
    {
        return $this->belongsTo(AttributeGroup::class, 'id_attribute_group');
    }
}

class AttributeDescription extends Model
{
    protected $table = 'attribute_description';
    protected $primaryKey = 'id_attribute_description';
    public $incrementing = true; 
}

