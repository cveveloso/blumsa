<?php

namespace App\Http\Controllers\Admin\Catalog;

use Illuminate\Http\Request;
use Auth, Config, Validator, Str;
use App\Http\Controllers\BaseController;
use App\Contracts\Catalog\CategoryContract;
use App\Contracts\Catalog\ProductContract;
use App\Models\Catalog\ProductImage;
use App\Traits\UploadAble;

class AdminProductController extends BaseController
{
	use UploadAble;
	
	public function __construct(CategoryContract $categoryRepository, ProductContract $productRepository) {
		$this->middleware('auth');
		$this->middleware('validate.admin');
		$this->categoryRepository = $categoryRepository;		
		$this->productRepository = $productRepository;			
	}

    public function ListProducts(Request $request) {	
    	if ($request->method() == 'GET') {	
    		$products = $this->productRepository->ListProducts();
			return view('Admin.Catalog.ListProduct',['products' => $products]);
    	}
	}
	
	
	public function AddProducts(Request $request) {
    	if ($request->method() == 'GET') {	
			//para llenar el combo de categorias begin
    		$categories = $this->categoryRepository->ListCategories('code', 'asc', ['code', 'id_category']);
			$atributesGroup = $this->productRepository->ListGroupAttribute();
			$atributes = $this->productRepository->ListAttribute();
			
    		$comboCategories = array();
    		foreach ($categories as $category) {
    			$comboCategories[$category->id_category] =  $category->name;
			}
			//para llenar el combo de categorias end	
			return view('Admin.Catalog.AddProducts',['comboCategories' => $comboCategories,
			'listGroupAttribute' => $atributesGroup,
			'listAttribute' => $atributes
			]);
		}
		
		// Validaciones begin
		$rules = array();
		$rules['sku'] = 'required';
		$rules['category'] = 'required';
    	$rules['modelo'] = 'required';
		
		/*
		foreach(array_keys(Config::get('languages')) as $key) {
			$rules['sku-' . $key] = 'required';
			$rules['modelo-' . $key] = 'required';
		}
		*/
		
		$validator = Validator::make($request->all(), $rules);

	    if ($validator->fails()) {	    	
	    	return $this->responseRedirectBack('Ocurrio un problema al guardar el nuevo producto.', 'error', true, true, $validator->errors());
	    }		
		// Validaciones end		

	    $params = $request->except('_token');
	    $products = $this->productRepository->CreateProduct($params);		    	

		if (!$products) {
           	return $this->responseRedirectBack('Ocurrio un problema al guardar el producto.', 'error', true, true);
		}
        
        return $this->responseRedirect('/admin/catalog/products/add', 'Producto guardado con éxito.' ,'success', false, false);		
	}	
	
    public function EditProducts(Request $request, $id) {		
    	if ($request->method() == 'GET') {	
			$productsEdit = $this->productRepository->FindProductById($id);
			$productsEditDescription = $this->productRepository->FindProductDescriptionById($id);

			$categories = $this->categoryRepository->ListCategories('code', 'asc', ['code', 'id_category']);
    		
    		$comboCategories = array();
    		$comboCategories['0'] =  'Sin categoría padre';
    		foreach ($categories as $category) {
    			$comboCategories[$category->id_category] =  $category->name;
			}
			
			return view('Admin.Catalog.EditProducts', [
				'product' => $productsEdit,
				'productDescription'=> $productsEditDescription,
				'comboCategories' => $comboCategories
			]);						
		}
		
		// Validaciones begin
		$rules = array();
		$rules['sku'] = 'required';
		$rules['category'] = 'required';
		$rules['modelo'] = 'required';

    	foreach(array_keys(Config::get('languages')) as $key) {
			$rules['name-' . $key] = 'required';
			$rules['description-' . $key] = 'required';
		}		

		$validator = Validator::make($request->all(), $rules);

	    if ($validator->fails()) {	    	
	    	return $this->responseRedirectBack('Ocurrio un problema al guardar el nuevo producto.', 'error', true, true, $validator->errors());
	    }		
		// Validaciones end		
		
	    $params = $request->except('_token');
	    $products = $this->productRepository->UpdateProduct($id,$params);		    	

		if (!$products) {
           	return $this->responseRedirectBack('Ocurrio un problema al actualizar el producto.', 'error', true, true);
		}
        
        return $this->responseRedirect('/admin/catalog/products/edit/', 'Producto actualizado con éxito.' ,'success', false, false,[$id]);				
	}
	
    public function UploadImagesProduct(Request $request) {
		$product = $this->productRepository->FindProductById($request->product);

		if($product) {
		   if ($request->has('image')) {

			   $image = $this->uploadOne($request->image, 'product');

			   $productImage = new ProductImage();
			   $productImage->path = $image;

			   $product->Images()->save($productImage);
		   }
	   }

	   return response()->json(['status' => 'Success']);
   }	
}
