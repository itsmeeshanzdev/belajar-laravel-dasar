<?php

use App\Http\Controllers\HelloController;
use Illuminate\Support\Facades\Route;

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

Route::get('/pzn', function () {
    return "Hello Programmer Zaman Now";
});

Route::get('/hello', function () {
    return view('hello', ['name' => 'Shandika']);
});

Route::get('/world', function () {
    return view('hello.world', ['name' => 'Shandika']);
});

Route::redirect('/youtube', '/pzn');

Route::fallback(function () {
    return "404 By Shandikadav";
});

route::get('/products/{id}', function ($productId) {
    return "Product $productId";
})->name('product.detail');

route::get('/products/{products}/items/{item}', function ($productId, $itemId) {
    return "Product $productId, Item $itemId";
})->name('product.item.detail');

route::get('/categories/{id}', function ($categoryId) {
    return "Category $categoryId";
})->where('id', '[0-9]+')->name('category.detail');

route::get('users/{id?}', function ($userId = '404') {
    return "User $userId";
})->name('user.detail');

route::get('/produk/{id}', function ($id) {
    $link = route('product.detail', ['id' => $id]);
    return "Link $link";
});

route::get('produk-redirect/{id}', function ($id) {
    return redirect()->route('product.detail', ['id' => $id]);
});

route::get('/controller/hello/request', [HelloController::class, 'request']);

route::get('/controller/hello/{name}', [HelloController::class, 'hello']);
