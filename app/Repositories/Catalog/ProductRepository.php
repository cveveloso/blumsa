<?php

namespace App\Repositories\Catalog;

use Config, Str, Log;

use App\Repositories\BaseRepository;
use App\Contracts\Catalog\ProductContract;
use App\Models\Catalog\Product;
use App\Models\Catalog\ProductDescription;
use App\Models\Catalog\ProductCategory;
use App\Models\Catalog\ProductImage;
use App\Models\Catalog\ProductAttributeGroup;
use App\Models\Catalog\ProductAttribute;

use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class ProductRepository extends BaseRepository implements ProductContract
{
    use UploadAble;

    public function __construct(Product $model)
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
    public function ListProducts(string $order = 'id_product', string $sort = 'desc', array $columns = ['*'], bool $descriptions = true)
    {
        $products = $this->all($columns, $order, $sort);
        
        return $products;    
    }

    public function CreateProduct(array $params)
    {
        try {   

            // Inserto el nuevo producto begin
            $products = new Product;
            $products->sku = Str::slug(e($params['sku']));
            $products->model = Str::slug(e($params['modelo']));
            $products->save();     
            // Inserto el nuevo producto end
            
            // Cargo las descripciones del producto recien creado begin
            foreach(array_keys(Config::get('languages')) as $key) {
                $productsDesc = new ProductDescription;
                $productsDesc->id_product = $products->id_product;
                $productsDesc->language = $key;
                $productsDesc->name = e($params['name' . '-' .  $key]);
                $productsDesc->description = e($params['description' . '-' .  $key]);
                $productsDesc->save();
            }            
            // Cargo las descripciones del producto recien creado end

            // Cargo la categoria asociada al producto begin
            $productsCategories = new ProductCategory;
            $productsCategories->id_product = $products->id_product;
            $productsCategories->id_category = e($params['category']);
            $productsCategories->save();
            // Cargo la categoria asociada al producto end

            return $products;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function UpdateProduct(int $id, array $params)
    {
        try {
            $products = $this->FindProductById($id);

            //Actualizco SKU y Modelo 
            if ($products != null) {
                $products->sku = Str::slug(e($params['sku']));
                $products->model = Str::slug(e($params['modelo']));
                $products->update();                             
            }

            //Actualizco Categoria asociada
            $productsCat = $products->Categories($id);   
            $productsCat::where('id_product', $id)->update(array("id_category"=> e($params['category'])));

            //Actualizco Nombre y Descripciones
            foreach(array_keys(Config::get('languages')) as $key) {
                $productsDesc = $products->Descriptions($key);                   
                $productsDesc::where('id_product', $id)->update(array("name"=> e($params['name' . '-' .  $key]),"description"=>e($params['description' . '-' .  $key])));                
            }     

            return $products;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());        
        }       
    }

    public function FindProductById(int $id, bool $descriptions = true)
    {
        try {
            $product = $this->findOneOrFail($id);            

            return $product;

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    } 
    
    public function FindProductDescriptionById(int $id)
    {
        try {                        
            $product = new ProductDescription;
            $productDescription = $product::where('id_product', '=', $id)->get();
            return $productDescription;
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }  

    public function ListGroupAttribute()
    {
        try {                        
            $product = new ProductAttributeGroup;
            $productGroupAttribute = $product->all();
            return $productGroupAttribute;
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }  

    public function ListAttribute()
    {
        try {                        
            $productAttribute = ProductAttribute::select('attribute.id_attribute','attribute.id_attribute_group','attribute_description.language','attribute_description.name')->join('attribute_description', 'attribute.id_attribute', '=', 'attribute_description.id_attribute')->get();
            return $productAttribute;
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        } 
    }
    
    public function FindProductCategoryById(int $id)
    {
        try {                        
            $product = new ProductCategory;
            $productCategory= $product::where('id_product', '=', $id)->get("id_category");
            return $productCategory;
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }         
    
}
