<?php

use App\Http\Controllers\PageController;
use App\Models\Config;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

$menu = Config::where('type', 'menu_url')->first();

if ($menu) {
    $menu = $menu['value'];
} else {
    $menu = '/welcome/';
}

Route::get($menu . '{table_token}', [PageController::class, 'welcome'])->name('welcome');

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    dd('Storage linked!');
});
Route::get('/db-seed', function () {
    Artisan::call('db:seed --class=OutlerSeeder');
    dd('db seeded!');
});
Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    dd('config cleared!');
});
Route::get('/migrate', function () {
    Artisan::call('migrate', [
        '--force' => true,
    ]);
    dd('migrated!');
});

Route::get('/menu/{type}', [PageController::class, 'menu'])->name('menu');
Route::get('/category/{id}', [PageController::class, 'category'])->name('category');
Route::get('/banner/{id}', [PageController::class, 'banner'])->name('banner');
Route::get('/detail/{id}', [PageController::class, 'detail'])->name('detail_menu');
Route::get('/cart-detail', [PageController::class, 'cart_detail'])->name('cart_detail');
Route::get('/payment-method', [PageController::class, 'payment_method'])->name('payment-method');
Route::get('/order-success', [PageController::class, 'order_success'])->name('order_success');
Route::get('/bill-list', [PageController::class, 'bill_list'])->name('bill');
Route::get('/detail-order/{id}', [PageController::class, 'detail_order'])->name('detail_order');
Route::get('/pay_now', [PageController::class, 'pay_now'])->name('pay_now');
Route::get('/generateInvoice', [PageController::class, 'generateInvoice'])->name('generateInvoice');
Route::get('/xendit-payment/success/{type}/{order_id}', [PageController::class, 'payment_success'])->name('payment_success');
Route::get('/request_payment/{id}', [PageController::class, 'request_payment'])->name('request_payment');


Route::get('/not_found', function(){
    return view('welcome');
})->name('not_found');
