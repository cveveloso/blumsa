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
use App\Models\Catalog\ProductyAttribute;

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
            $products->sku = e($params['sku']);
            $products->price = e($params['price']);
            $products->discount = e($params['discount']);
            $products->enabled = (array_key_exists('enabled', $params) ? 1 : 0);
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

            // Cargo los attributos begin
            foreach($this->ListAttribute() as $attr)
            {
                $productsAttribute = new ProductyAttribute;
                $productsAttribute->id_product = $products->id_product; 
                $productsAttribute->name_attribute = $attr->name;
                $productsAttribute->value_attribute = e($params["attr-". $attr->id_attribute . "-" . $attr->language]);
                $productsAttribute->lang = $attr->language;    
                $productsAttribute->save();        
            }
            // Cargo los attributos end
            
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
                $products->sku = e($params['sku']);
                $products->price = e($params['price']);
                $products->discount = e($params['discount']);  
                $products->enabled = (array_key_exists('enabled', $params) ? 1 : 0);                              
                $products->update();                             
            }

            //Actualizco Categoria asociada
            $productsCat = $products->Categories($id);   
            $productsCat::where('id_product', $id)->update(array("id_category"=> e($params['category'])));


            // Actualizo las descripciones del producto begin
            foreach(array_keys(Config::get('languages')) as $key) {
                $productsDesc = $products->Descriptions($id,$key);
                $productsDesc->name = e($params['name' . '-' .  $key]);
                $productsDesc->description = e($params['description' . '-' .  $key]);
                $productsDesc::where('id_product', $id)->where('language', $key)->update(array("name"=> e($params['name' . '-' .  $key]),"description"=>e($params['description' . '-' .  $key])));                
            }            
            // Actualizo las descripciones del producto  end  
            
            // Actualizo los atributos begin (borro y vuelvo a cargar)           
            $productsAttribute = ProductyAttribute::where('id_product','=',$id);
            $productsAttribute->delete();

            foreach($this->ListAttribute() as $attr)
            {
                $productsAttribute = new ProductyAttribute;
                $productsAttribute->id_product = $products->id_product; 
                $productsAttribute->name_attribute = $attr->name;
                $productsAttribute->value_attribute = e($params["attr-". $attr->id_attribute . "-" . $attr->language]);
                $productsAttribute->lang = $attr->language;    
                $productsAttribute->save();        
            }
            // Actualizo los atributos end

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
            $productAttribute = ProductAttribute::selectRaw('attribute.id_attribute,
                                                             attribute.id_attribute_group,
                                                             attribute.data_type,
                                                             attribute.unit,
                                                             attribute_description.language,
                                                             CASE attribute.data_type WHEN "number" THEN "step=0.001" ELSE "" END as step,
                                                             attribute_description.name')->join('attribute_description', 
                                                                                                'attribute.id_attribute', '=', 
                                                                                                'attribute_description.id_attribute')->get();
            return $productAttribute;
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        } 
    }
    
    public function AttributeByProduct(int $id)
    {
        try {                        
            $product = new ProductyAttribute;
            $productAttr= $product::where('id_product', '=', $id)->get();
            return $productAttr;
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
