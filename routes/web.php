<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Catalog\AdminCategoryController;
use App\Http\Controllers\Admin\Catalog\AdminAttributeController;
use App\Http\Controllers\Admin\Catalog\AdminProductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
});

//Language
Route::get('/language/changelanguage/{lang}', [LanguageController::class, 'ChangeLanguage'])->name('/language/changelanguage');

//Account
Route::get('/account/authenticate', [AccountController::class, 'Authenticate'])->name('/account/authenticate');
Route::post('/account/authenticate', [AccountController::class, 'Authenticate']);
Route::get('/account/register', [AccountController::class, 'Register']);
Route::post('/account/register', [AccountController::class, 'Register']);
Route::get('/account/forgotpassword', [AccountController::class, 'ForgotPassword']);
Route::get('/account/logout', [AccountController::class, 'Logout']);

//Admin
Route::get('/admin', [AdminController::class, 'Dashboard'])->name('/admin');;
Route::get('/admin/dashboard', [AdminController::class, 'Dashboard'])->name('/admin/dashboard');;
//Admin (Category)
Route::get('/admin/catalog/category', [AdminCategoryController::class, 'ListCategories'])->name('/admin/catalog/category');
Route::get('/admin/catalog/category/add', [AdminCategoryController::class, 'AddCategory'])->name('/admin/catalog/category/add');
Route::post('/admin/catalog/category/save', [AdminCategoryController::class, 'AddCategory'])->name('/admin/catalog/category/save');
Route::get('/admin/catalog/category/edit/{id}', [AdminCategoryController::class, 'EditCategory'])->name('/admin/catalog/category/edit/');
Route::post('/admin/catalog/category/update/{id}', [AdminCategoryController::class, 'EditCategory'])->name('/admin/catalog/category/update/');
Route::get('/admin/catalog/category/delete/{id}', [AdminCategoryController::class, 'DeleteCategory'])->name('/admin/catalog/category/delete/');
//Admin (Attribute group)
Route::get('/admin/catalog/attributegroup', [AdminAttributeController::class, 'ListAttributeGroups'])->name('/admin/catalog/attributegroup');
Route::get('/admin/catalog/attributegroup/add', [AdminAttributeController::class, 'AddAttributeGroup'])->name('/admin/catalog/attributegroup/add');
Route::post('/admin/catalog/attributegroup/save', [AdminAttributeController::class, 'AddAttributeGroup'])->name('/admin/catalog/attributegroup/save');
Route::get('/admin/catalog/attributegroup/edit/{id}', [AdminAttributeController::class, 'EditAttributeGroup'])->name('/admin/catalog/attributegroup/edit/');
Route::post('/admin/catalog/attributegroup/update/{id}', [AdminAttributeController::class, 'EditAttributeGroup'])->name('/admin/catalog/attributegroup/update/');
Route::get('/admin/catalog/attributegroup/delete/{id}', [AdminAttributeController::class, 'DeleteAttributeGroup'])->name('/admin/catalog/attributegroup/delete/');
//Admin (Attribute)
Route::get('/admin/catalog/attribute', [AdminAttributeController::class, 'ListAttributes'])->name('/admin/catalog/attribute');
Route::get('/admin/catalog/attribute/add', [AdminAttributeController::class, 'AddAttribute'])->name('/admin/catalog/attribute/add');
Route::post('/admin/catalog/attribute/save', [AdminAttributeController::class, 'AddAttribute'])->name('/admin/catalog/attribute/save');
Route::get('/admin/catalog/attribute/edit/{id}', [AdminAttributeController::class, 'EditAttribute'])->name('/admin/catalog/attribute/edit/');
Route::post('/admin/catalog/attribute/update/{id}', [AdminAttributeController::class, 'EditAttribute'])->name('/admin/catalog/attribute/update/');
Route::get('/admin/catalog/attribute/delete/{id}', [AdminAttributeController::class, 'DeleteAttribute'])->name('/admin/catalog/attribute/delete/');
//Admin (Products)
Route::get('/admin/catalog/products/list', [AdminProductController::class, 'ListProducts'])->name('/admin/catalog/products/list');
Route::get('/admin/catalog/products/add', [AdminProductController::class, 'AddProducts'])->name('/admin/catalog/products/add');
Route::post('/admin/catalog/products/save', [AdminProductController::class, 'AddProducts'])->name('/admin/catalog/products/save');
