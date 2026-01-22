<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\FavoriteTimeController;
use App\Http\Controllers\Dashboard\CouponController;
use App\Http\Controllers\Dashboard\ImportExportController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\TranslateController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\SubscribeController;
use App\Http\Controllers\Dashboard\CouponLogController;
use App\Http\Controllers\Dashboard\ConfigController;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register dashboard routes for your application.
|
*/

Route::group(['as' => 'dashboard.', 'namespace' => '\App\Http\Controllers\Auth',], function()
{
    Route::get('/login', 'AdminLoginController@showLoginForm')->name('login.form');
    Route::post('/login', 'AdminLoginController@login')->name('login.post');
});

Route::group(['middleware' => ['auth:admin'], 'as' => 'dashboard.'], function()
{
    // Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', '\App\Http\Controllers\Auth\AdminLoginController@logout')->name('logout');

    // Subscribes (مع صلاحيات)
    Route::middleware('permission:عرض-الاشتراكات')->group(function () {
        Route::get('/subscribes', [SubscribeController::class, 'index'])->name('subscribes.index');
        Route::get('/subscribes/export', [SubscribeController::class, 'export'])->name('subscribes.export');
    });
    
    Route::middleware('permission:تعديل-حالة-الدفع')->group(function () {
        Route::put('/subscribes/update-payment-status/{subscribe}', [SubscribeController::class, 'updatePaymentStatus'])->name('subscribes.updatePaymentStatus');
    });
    
    Route::middleware('permission:إرسال-إلى-جوجل-شيت')->group(function () {
        Route::get('/subscribes/send-to-google-sheet/{subscribe}', [SubscribeController::class, 'sendToGoogleSheet'])->name('subscribes.sendToGoogleSheet');
    });

    // Coupons (مع صلاحيات)
    Route::middleware('permission:عرض-الكوبونات')->group(function () {
        Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
    });
    
    Route::middleware('permission:اضافة-الكوبونات')->group(function () {
        Route::get('/coupons/create', [CouponController::class, 'create'])->name('coupons.create');
        Route::post('/coupons', [CouponController::class, 'store'])->name('coupons.store');
    });
    
    Route::middleware('permission:تعديل-الكوبونات')->group(function () {
        Route::get('/coupons/{id}/edit', [CouponController::class, 'edit'])->name('coupons.edit');
        Route::put('/coupons/{id}/update', [CouponController::class, 'update'])->name('coupons.update');
    });
    
    Route::middleware('permission:حذف-الكوبونات')->group(function () {
        Route::delete('/coupons/destroy/{id}', [CouponController::class, 'destroy'])->name('coupons.destroy');
    });
    
    Route::get('/students-names', [CouponController::class, 'getStudentsNames'])->name('students.names');

    // Coupon Logs
    Route::get('/coupon-logs', [CouponLogController::class, 'index'])->name('coupon-logs.index');
    Route::get('/coupon-logs/{id}', [CouponLogController::class, 'show'])->name('coupon-logs.show');

    // Courses
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

    // Favorite Times
    Route::get('/favorite-times', [FavoriteTimeController::class, 'index'])->name('favorite-times.index');
    Route::post('/favorite-times', [FavoriteTimeController::class, 'store'])->name('favorite-times.store');
    Route::get('/favorite-times/{id}/edit', [FavoriteTimeController::class, 'edit'])->name('favorite-times.edit');
    Route::put('/favorite-times/{id}/update', [FavoriteTimeController::class, 'update'])->name('favorite-times.update');
    Route::delete('/favorite-times/destroy/{id}', [FavoriteTimeController::class, 'destroy'])->name('favorite-times.destroy');
    Route::get('/favorite-times/create', [FavoriteTimeController::class, 'create'])->name('favorite-times.create');

    // Import/Export (مع صلاحيات)
    Route::middleware('permission:استيراد-البيانات')->group(function () {
        Route::get('/importStudents', [ImportExportController::class, 'showImportStudents'])->name('import.students.show');
        Route::post('/importStudents', [ImportExportController::class, 'importStudents'])->name('import.students.store');
        Route::get('/importCoupons', [ImportExportController::class, 'importCoupons'])->name('import.coupons.show');
    });
    
    Route::middleware('permission:تصدير-البيانات')->group(function () {
        Route::get('/export-subscribes', [ImportExportController::class, 'exportSubscribes'])->name('export.subscribes');
        Route::get('/export-unsubscribed-students', [ImportExportController::class, 'exportUnsubscribedStudents'])->name('export.unsubscribed.students');
        Route::post('/export-unsubscribed-students', [ImportExportController::class, 'exportUnsubscribedStudentsStore'])->name('export.unsubscribed.students.store');
    });

    // Roles & Admins (فقط للمشرفين)
    Route::middleware('permission:عرض-الادوار')->group(function () {
        Route::resource('roles', RoleController::class);
    });
    
    Route::middleware('permission:عرض-المسؤولين')->group(function () {
        Route::resource('admins', AdminController::class);
    });

    // Config
    Route::get('/change-time-table', [ConfigController::class, 'createTimeTable'])->name('config.createTimeTable');
    Route::post('/change-time-table', [ConfigController::class, 'storeTimeTable'])->name('config.storeTimeTable');

    // Translate
    Route::get('/language_translate/{local}', [TranslateController::class, 'show_translate'])->name('show_translate');
    Route::post('/languages/key_value_store', [TranslateController::class, 'key_value_store'])->name('languages.key_value_store');
});
