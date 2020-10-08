<?php

namespace App\Repositories\Catalog;

use Config, Str, Log;

use App\Repositories\BaseRepository;
use App\Contracts\Catalog\AttributeContract;
use App\Models\Catalog\Attribute;
use App\Models\Catalog\AttributeDescription;

use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class AttributeRepository
 *
 * @package \App\Repositories
 */
class AttributeRepository extends BaseRepository implements AttributeContract
{
    use UploadAble;

    /**
     * AttributeRepository constructor.
     * @param AttributeGroup $model
     */
    public function __construct(Attribute $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function ListAttributes(string $order = 'id_attribute', string $sort = 'desc', array $columns = ['*'], bool $descriptions = true)
    {
        $attributes = $this->all($columns, $order, $sort);
        
        if ($descriptions) {
            foreach ($attributes as $attribute) {
                $description = $attribute->Descriptions(Config::get('app.locale'))                     ;
                $attribute->name = $description->name;
            }
        }

        return $attributes;    
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function FindAttributeById(int $id, bool $descriptions = true)
    {
        try {
            $attribute = $this->findOneOrFail($id);

            if ($descriptions) {
                $description = $attribute->Descriptions(Config::get('app.locale'));
                $attribute->name = $description->name;
            }
            return $attribute;

        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Group|mixed
     */
    public function CreateAttribute(array $params)
    {
        try {               

            $attribute = new Attribute;
            $attribute->id_attribute_group = $params['group'];
            $attribute->sort_order = $params['sort_order'];
            $attribute->save();            
            
            foreach(array_keys(Config::get('languages')) as $key) {
                $attributeDesc = new AttributeDescription;
                $attributeDesc->id_attribute = $attribute->id_attribute;
                $attributeDesc->language = $key;
                $attributeDesc->name = e($params['name' . '-' .  $key]);            
                $attributeDesc->save();
            }

            return $attribute;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function UpdateAttribute(int $id, array $params)
    {
        try {
            $attribute = $this->FindAttributeById($id);

            if ($attribute != null) {
                $attribute->id_attribute_group = $params['group'];
                $attribute->sort_order = $params['sort_order'];
                $attribute->update();

                foreach(array_keys(Config::get('languages')) as $key) {
                    $attributeDesc = $attribute->Descriptions($key);                    
                    $attributeDesc->name = e($params['name' . '-' .  $key]);                    
                    $attributeDesc->update();
                }                
            }

            return $attribute;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());        
        }        
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function DeleteAttribute($id)
    {
        $attribute = $this->FindAttributeById($id);

        /*if ($category->image != null) {
            $this->deleteOne($category->image);
        }*/

        $attribute->delete();

        return $attribute;
    }

    public function FindBySlug($slug)
    {
        return Category::with('products')
            ->where('slug', $slug)
            ->where('menu', 1)
            ->first();
    }
}
