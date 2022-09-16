<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessOwner\DashboardController;
use App\Http\Controllers\BusinessOwner\LoginBusinessOwnerController;
use App\Http\Controllers\BusinessOwner\Dashboard\CategoryController;
use App\Http\Controllers\BusinessOwner\Dashboard\SubCategoryController;
use App\Http\Controllers\BusinessOwner\Dashboard\MenuController;
/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register user routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "user" middleware group. Now create something great!
|
*/

// No Permission
Route::get('/403', function () {
    return view('errors.403');
})->name('NoPermission');

// Not Found
Route::get('/404', function () {
    return view('errors.404');
})->name('NotFound');

// Route::get('/', function () {
//     return 'Route using separate file';
// });
// Route::get('/', [DashboardController::class,'plan_list']);'
// exit("smbmb".Auth::user());
// Route::group(['middleware' => 'auth'], function () { 

// });
Route::get('/', [LoginBusinessOwnerController::class,'showBusinessOwnerLoginForm'])->name('businessOwnerHome');
Route::get('/admin/login', [LoginBusinessOwnerController::class,'showBusinessOwnerLoginForm'])->name('businessOwnerHome');
Route::get('/admin/businessOwnerHome', [DashboardController::class,'index'])->name('businessOwnerHome');
Route::get('/setup', [DashboardController::class,'profileBuild'])->name('setup');

// categories Management
// Route::get('/categories', [CategoryController::class,'index'])->name('categories');
// Route::get('/category/create', [CategoryController::class,'create'])->name('category.create');
// Route::post('/category/store', [CategoryController::class,'store'])->name('category.store');
// Route::get('/category/show/{id}', [CategoryController::class,'show'])->name('category.show');
// Route::get('/category/edit/{id}', [CategoryController::class,'edit'])->name('category.edit');
// Route::get('/category/delete/{id}', [CategoryController::class,'destroy'])->name('category.delete');
// Route::post('/category/update/{id}', [CategoryController::class,'update'])->name('category.update');
// Route::post('/category/updateAll', [CategoryController::class, 'updateAll'])->name('category.updateAll');


// sub-categories Management
// Route::get('/sub-categories', [SubCategoryController::class,'index'])->name('sub-categories');
// Route::get('/sub-category/create', [SubCategoryController::class,'create'])->name('sub-category.create');
// Route::post('/sub-category/store', [SubCategoryController::class,'store'])->name('sub-category.store');
Route::get('/sub-category/show/{id}', [SubCategoryController::class,'show'])->name('sub-category.show');
// Route::get('/sub-category/edit/{id}', [SubCategoryController::class,'edit'])->name('sub-category.edit');
// Route::post('/sub-category/update/{id}', [SubCategoryController::class,'update'])->name('sub-category.update');
// Route::get('/sub-category/delete/{id}', [SubCategoryController::class,'destroy'])->name('sub-category.delete');
// Route::post('/sub-category/updateAll', [SubCategoryController::class, 'updateAll'])->name('sub-category.updateAll');
Route::post('/sub-category/anyData', [SubCategoryController::class,'anyData'])->name('sub-category.anyData');



//Menu management
// Route::get('/menu', [MenuController::class,'index'])->name('menu');
// Route::get('/menu/create', [MenuController::class,'create'])->name('menu.create');
// Route::post('/menu/store', [MenuController::class,'store'])->name('menu.store');
// Route::get('/menu/show/{id}', [MenuController::class,'show'])->name('menu.show');
// Route::get('/menu/edit/{id}', [MenuController::class,'edit'])->name('menu.edit');
// Route::post('/menu/update/{id}', [MenuController::class,'update'])->name('menu.update');
// Route::get('/menu/delete/{id}', [MenuController::class,'destroy'])->name('menu.delete');
// Route::post('/menu/updateAll', [MenuController::class, 'updateAll'])->name('menu.updateAll');
// Route::post('/menu/anyData', [MenuController::class,'anyData'])->name('menu.anyData');

// Route::post('/subcategories', [SubCategoryController::class,'index'])->name('sub-categories');
// Route::get('/', [DashboardController::class,'index'])->name('businessOwnerHome');
// Route::post('/businessOwnerLogin', [LoginBusinessOwnerController::class,'login'])->name('businessOwnerLogin');

// Route::Group(['middleware'=>'userauth'], function () {
    // Route::post('/formlogin', function () {
    //     return 'Route using separate file';
    //     })->name('formlogin');
    // Route::post('/login/submit', [LoginBusinessOwnerController::class,'login'])->name('login.submit');
// });
?>
