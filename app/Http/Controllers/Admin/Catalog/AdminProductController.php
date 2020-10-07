<?php

namespace App\Http\Controllers\Admin\Catalog;

use Illuminate\Http\Request;
use Auth, Config, Validator, Str;
use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Contracts\Catalog\CategoryContract;
use App\Contracts\Catalog\ProductsContract;

class AdminProductController extends BaseController
{
	public function __construct(CategoryContract $categoryRepository,ProductsContract $productsRepository) {
		$this->middleware('auth');
		$this->middleware('validate.admin');
		$this->categoryRepository = $categoryRepository;		
		$this->productsRepository = $productsRepository;		
	}

    public function listProducts(Request $request) {	
    	if ($request->method() == 'GET') {	
			$products = new Products;
			return view('Admin.Catalog.ListProduct',['products' => $products::all()]);
    	}
	}
	
	public function AddProducts(Request $request) {
    	if ($request->method() == 'GET') {	
			//para llenar el combo de categorias begin
    		$categories = $this->categoryRepository->ListCategories('code', 'asc', ['code', 'id_category']);
    		
    		$comboCategories = array();
    		foreach ($categories as $category) {
    			$comboCategories[$category->id_category] =  $category->name;
			}
			//para llenar el combo de categorias end	
			return view('Admin.Catalog.AddProducts',['comboCategories' => $comboCategories]);
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
	    $products = $this->productsRepository->CreateProducts($params);		    	

		if (!$products) {
           	return $this->responseRedirectBack('Ocurrio un problema al guardar el producto, TIBU!.', 'error', true, true);
		}
        
        return $this->responseRedirect('/admin/catalog/products/add', 'Producto guardado con éxito.' ,'success', false, false);		
    }	
}
