<?php

namespace App\Repositories\Catalog;

use Config, Str, Log;

use App\Repositories\BaseRepository;
use App\Contracts\Catalog\ProductContract;
use App\Models\Catalog\Product;
use App\Models\Catalog\ProductDescription;

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
            $products = new Product;
            $products->sku = Str::slug(e($params['sku']));
            $products->model = Str::slug(e($params['model']));
            $products->save();            
            
            return $products;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
    
}
