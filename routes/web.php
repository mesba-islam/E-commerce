<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\NewslaterController;

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

Route::get('/', function () {
    return view('pages.index');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'role:admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'role:admin')->group(function () {
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/admin/dashboard','Index')->name('dashboard');
    });

    Route::controller(CategoryController::class)->group(function(){
        Route::get('/admin/all-category','Category')->name('allcategory');
        Route::get('/admin/add-category','AddCategory')->name('addcategory');
        Route::post('/admin/store-category','StoreCategory')->name('storecategory');
        Route::get('/admin/edit-category/{id}','EditCategory')->name('editcategory');
        Route::post('/admin/update-category','UpdateCategory')->name('updatecategory');
        Route::get('/admin/delete-category/{id}','DeleteCategory')->name('deletecategory');
    });

    Route::controller(SubCategoryController::class)->group(function(){
    Route::get('/admin/add-subcategory', 'AddSubCategory')->name('addsubcategory');
    Route::post('/admin/store-subcategory','StoreSubCategory')->name('storesubcategory');
    Route::get('/admin/all-subcategory','SubCategory')->name('allsubcategory');
    Route::get('/admin/edit-subcategory/{id}','EditSubCategory')->name('editsubcategory');
    Route::post('/admin/update-subcategory','UpdateSubCategory')->name('updatesubcategory');
    Route::get('/admin/delete-subcategory/{id}','DeleteSubCategory')->name('deletesubcategory');
    });

    Route::controller(ProductController::class)->group(function(){

        Route::get('/admin/create-product','CreateProduct')->name('createproduct');
        Route::post('/admin/store-product','storeProduct')->name('storeproduct');
        Route::post('/admin/ajax-subcat','ajaxSubcat')->name('ajax.subcat');
        Route::get('/admin/all-product','allProduct')->name('allproduct');
        // Route::get('/admin/test', 'test')->name('test');
        Route::get('/admin/edit-product/{id}','editProduct')->name('edit.product');
        Route::post('/admin/ajax-subcategory','ajaxSubcategory')->name('ajax.subcategory');
        Route::post('/admin/update-product/{id}','updateProduct')->name('update.product');
        Route::get('/admin/delete-product/{id}','deleteProduct')->name('delete.product');
    });

     Route::get('/admin/add-coupon', [CouponController::class, 'addCoupon'])->name('add.coupon');
     Route::post('/admin/store-coupon', [CouponController::class, 'storeCoupon'])->name('store.coupon');
     Route::get('/admin/all-coupon', [CouponController::class, 'allCoupon'])->name('all.coupon');
     Route::get('/admin/edit-coupon/{id}', [CouponController::class, 'editCoupon'])->name('edit.coupon');
     Route::post('/admin/update-coupon/{id}', [CouponController::class, 'updateCoupon'])->name('update.coupon');
     Route::get('/admin/delete-coupon/{id}', [CouponController::class, 'deleteCoupon'])->name('delete.coupon');

    //Newslaters
    Route::get('/admin/newslater', [NewslaterController::class, 'Newslater'])->name('newslater');
    Route::post('/store/newslater', [NewslaterController::class, 'storeNewslater'])->name('store.newslater');
});


require __DIR__.'/auth.php';
