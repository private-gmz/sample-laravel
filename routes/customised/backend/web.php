<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\AdminUserController;
use App\Http\Controllers\Backend\AttributesControler;
use App\Http\Controllers\Backend\AttributesValController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\User\ReviewController;
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

Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard')->middleware('auth:admin');

// Admin All Routes

    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

    Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');

    Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');

    Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');

    // end Middleware admin

////////////////////////// Admin product role ////////////////////////////////
    Route::group(['middleware' => 'can:product'], function () {

        // Admin Attributes All Routes

        Route::prefix('Attributes')->group(function () {

            Route::get('/view', [AttributesControler::class, 'AttributesView'])->name('all.attribites');

            Route::post('/store', [AttributesControler::class, 'AttributesStore'])->name('attribites.store');

            Route::get('/update/{name}/{id}', [AttributesControler::class, 'AttributesUpdate'])->name('attribites.update');

            Route::get('/delete/{id}', [AttributesControler::class, 'AttributesDelete'])->name('attribites.delete');

        });

// Admin Attributes_Values All Routes

        Route::prefix('Values')->group(function () {

            Route::get('/view', [AttributesValController::class, 'ValuesView'])->name('all.values');

            Route::post('/store', [AttributesValController::class, 'ValuesStore'])->name('values.store');

            Route::get('/update/{name}/{id}', [AttributesValController::class, 'ValuesUpdate'])->name('values.update');

            Route::get('/delete/{id}', [AttributesValController::class, 'ValuesDelete'])->name('values.delete');

        });

        // Admin Products All Routes

        Route::prefix('product')->group(function () {

            Route::get('/add', [ProductController::class, 'AddProduct'])->name('add-product');

            Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product-store');
            Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');

            Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit');

            Route::post('/data/update', [ProductController::class, 'ProductDataUpdate'])->name('product-update');

            Route::post('/image/update', [ProductController::class, 'MultiImageUpdate'])->name('update-product-image');

            Route::post('/images/add/{productId}', [ProductController::class, 'MultiImageAdd'])->name('add-new-images');
            Route::post('/images/delete', [ProductController::class, 'MultiImageDestroy'])->name('delete-new-images');

            Route::post('/thambnail/update', [ProductController::class, 'ThambnailImageUpdate'])->name('update-product-thambnail');

            Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');

            Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');

            Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');

            Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');

        });

        // Admin Manage Review Routes
        Route::prefix('review')->group(function () {

            Route::get('/pending', [ReviewController::class, 'PendingReview'])->name('pending.review');

            Route::get('/admin/approve/{id}', [ReviewController::class, 'ReviewApprove'])->name('review.approve');

            Route::get('/publish', [ReviewController::class, 'PublishReview'])->name('publish.review');

            Route::get('/delete/{id}', [ReviewController::class, 'DeleteReview'])->name('delete.review');

        });

    });
////////////////////////// end Admin product role ////////////////////////////////

////////// Admin category role /////////////////////////////////////////////////
    Route::group(['middleware' => 'can:category'], function () {
// Admin Category all Routes
        Route::prefix('category')->group(function () {

            Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');

            Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');

            Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');

            Route::post('/update/{id}', [CategoryController::class, 'CategoryUpdate'])->name('category.update');

            Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');

// Admin Sub Category All Routes

            Route::get('/sub/view', [SubCategoryController::class, 'SubCategoryView'])->name('all.subcategory');

            Route::post('/sub/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');

            Route::get('/sub/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');

            Route::post('/update', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');

            Route::get('/sub/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');

        });
    });
////////// end Admin category role /////////////////////////////////////////////////

////////// Admin site role /////////////////////////////////////////////////
    Route::group(['middleware' => 'can:site'], function () {
// Admin Slider All Routes

        Route::prefix('slider')->group(function () {

            Route::get('/view', [SliderController::class, 'SliderView'])->name('manage-slider');

            Route::post('/store', [SliderController::class, 'SliderStore'])->name('slider.store');

            Route::get('/edit/{id}', [SliderController::class, 'SliderEdit'])->name('slider.edit');

            Route::post('/update', [SliderController::class, 'SliderUpdate'])->name('slider.update');

            Route::get('/delete/{id}', [SliderController::class, 'SliderDelete'])->name('slider.delete');

            Route::get('/inactive/{id}', [SliderController::class, 'SliderInactive'])->name('slider.inactive');

            Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');

        });

// Admin Site Setting Routes
        Route::prefix('setting')->group(function () {

            Route::get('/site', [SiteSettingController::class, 'SiteSetting'])->name('site.setting');
            Route::post('/site/update', [SiteSettingController::class, 'SiteSettingUpdate'])->name('update.sitesetting');

            Route::get('/seo', [SiteSettingController::class, 'SeoSetting'])->name('seo.setting');

            Route::post('/seo/update', [SiteSettingController::class, 'SeoSettingUpdate'])->name('update.seosetting');
        });

    });
////////// end Admin site role /////////////////////////////////////////////////

////////// Admin shipping role /////////////////////////////////////////////////
    Route::group(['middleware' => 'can:shipping'], function () {

// Admin Shipping All Routes

        Route::prefix('shipping')->group(function () {

// Ship City
            Route::get('/city/view', [ShippingAreaController::class, 'CityView'])->name('manage-city');

            Route::post('/city/store', [ShippingAreaController::class, 'CityStore'])->name('city.store');

            Route::get('/city/edit/{id}', [ShippingAreaController::class, 'CityEdit'])->name('city.edit');

            Route::post('/city/update/{id}', [ShippingAreaController::class, 'CityUpdate'])->name('city.update');

            Route::get('/city/delete/{id}', [ShippingAreaController::class, 'CityDelete'])->name('city.delete');

// Ship District
            Route::get('/district/view', [ShippingAreaController::class, 'DistrictView'])->name('manage-district');

            Route::post('/district/store', [ShippingAreaController::class, 'DistrictStore'])->name('district.store');

            Route::get('/district/edit/{id}', [ShippingAreaController::class, 'DistrictEdit'])->name('district.edit');

            Route::post('/district/update/{id}', [ShippingAreaController::class, 'DistrictUpdate'])->name('district.update');

            Route::get('/district/delete/{id}', [ShippingAreaController::class, 'DistrictDelete'])->name('district.delete');

        });

    });
////////// end Admin shipping role /////////////////////////////////////////////////

////////// Admin orders role /////////////////////////////////////////////////
    Route::group(['middleware' => 'can:orders'], function () {
// Admin Order All Routes

        Route::prefix('orders')->group(function () {

            Route::get('/pending/orders', [OrderController::class, 'PendingOrders'])->name('pending-orders');

            Route::get('/pending/orders/details/{order_id}', [OrderController::class, 'PendingOrdersDetails'])->name('pending.order.details');

            Route::get('/confirmed/orders', [OrderController::class, 'ConfirmedOrders'])->name('confirmed-orders');

            Route::get('/processing/orders', [OrderController::class, 'ProcessingOrders'])->name('processing-orders');

            Route::get('/picked/orders', [OrderController::class, 'PickedOrders'])->name('picked-orders');

            Route::get('/shipped/orders', [OrderController::class, 'ShippedOrders'])->name('shipped-orders');

            Route::get('/delivered/orders', [OrderController::class, 'DeliveredOrders'])->name('delivered-orders');

            Route::get('/cancel/orders', [OrderController::class, 'CancelOrders'])->name('cancel-orders');

            Route::get('/cancel/order/{order_id}', [OrderController::class, 'CancelRequestApprove'])->name('cancel.approve');

// Update Status
            Route::get('/pending/confirm/{order_id}', [OrderController::class, 'PendingToConfirm'])->name('pending-confirm');

            Route::get('/confirm/processing/{order_id}', [OrderController::class, 'ConfirmToProcessing'])->name('confirm.processing');

            Route::get('/processing/picked/{order_id}', [OrderController::class, 'ProcessingToPicked'])->name('processing.picked');

            Route::get('/picked/shipped/{order_id}', [OrderController::class, 'PickedToShipped'])->name('picked.shipped');

            Route::get('/shipped/delivered/{order_id}', [OrderController::class, 'ShippedToDelivered'])->name('shipped.delivered');

            Route::get('/invoice/download/{order_id}', [OrderController::class, 'AdminInvoiceDownload'])->name('invoice.download');

            Route::get('/delete/order/{order_id}', [OrderController::class, 'deleteOrder'])->name('delete.order');

        });

// Admin Return Order Routes
        Route::prefix('return')->group(function () {

            Route::get('/admin/request', [ReturnController::class, 'ReturnRequest'])->name('return.request');

            Route::get('/admin/return/approve/{order_id}', [ReturnController::class, 'ReturnRequestApprove'])->name('return.approve');

            Route::get('/admin/all/request', [ReturnController::class, 'ReturnAllRequest'])->name('all.request');

        });

    });
////////// end Admin orders role /////////////////////////////////////////////////

////////// Admin stock role /////////////////////////////////////////////////
    Route::group(['middleware' => 'can:stock'], function () {
// Admin Reports Routes
        Route::prefix('reports')->group(function () {

            Route::get('/view', [ReportController::class, 'ReportView'])->name('all-reports');

            Route::post('/search/by/date', [ReportController::class, 'ReportByDate'])->name('search-by-date');

            Route::post('/search/by/month', [ReportController::class, 'ReportByMonth'])->name('search-by-month');

            Route::post('/search/by/year', [ReportController::class, 'ReportByYear'])->name('search-by-year');

        });

// Admin Manage Stock Routes
        Route::prefix('stock')->group(function () {

            Route::get('/product', [ProductController::class, 'ProductStock'])->name('product.stock');

        });

        // Admin Coupons All Routes

        Route::prefix('coupons')->group(function () {

            Route::get('/view', [CouponController::class, 'CouponView'])->name('manage-coupon');

            Route::post('/store', [CouponController::class, 'CouponStore'])->name('coupon.store');

            Route::get('/edit/{id}', [CouponController::class, 'CouponEdit'])->name('coupon.edit');
            Route::post('/update/{id}', [CouponController::class, 'CouponUpdate'])->name('coupon.update');

            Route::get('/delete/{id}', [CouponController::class, 'CouponDelete'])->name('coupon.delete');

        });

    });
////////// end Admin stock role /////////////////////////////////////////////////

////////// Admin master role /////////////////////////////////////////////////
    Route::group(['middleware' => 'can:master'], function () {
// Admin Get All User Routes
        Route::prefix('alluser')->group(function () {

            Route::get('/view', [AdminProfileController::class, 'AllUsers'])->name('all-users');

            Route::get('/delete/{user_id}', [AdminProfileController::class, 'deleteUser'])->name('delete.user');
        });

// Admin Roles All Routes

        Route::prefix('Roles')->group(function () {

            Route::get('/view', [RoleController::class, 'RolesView'])->name('all.roles');

            Route::post('/store', [RoleController::class, 'RolesStore'])->name('roles.store');

            Route::get('/update/{name}/{id}', [RoleController::class, 'RolesUpdate'])->name('roles.update');

            Route::get('/delete/{id}', [RoleController::class, 'RolesDelete'])->name('roles.delete');

        });

// Admin User Role Routes
        Route::prefix('adminuserrole')->group(function () {

            Route::get('/all', [AdminUserController::class, 'AllAdminRole'])->name('all.admin.user');

            Route::get('/add', [AdminUserController::class, 'AddAdminRole'])->name('add.admin');

            Route::post('/store', [AdminUserController::class, 'StoreAdminRole'])->name('admin.user.store');

            Route::get('/edit/{id}', [AdminUserController::class, 'EditAdminRole'])->name('edit.admin.user');

            Route::post('/update', [AdminUserController::class, 'UpdateAdminRole'])->name('admin.user.update');

            Route::get('/delete/{id}', [AdminUserController::class, 'DeleteAdminRole'])->name('delete.admin.user');

        });

    });
////////// end Admin master role /////////////////////////////////////////////////

});
