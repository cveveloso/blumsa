<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    protected $table = 'attribute_group';
    protected $primaryKey = 'id_attribute_group';
    public $incrementing = true;

    public $name = '';    

    public function Descriptions(string $language = null)
    {
        if ($language != null) {
            return $this->hasMany(AttributeGroupDescription::class, 'id_attribute_group', 'id_attribute_group')->where('language', '=', $language)->first();
        }
        return $this->hasMany(AttributeGroupDescription::class, 'id_attribute_group', 'id_attribute_group');
    }

    public function Attributes()
    {        
        return $this->hasMany(Attribute::class, 'id_attribute_group', 'id_attribute_group');
    }    
}

class AttributeGroupDescription extends Model
{
    protected $table = 'attribute_group_description';
    protected $primaryKey = 'id_attribute_group_description';
    public $incrementing = true; 
}

