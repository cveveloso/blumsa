<?php

namespace App\Repositories\Catalog;

use Config, Str, Log;

use App\Repositories\BaseRepository;
use App\Contracts\Catalog\AttributeGroupContract;
use App\Models\Catalog\AttributeGroup;
use App\Models\Catalog\AttributeGroupDescription;

use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class AttributeGroupRepository
 *
 * @package \App\Repositories
 */
class AttributeGroupRepository extends BaseRepository implements AttributeGroupContract
{
    use UploadAble;

    /**
     * AttributeRepository constructor.
     * @param AttributeGroup $model
     */
    public function __construct(AttributeGroup $model)
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
    public function ListAttributeGroups(string $order = 'id_attribute_group', string $sort = 'desc', array $columns = ['*'], bool $descriptions = true)
    {
        $groups = $this->all($columns, $order, $sort);
        
        if ($descriptions) {
            foreach ($groups as $group) {
                $description = $group->Descriptions(Config::get('app.locale'))                     ;
                $group->name = $description->name;
            }
        }

        return $groups;    
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function FindAttributeGroupById(int $id, bool $descriptions = true)
    {
        try {
            $group = $this->findOneOrFail($id);

            if ($descriptions) {
                $description = $group->Descriptions(Config::get('app.locale'));
                $group->name = $description->name;
            }
            return $group;

        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Group|mixed
     */
    public function CreateAttributeGroup(array $params)
    {
        try {               

            $group = new AttributeGroup;
            $group->sort_order = $params['sort_order'];
            $group->save();            
            
            foreach(array_keys(Config::get('languages')) as $key) {
                $groupDesc = new AttributeGroupDescription;
                $groupDesc->id_attribute_group = $group->id_attribute_group;
                $groupDesc->language = $key;
                $groupDesc->name = e($params['name' . '-' .  $key]);            
                $groupDesc->save();
            }

            return $group;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function UpdateAttributeGroup(int $id, array $params)
    {
        try {
            $group = $this->FindAttributeGroupById($id);

            if ($group != null) {
                $group->sort_order = $params['sort_order'];
                $group->update();

                foreach(array_keys(Config::get('languages')) as $key) {
                    $groupDesc = $group->Descriptions($key);                    
                    $groupDesc->name = e($params['name' . '-' .  $key]);                    
                    $groupDesc->update();
                }                
            }

            return $group;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());        
        }        
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function DeleteAttributeGroup($id)
    {
        $group = $this->FindAttributeGroupById($id);

        /*if ($category->image != null) {
            $this->deleteOne($category->image);
        }*/

        $group->delete();

        return $group;
    }

    public function FindBySlug($slug)
    {
        return Category::with('products')
            ->where('slug', $slug)
            ->where('menu', 1)
            ->first();
    }
}
