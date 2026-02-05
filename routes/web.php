<?php

use App\Http\Controllers\Registration\RegularStudentsController;
use App\Http\Controllers\Registration\NewStudentsController;
use App\Http\Controllers\Registration\OneToOneController;
use App\Http\Controllers\Registration\WorkshopsController;
use App\Http\Controllers\Registration\DailyWirdController;
use App\Http\Controllers\Registration\FoundingDayController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HomeController;
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

// Home page - Wizard (Default)
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Forms page - Registration Forms Cards (Alternative)
Route::get('/forms', [App\Http\Controllers\HomeController::class, 'forms'])->name('forms');

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function() {
    
    // استمارة المنتظمين - RegularStudentsController
    Route::prefix('regular')->group(function () {
        Route::get('/', [RegularStudentsController::class, 'index'])->name('registration.regular.index');
        Route::post('/submit/re-subscribe', [RegularStudentsController::class, 'resubscribe'])->name('registration.regular.resubscribe');
        Route::get('/get-student-info', [RegularStudentsController::class, 'getStudentInfo'])->name('registration.regular.getStudentInfo');
        Route::get('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('registration.regular.applyCoupon');
        Route::get('/thank-you', [RegularStudentsController::class, 'thankYouPage'])->name('registration.regular.thankYouPage');
    });
    
    // طلاب جدد أونلاين - NewStudentsController
    Route::prefix('new-students')->group(function () {
        Route::get('/', [NewStudentsController::class, 'index'])->name('registration.new-students.index');
        Route::post('/submit/re-subscribe', [NewStudentsController::class, 'resubscribe'])->name('registration.new-students.resubscribe');
        Route::get('/get-student-info', [NewStudentsController::class, 'getStudentInfo'])->name('registration.new-students.getStudentInfo');
        Route::get('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('registration.new-students.applyCoupon');
        Route::get('/thank-you', [NewStudentsController::class, 'thankYouPage'])->name('registration.new-students.thankYouPage');
    });
    
    // الفردي - OneToOneController
    Route::prefix('one-to-one')->group(function () {
        Route::get('/', [OneToOneController::class, 'index'])->name('registration.one-to-one.index');
        Route::post('/submit/re-subscribe', [OneToOneController::class, 'resubscribe'])->name('registration.one-to-one.resubscribe');
        Route::get('/get-student-info', [OneToOneController::class, 'getStudentInfo'])->name('registration.one-to-one.getStudentInfo');
        Route::get('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('registration.one-to-one.applyCoupon');
        Route::get('/thank-you', [OneToOneController::class, 'thankYouPage'])->name('registration.one-to-one.thankYouPage');
    });
    
    // طلاب جدد ورش - WorkshopsController
    Route::prefix('workshops')->group(function () {
        Route::get('/', [WorkshopsController::class, 'index'])->name('registration.workshops.index');
        Route::post('/submit/re-subscribe', [WorkshopsController::class, 'resubscribe'])->name('registration.workshops.resubscribe');
        Route::get('/get-student-info', [WorkshopsController::class, 'getStudentInfo'])->name('registration.workshops.getStudentInfo');
        Route::get('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('registration.workshops.applyCoupon');
        Route::get('/thank-you', [WorkshopsController::class, 'thankYouPage'])->name('registration.workshops.thankYouPage');
    });
    
    // الورد اليومي - DailyWirdController
    Route::prefix('daily-wird')->group(function () {
        Route::get('/', [DailyWirdController::class, 'index'])->name('registration.daily-wird.index');
        Route::post('/submit/re-subscribe', [DailyWirdController::class, 'resubscribe'])->name('registration.daily-wird.resubscribe');
        Route::get('/get-student-info', [DailyWirdController::class, 'getStudentInfo'])->name('registration.daily-wird.getStudentInfo');
        Route::get('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('registration.daily-wird.applyCoupon');
        Route::get('/thank-you', [DailyWirdController::class, 'thankYouPage'])->name('registration.daily-wird.thankYouPage');
    });
    
    // يوم التأسيس - FoundingDayController
    Route::prefix('founding-day')->group(function () {
        Route::get('/', [FoundingDayController::class, 'index'])->name('registration.founding-day.index');
        Route::post('/submit/re-subscribe', [FoundingDayController::class, 'resubscribe'])->name('registration.founding-day.resubscribe');
        Route::get('/get-student-info', [FoundingDayController::class, 'getStudentInfo'])->name('registration.founding-day.getStudentInfo');
        Route::get('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('registration.founding-day.applyCoupon');
        Route::get('/thank-you', [FoundingDayController::class, 'thankYouPage'])->name('registration.founding-day.thankYouPage');
    });
    
    // Routes مشتركة (Apple Pay, Google Pay) - PaymentController موحد
    Route::post('/validate-apple-pay-merchant', [PaymentController::class, 'applePayValidateMerchant'])->name('payment.applePayValidateMerchant');
    Route::get('/validate-apple-pay-merchant', [PaymentController::class, 'applePayValidateMerchant'])->name('payment.applePayValidateMerchant');
    Route::post('/validate-apple-pay-token', [PaymentController::class, 'applePayValidateToken'])->name('payment.applePayValidateToken');
    Route::post('/validate-google-pay-token', [PaymentController::class, 'googlePayValidateToken'])->name('payment.googlePayValidateToken');
    
    // Import routes
    Route::get('/importCountries', [ImportController::class, 'importCountries'])->name('import.countries');
    Route::get('/importStudents', [ImportController::class, 'importStudents'])->name('import.students');
    Route::get('/importCoupons', [ImportController::class, 'importCoupons'])->name('import.coupons');
});

Route::get('/clear-cache', function() {
    \Artisan::call('optimize:clear');
    echo "Cleared";
});

Auth::routes();

// Old home route - redirect to dashboard if authenticated, otherwise to home
Route::get('/home', function() {
    if (auth()->check()) {
        return redirect()->route('dashboard.home');
    }
    return redirect()->route('home');
})->name('home.old');
