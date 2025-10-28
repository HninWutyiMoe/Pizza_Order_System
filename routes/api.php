<?php

use App\Http\Controllers\API\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('apiTesting',function(){
//     $data = [
//         'message' => 'this is APItesting'
//     ];
//    return response()->json($data,200);
// });

// GET METHOD
Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']);
Route::get('orderList/list',[RouteController::class,'orderList']);
Route::get('contact/list',[RouteController::class,'contactList']);

// POST Method () For Category
Route::post('create/category',[RouteController::class,'createCategory']);
Route::post('delete/category',[RouteController::class,'deleteCategory']);
Route::post('category/details',[RouteController::class,'categoryDetail']);
Route::post('category/update',[RouteController::class,'categoryUpdate']);

//For Contact
Route::post('create/contact',[RouteController::class,'createContact']);
Route::get('delete/contact/{id}',[RouteController::class,'deleteContact']);
Route::get('contact/details/{id}',[RouteController::class,'contactDetail']);


 /* *
 *
 * //productList
 * //localhost:8000/api/product/list (Get)
 *
 * //localhost:8000/api/create/category (Post)
 * //localhost:8000/api/delete/category (Post)
 * //localhost:8000/api/category/details (Post)
 * //localhost:8000/api/category/update (Post)
 *
 * //localhost:8000/api/create/contact (Post)
 * //localhost:8000/api/delete/contact/ (Get)
 * //localhost:8000/api/contact/details/ (Get)
 */
