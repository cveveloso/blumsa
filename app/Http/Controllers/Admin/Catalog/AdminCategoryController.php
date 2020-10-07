<?php

namespace App\Http\Controllers\Admin\Catalog;

use Illuminate\Http\Request;
use Auth, Config, Validator, Str;
use App\Http\Controllers\BaseController;
use App\Contracts\Catalog\CategoryContract;


class AdminCategoryController extends BaseController
{    
	public function __construct(CategoryContract $categoryRepository) {
		$this->middleware('auth');
		$this->middleware('validate.admin');
		$this->categoryRepository = $categoryRepository;
	}

	public function ListCategories(Request $request) {
    	$categories = $this->categoryRepository->ListCategories();
		return view('Admin.Catalog.ListCategories', ['categories' => $categories]);
    }

    public function AddCategory(Request $request) {
    	if ($request->method() == 'GET') {	
    		$categories = $this->categoryRepository->ListCategories('code', 'asc', ['code', 'id_category']);
    		
    		$comboCategories = array();
    		$comboCategories['0'] =  'Sin categoría padre';
    		foreach ($categories as $category) {
    			$comboCategories[$category->id_category] =  $category->name;
    		}

			return view('Admin.Catalog.AddCategory', ['comboCategories' => $comboCategories]);
    	}

    	$rules = array();
    	$rules['code'] = 'required';
    	$rules['sort_order'] = 'required|numeric';
    	foreach(array_keys(Config::get('languages')) as $key) {
			$rules['name-' . $key] = 'required';
			$rules['description-' . $key] = 'required';
		}

		$validator = Validator::make($request->all(), $rules);
    
	    if ($validator->fails()) {	    	
	    	return $this->responseRedirectBack('Ocurrio un problema al guardar la categoría.', 'error', true, true, $validator->errors());
	    }
	    
	    $params = $request->except('_token');
	    $category = $this->categoryRepository->CreateCategory($params);		    	

		if (!$category) {
           	return $this->responseRedirectBack('Ocurrio un problema al guardar la categoría.', 'error', true, true);
		}
        
        return $this->responseRedirect('/admin/catalog/category/add', 'Categoría guardada con éxito.' ,'success', false, false);
    }

    public function EditCategory(Request $request, $id) {
    	if ($request->method() == 'GET') {	
    		$categoryEdit = $this->categoryRepository->FindCategoryById($id);

    		$categories = $this->categoryRepository->ListCategories('code', 'asc', ['code', 'id_category']);
    		
    		$comboCategories = array();
    		$comboCategories['0'] =  'Sin categoría padre';
    		foreach ($categories as $category) {
    			$comboCategories[$category->id_category] =  $category->name;
    		}

			return view('Admin.Catalog.EditCategory', [
				'category' => $categoryEdit,
				'comboCategories' => $comboCategories
			]);
    	}

    	$rules = array();
    	$rules['code'] = 'required';
    	$rules['sort_order'] = 'required|numeric';
    	foreach(array_keys(Config::get('languages')) as $key) {
			$rules['name-' . $key] = 'required';
			$rules['description-' . $key] = 'required';
		}

		$validator = Validator::make($request->all(), $rules);
    
	    if ($validator->fails()) {	    	
	    	return $this->responseRedirectBack('Ocurrio un problema al guardar la categoría.', 'error', true, true, $validator->errors());
	    }
	    
	    $params = $request->except('_token');
	    $category = $this->categoryRepository->UpdateCategory($id, $params);		    	

		if (!$category) {
           	return $this->responseRedirectBack('Ocurrio un problema al guardar la categoría.', 'error', true, true);
		}        
        return $this->responseRedirect('/admin/catalog/category/edit/', 'Categoría guardada con éxito.' ,'success', false, false, [$id]);
    }
}
