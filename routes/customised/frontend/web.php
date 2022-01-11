<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\WishlistController;
use App\Models\User;
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

// User ALL Routes
Route::get('/', [IndexController::class, 'index']);
Route::middleware(['auth:web'])->group(function () {

    Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('dashboard', compact('user'));
    })->name('dashboard');

    Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');

    Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');

    Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');

    Route::get('/user/change/password', [IndexController::class, 'UserChangePassword'])->name('change.password');

    Route::post('/user/password/update', [IndexController::class, 'UserPasswordUpdate'])->name('user.password.update');
}); // end Middleware web

//// Frontend All Routes /////

// Frontend Product Details Page url
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);

// Frontend Product Tags Page
Route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct']);

// Frontend SubCategory wise Data
Route::get('/subcategory/product/{subcat_id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);

// Frontend Category wise Data
Route::get('/category/product/{cat_id}', [IndexController::class, 'CatWiseProduct']);

// Frontend Sub-SubCategory wise Data
Route::get('/subsubcategory/product/{subsubcat_id}/{slug}', [IndexController::class, 'SubSubCatWiseProduct']);

// Product View Modal with Ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

// cart and wishlist
// Add to Cart Store Data
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

// Get Data from mini cart
Route::get('/product/mini/cart/', [CartController::class, 'AddMiniCart']);

// Remove mini cart
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

// Add to Wishlist
Route::post('/add-to-wishlist/{product_id}', [CartController::class, 'AddToWishlist']);

////////////// show cart to only auth user ///////////////////////
Route::group(['middleware' => ['user', 'auth']], function () {
// My Cart Page All Routes
    Route::get('/mycart', [CartPageController::class, 'MyCart'])->name('mycart');

    Route::get('/user/get-cart-product', [CartPageController::class, 'GetCartProduct']);

    Route::get('/user/cart-remove/{rowId}', [CartPageController::class, 'RemoveCartProduct']);

    Route::get('/cart-increment/{rowId}', [CartPageController::class, 'CartIncrement']);

    Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'CartDecrement']);
});

/////////////////////  User Must Login  ////
Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'User'], function () {

// Wishlist page
    Route::get('/wishlist', [WishlistController::class, 'ViewWishlist'])->name('wishlist');

    Route::get('/get-wishlist-product', [WishlistController::class, 'GetWishlistProduct']);

    Route::get('/wishlist-remove/{id}', [WishlistController::class, 'RemoveWishlistProduct']);

    Route::post('/cash/order', [CashController::class, 'CashOrder'])->name('cash.order');

    Route::get('/my/orders', [AllUserController::class, 'MyOrders'])->name('my.orders');

    Route::get('/order_details/{order_id}', [AllUserController::class, 'OrderDetails']);

    Route::get('/invoice_download/{order_id}', [AllUserController::class, 'InvoiceDownload']);

    Route::post('/return/order/{order_id}', [AllUserController::class, 'ReturnOrder'])->name('return.order');

    Route::post('/cancel/order/{order_id}', [AllUserController::class, 'CancelOrder'])->name('return.cancel');

    Route::get('/return/order/list', [AllUserController::class, 'ReturnOrderList'])->name('return.order.list');

    Route::get('/cancel/orders', [AllUserController::class, 'CancelOrders'])->name('cancel.orders');

/// Order Traking Route
    Route::get('/order/tracking', [AllUserController::class, 'OrderTraking'])->name('order.tracking');

});

// Frontend Coupon Option

Route::post('/coupon-apply', [CartController::class, 'CouponApply']);

Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);

Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

// Checkout Routes

Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');

Route::get('/district-get/ajax/{city_id}', [CheckoutController::class, 'DistrictGetAjax']);

Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout.store');

/// Frontend Product Review Routes

Route::post('/review/store', [ReviewController::class, 'ReviewStore'])->name('review.store');

/// Product Search Route
Route::post('/search', [IndexController::class, 'ProductSearch'])->name('product.search');

// Advance Search Routes
Route::post('search-product', [IndexController::class, 'SearchProduct']);

// Shop Page Route
Route::get('/shop', [ShopController::class, 'ShopPage'])->name('shop.page');
Route::post('/shop/filter', [ShopController::class, 'ShopFilter'])->name('shop.filter');
