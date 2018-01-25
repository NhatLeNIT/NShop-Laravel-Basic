<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::prefix('v1')->group(function () {
    Route::get('category', 'Api\CategoryController@index');
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('product-by-category', 'Api\ProductController@indexProductByCategoryId');
    Route::get('product-popular', 'Api\ProductController@indexProductPopular');
    Route::get('product-sales', 'Api\ProductController@indexProductSales');
    Route::get('product-random', 'Api\ProductController@indexProductRandom');
    Route::get('product-promotion', 'Api\ProductController@indexProductPromotion');
    Route::get('product/{id}', 'Api\ProductController@indexProduct');
    Route::get('slider', 'Api\SliderController@index');
    Route::get('comment/{id}', 'Api\CommentController@index');
    Route::post('comment', 'Api\CommentController@store');
    Route::post('order', 'Api\OrderController@store');
    Route::post('search', 'Api\ProductController@indexProductByKeyword');
    Route::post('reset', 'Auth\ResetPasswordController@reset');
    Route::get('get', function () {
       $data = \App\Models\OrderDetail::limit(10)->get();
       return response()->json($data, 200);
    });
});
