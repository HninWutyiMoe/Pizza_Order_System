<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderListController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use App\Models\Order;

Route::middleware(['admin_auth'])->group(function () {

    Route::redirect('/', 'loginPage');

    // loginPage in auth
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {
    // Check Admin or User
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::middleware(['admin_auth'])->group(function () {

        // Admin account
        Route::prefix('admin')->group(function () {
            // PasswordChange

            Route::get('changePassword', [AdminController::class, 'changePassword'])->name('admin#changePassword');
            Route::post('changingPassword', [AdminController::class, 'changing'])->name('admin#changingPw');

            // Profile Deteils
            Route::get('adminProfile', [AdminController::class, 'profile'])->name('admin#profile');

            Route::get('editProfile', [AdminController::class, 'editProfile'])->name('admin#editProfile');
            Route::post('updateProfile/{id}', [AdminController::class, 'updateProfile'])->name('admin#updateProfile');

            // Admin list
            Route::get('list', [AdminController::class, 'list'])->name('admin#list');
            Route::get('delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');
            // Route::get('changeRole/{id}', [AdminController::class, 'changeRole'])->name('admin#changeRole');
            // Route::post('changeRole/{id}', [AdminController::class, 'change'])->name('admin#change');
            Route::get('admin/change/role', [AdminController::class, 'changeRole'])->name('admin#ChangeRole');
            Route::get('viewing/{id}', [AdminController::class, 'view'])->name('admin#view');
        });

        //Category
        Route::prefix('category')->group(function () {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');

            Route::get('create/page', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');

            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');

            Route::get('editPage/{id}', [CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        });

        // Products
        Route::prefix('products')->group(function () {
            //
            Route::get('pizzaList', [ProductController::class, 'list'])->name('product#list');

            Route::get('create', [ProductController::class, 'create'])->name('product#create');
            Route::post('create', [ProductController::class, 'productCreate'])->name('product#creating');

            Route::get('delete/{id}', [ProductController::class, 'delete'])->name('pizza#delete');

            Route::get('detail/{id}', [ProductController::class, 'detail'])->name('detail#product');

            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit#product');
            Route::post('update', [ProductController::class, 'update'])->name('update#product');
        });

        // OrderList
        Route::prefix('order')->group(function () {
            Route::get('orderList', [OrderController::class, 'list'])->name('admin#orderList');
            Route::get('ajax/changeStatus', [OrderController::class, 'changeStatus'])->name('admin#statusChange');
            Route::get('searchStatus', [OrderController::class, 'searchStatus'])->name('admin#searchStatus');
            // CodeView
            Route::get('codeView/{code}', [OrderController::class, 'codeView'])->name('admin#codeView');
        });

        // User List
        Route::prefix('user')->group(function () {
            Route::get('userList', [UserController::class, 'userList'])->name('admin#userList');
            Route::get('change/role', [UserController::class, 'userChangeRole'])->name('admin#userChangeRole');
            Route::get('delete/{id}', [UserController::class, 'accDelete'])->name('user#delete');
            Route::get('viewing/{id}', [UserController::class, 'view'])->name('user#view');
        });
        // Dashboard
        Route::get('adminDashboard', [AdminController::class, 'adminHome'])->name('admin#dashboard');
        // Receive mail from user
        Route::get('mailFromUser',[AdminController::class,'receiveMail'])->name('admin#receiveMail');
    });

    // User_Side...................................................................

    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {

        Route::get('/mainPage', [UserController::class, 'home'])->name('user#home');
        Route::get('/filter/{id}', [UserController::class, 'filter'])->name('user#filter');
        // OrderHistory
        Route::get('/history', [UserController::class, 'history'])->name('user#history');

        // User Account
        Route::prefix('account')->group(function () {
            Route::get('changePassword', [UserController::class, 'changePassword'])->name('user#changePassword');
            Route::post('changePassword', [UserController::class, 'change'])->name('user#change');

            Route::get('changeProfile', [UserController::class, 'changeProfile'])->name('user#changeProfile');
            Route::post('changeProfile/{id}', [UserController::class, 'update'])->name('user#update');
        });

        Route::prefix('pizza')->group(function () {
            Route::get('details/{id}', [UserController::class, 'pizzaDetails'])->name('user#pizzaDetails');
        });

        // Cart List
        Route::prefix('cart')->group(function () {
            Route::get('cartList', [UserController::class, 'cartList'])->name('user#cartList');
        });

        Route::prefix('ajax')->group(function () {
            Route::get('pizzaList', [AjaxController::class, 'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart', [AjaxController::class, 'addToCart'])->name('ajax#addToCart');

            Route::get('orderList', [AjaxController::class, 'orderList'])->name('ajax#orderList');

            Route::get('clear/cart', [AjaxController::class, 'clearCart'])->name('ajax#clearCart');
            Route::get('cancleProduct', [AjaxController::class, 'cancle'])->name('ajax#cancleBtn');

            Route::get('increase/viewCount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');
        });

        // Contact
        Route::prefix('contact')->group(function () {
           Route::get('contactForm',[ContactController::class,'contact'])->name('user#contact');
           Route::post('contact',[ContactController::class,'contacting'])->name('user#contacting');
        });
    });
});

// Route::get('webTesting',function(){
//     $data = [
//         'message' => 'this is webTesting'
//     ];
//    return response()->json($data,200);
// });
