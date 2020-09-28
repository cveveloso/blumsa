<?php

namespace App\Http\Controllers\Admin\Catalog;

use Illuminate\Http\Request;
use Auth, Config, Validator, Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Catalog\Category;
use App\Models\Catalog\CategoryDescription;


class AdminCategoryController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('validate.admin');
	}

    public function AddCategory(Request $request) {
    	if ($request->method() == 'GET') {	
			return view('Admin.Catalog.AddCategory');
    	}

    	$rules = array();
    	$rules['code'] = 'required';
    	foreach(array_keys(Config::get('languages')) as $key) {
			$rules['name-' . $key] = 'required';
			$rules['description-' . $key] = 'required';
		}

		$validator = Validator::make($request->all(), $rules);
    
	    if ($validator->fails()) {
	    	return back()
	    	->withInput()
	    	->withErrors($validator)
	    	->with('message', 'Error, faltan completar datos requeridos.')
	    	->with('typemessage', 'danger');	
	    }
	    else {
	    	try {       
		    	$category = new Category;
		    	$category->code = Str::slug(e($request->input('code')));
		    	$category->slug = Str::slug(e($request->input('code')));
		    	$category->status = 1;
		    	$idCategory = $category->save();
		    	$category->id_category = $idCategory;
		    	
		    	foreach(array_keys(Config::get('languages')) as $key) {
		    		$categoryDesc = new CategoryDescription;
					$categoryDesc->id_category = $category->id_category;
					$categoryDesc->language = $key;
					$categoryDesc->name = e($request->input('name-' . $key));
					$categoryDesc->description = e($request->input('description-' . $key));
					$categoryDesc->save();
				}

		    	return back()
		    	->with('message', 'Categoría agregada con éxito.')
		    	->with('typemessage', 'success');
		    } 
		    catch (Throwable $e) {
		    	return back()
		    	->with('message', $e)
		    	->with('typemessage', 'danger');
		    }
		}
    }
}
