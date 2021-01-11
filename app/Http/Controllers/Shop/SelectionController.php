<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\BaseController;
use App\Contracts\Catalog\CategoryContract;

class SelectionController extends BaseController
{
	public function __construct(CategoryContract $categoryRepository) {
		$this->middleware('auth');
		$this->categoryRepository = $categoryRepository;
	}	

    public function Category($slug) {
    	$category = $this->categoryRepository->FindCategoryBySlug($slug);
    	$categories = $this->categoryRepository->GetCategoriesTree();
    	return view('Shop.Category', 
    		['category' => $category,
    		 'categories' => $categories]
    	);
    }
}
