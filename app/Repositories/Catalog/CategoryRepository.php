<?php

namespace App\Repositories\Catalog;

use Config, Str, Log;

use App\Repositories\BaseRepository;
use App\Contracts\Catalog\CategoryContract;
use App\Models\Catalog\Category;
use App\Models\Catalog\CategoryDescription;

use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CategoryRepository
 *
 * @package \App\Repositories
 */
class CategoryRepository extends BaseRepository implements CategoryContract
{
    use UploadAble;

    /**
     * CategoryRepository constructor.
     * @param Category $model
     */
    public function __construct(Category $model)
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
    public function ListCategories(string $order = 'id_category', string $sort = 'desc', array $columns = ['*'], bool $descriptions = true)
    {
        $categories = $this->all($columns, $order, $sort);
        
        if ($descriptions) {
            foreach ($categories as $category) {
                $description = $category->Descriptions(Config::get('app.locale'))                     ;
                $category->name = $description->name;
                $category->description = $description->description;
            }
        }

        return $categories;    
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function FindCategoryById(int $id, bool $descriptions = true)
    {
        try {
            $category = $this->findOneOrFail($id);

            if ($descriptions) {
                $description = $category->Descriptions(Config::get('app.locale'));
                $category->name = $description->name;
                $category->description = $description->description;
            }
            return $category;

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Category|mixed
     */
    public function CreateCategory(array $params)
    {
        try {   
            $parent = $params['parent'];       
            $level = 0;

            if ($parent != '0') {
                $categoryParent = $this->FindCategoryById($parent, false);
                $level = $categoryParent->level + 1;
            }

            $category = new Category;
            $category->code = Str::slug(e($params['code']));
            $category->slug = Str::slug(e($params['code']));
            $category->id_parent = $parent;
            $category->level = $level;
            $category->status = (array_key_exists('status', $params) ? 1 : 0);
            $category->sort_order = $params['sort_order'];
            $category->save();            
            
            foreach(array_keys(Config::get('languages')) as $key) {
                $categoryDesc = new CategoryDescription;
                $categoryDesc->id_category = $category->id_category;
                $categoryDesc->language = $key;
                $categoryDesc->name = e($params['name' . '-' .  $key]);
                $categoryDesc->description = e($params['description' . '-' .  $key]);
                $categoryDesc->save();
            }

            return $category;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function UpdateCategory(int $id, array $params)
    {
        try {
            $category = $this->findCategoryById($id);

            if ($category != null) {
              
                $parent = $params['parent'];       
                $level = 0;

                if ($parent != '0') {
                    $categoryParent = $this->FindCategoryById($parent, false);
                    $level = $categoryParent->level + 1;
                }

                $category->code = Str::slug(e($params['code']));
                $category->slug = Str::slug(e($params['code']));
                $category->id_parent = $parent;
                $category->level = $level;
                $category->status = (array_key_exists('status', $params) ? 1 : 0);
                $category->sort_order = $params['sort_order'];
                $category->update();

                foreach(array_keys(Config::get('languages')) as $key) {
                    $categoryDesc = $category->Descriptions($key);                    
                    $categoryDesc->name = e($params['name' . '-' .  $key]);
                    $categoryDesc->description = e($params['description' . '-' .  $key]);
                    $categoryDesc->update();
                }                
            }

            return $category;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());        
        }        
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function DeleteCategory($id)
    {
        $category = $this->findCategoryById($id);

        if ($category->image != null) {
            $this->deleteOne($category->image);
        }

        $category->delete();

        return $category;
    }

    public function FindBySlug($slug)
    {
        return Category::with('products')
            ->where('slug', $slug)
            ->where('menu', 1)
            ->first();
    }
}
