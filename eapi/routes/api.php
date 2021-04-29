<?php
use App\Category;
use App\Http\Controllers\AuthController;
use App\Product;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register',[AuthController::class , 'register']);
Route::post('/login', 'AuthController@login');

Route::get('/products', function(){
    return Product::all();
});

Route::get('/products/{name}', [ProductController::class, 'show']);

Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::get('/categories', function(){
        return Category::all();
        });Route::post('/cart','CartController@store');
        Route::post('/carts/addproduct/{cart}', 'CartController@addProducts');
        Route::post('/cart/show/{cart}', 'CartController@show');
        Route::post('/logout',[AuthController::class , 'logout']);

});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
