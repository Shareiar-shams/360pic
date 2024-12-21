<?php

use Illuminate\Support\Facades\Route;
use App\Models\Admin\page;
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

// Route::get('/', function () {
//     return view('user.index');
// });

Route::group(['namespace'=> 'App\Http\Controllers\User'],function(){

    try {
        $pages = page::all();
        foreach ($pages as $page) {
            $name = 'page-' . $page->slug;
            if($page->slug == '/'){
                Route::get($page->slug, 'ViewportController@index');
            }elseif ($page->controller_action != 'default') {
                Route::get('/' . $page->slug, $page->controller_action.'@index')->name($name);
            }else {
                Route::get('/pages/{' . $page->slug.'}', 'PagefrontController@show')->name($name);
            }
        }
    } catch (Exception $e) {
        echo '*************************************' . PHP_EOL;
        echo 'Error fetching database pages: ' . PHP_EOL;
        echo $e->getMessage() . PHP_EOL;
        echo '*************************************' . PHP_EOL;
    }

    //Single Product Page
    Route::get('/medibo/product/{slug}', 'ViewportController@single_product')->name('single_product');
    Route::get('/{category}/product/{id}', 'ViewportController@category_single_product')->name('category_single_product');

    //Download PDF
    Route::get('/additional-file-dump/{id}/{content}', 'ViewportController@file_download')->name('additional.file.download.frontend');

    //Cart Controller
    Route::resource('cart','CartController');
    Route::get('date-picker', 'CartController@datepicket')->name('datepicket');
    Route::post('date-picker-add', 'CartController@datepicket_add')->name('datepicket.add');
    Route::get('/checkout', 'CartController@cartTocheckout')->name('cartTocheckout');

    //Order Controller
    Route::get('/chack', 'OrderController@chack')->name('chack');
    Route::resource('order','OrderController');
    Route::post('/add-card', 'OrderController@addCard')->name('add-card');
    Route::get('/chack-user-order', 'OrderController@chack_user_order')->name('chack_user_order');

    //Invoice Download
    Route::get('/invoice-download/{id}', 'ViewportController@invoice_download')->name('invoice.download');
    //Contact Mail
    Route::post('/contact-mail', 'ViewportController@contact_email')->name('contact_email');

    Route::get('/redirect', 'SocialAuthFacebookController@redirect')->name('redirect');
    Route::get('/callback', 'SocialAuthFacebookController@callback');

    Route::get('auth/google', 'GoogleController@redirectToGoogle')->name('google.redirect');
    Route::get('auth/google/callback', 'GoogleController@handleGoogleCallback');
});

Auth::routes();

//User Dashboard
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user-profile/{slug}', [App\Http\Controllers\HomeController::class, 'user_profile'])->name('user.profile');
Route::post('/user-info-update/{id}', [App\Http\Controllers\HomeController::class, 'infoupdate'])->name('user.infoupdate');
Route::post('/user-password-update/{id}', [App\Http\Controllers\HomeController::class, 'passwordupdate'])->name('userpassword.update');
Route::get('/user/view/order/{id}', [App\Http\Controllers\HomeController::class, 'ordershow'])->name('user.order.show');
// Route::get('/user/view/order/return/{id}', [App\Http\Controllers\HomeController::class, 'returnorder'])->name('user.order.return');
// Route::post('order-return', [App\Http\Controllers\HomeController::class, 'retunrequest'])->name('returnorder.request');
Route::post('/cancel-order', [App\Http\Controllers\HomeController::class, 'cancelorder'])->name('cancel.order');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::group(['namespace'=> 'App\Http\Controllers\Admin'],function(){
    // Admin Auth
    Route::get('/admin/login', 'Auth\LoginController@showLoginForm')->name('adminLogin');
    Route::post('/admin/login', 'Auth\LoginController@login');
    Route::post('admin/logout', 'Auth\LoginController@logout')->name('adminlogout');
    
    // Admin Dashboard
    Route::get('/admin-dashboard', 'DashboardController@index')->name('admin.panel');

    //Search Route
    // Route::get('/search', 'DashboardController@search')->name('search');

    // Admin Profile
    Route::post('image-update/{id}', 'AdminProfileController@imageupdate')->name('imageupdate');
    Route::post('admin-password/{id}', 'AdminProfileController@adminpassword')->name('adminpassword.update');
    


    // ADMIN DASHBOARD ROUTE
    Route::resource('deshboard','DashboardController');
    Route::resource('admin-profile','AdminProfileController');
    //Page table route
    Route::resource('page','PageController');
    //Product Releted Route
    // Route::post('subcat', 'ProductController@subCat')->name('subcat');
    Route::post('img_dlt', 'ProductController@img_dlt')->name('img_dlt');
    Route::resource('product','ProductController');
    Route::resource('product-category','ProductCategoryController');
    //product addtional content
    Route::get('/additional-file-download/{id}/{content}', 'ProductController@file_download')->name('additional.file.download');
    // Date And Time Route
    Route::resource('datetime-set','DateTimeController');

    //User Table Route
    Route::post('customer/enable', 'CustomersController@enable')->name('customer.enable');
    Route::post('customer/disable', 'CustomersController@disable')->name('customer.disable');

    Route::resource('customers','CustomersController');

    // Order table list
    Route::resource('customers-order','ProductOrderController');

    Route::post('reply-feedback/{id}','ProductOrderController@feedback')->name('feedback');
    Route::get('/pending-order/item', 'ProductOrderController@pending_order')->name('pending_order');
    Route::get('/processing-order/item', 'ProductOrderController@processing_order')->name('processing_order');
    Route::get('/progess-order/item', 'ProductOrderController@delivery_in_progress')->name('delivery_in_progress');
    Route::get('/canceled-order/item', 'ProductOrderController@canceled_order')->name('canceled_order');

    //Revenue Analytics
    Route::get('/order/revenue/analytics', 'ProductOrderController@revenue_analytics')->name('revenue_analytics');

    //Order status change
    Route::post('order/change/status', 'ProductOrderController@change_status')->name('change_status');

    Route::resource('user-mail','ContactsMailController');
    Route::delete('myproductsDeleteAll', 'ContactsMailController@deleteAll')->name('deleteall');
});