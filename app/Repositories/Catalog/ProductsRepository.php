<?php

namespace App\Repositories\Catalog;

use Config, Str, Log;

use App\Repositories\BaseRepository;
use App\Models\Catalog\Products;
use App\Models\Catalog\ProductsDescription;
use App\Contracts\Catalog\ProductsContract;

use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class ProductsRepository extends BaseRepository implements ProductsContract
{
    use UploadAble;

    public function __construct(Product $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function CreateProduct(array $params)
    {
        try {   
            $products = new Products;
            $products->sku = Str::slug(e($params['sku']));
            $products->model = Str::slug(e($params['model']));
            $products->save();            
            
            return $products;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
    
}
