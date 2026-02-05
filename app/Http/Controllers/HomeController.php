<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\FormType;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HomeController extends Controller
{
    /**
     * Show the wizard page as the default home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('wizard');
    }

    /**
     * Show the registration forms cards page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function forms()
    {
        // Get current locale or default to 'ar'
        $locale = app()->getLocale();
        
        // Get all registration forms with localized routes
        $forms = [
            [
                'id' => 'regular',
                'name' => __('منتظمين'),
                'name_en' => 'Regular Students',
                'route' => LaravelLocalization::getLocalizedURL($locale, route('registration.regular.index', [], false)),
                'icon' => 'fa-users',
                'color' => '#25408f',
                'description' => __('استمارة تسجيل الطلاب المنتظمين'),
                'description_en' => 'Registration form for regular students',
            ],
            [
                'id' => 'new-students',
                'name' => __('طلاب جدد'),
                'name_en' => 'New Students',
                'route' => LaravelLocalization::getLocalizedURL($locale, route('registration.new-students.index', [], false)),
                'icon' => 'fa-user-plus',
                'color' => '#28a745',
                'description' => __('استمارة تسجيل الطلاب الجدد عبر الإنترنت'),
                'description_en' => 'Online registration form for new students',
            ],
            [
                'id' => 'one-to-one',
                'name' => __('فردي'),
                'name_en' => 'One-to-One',
                'route' => LaravelLocalization::getLocalizedURL($locale, route('registration.one-to-one.index', [], false)),
                'icon' => 'fa-user',
                'color' => '#dc3545',
                'description' => __('استمارة تسجيل الدروس الفردية'),
                'description_en' => 'Registration form for one-to-one lessons',
            ],
            [
                'id' => 'workshops',
                'name' => __('ورش'),
                'name_en' => 'Workshops',
                'route' => LaravelLocalization::getLocalizedURL($locale, route('registration.workshops.index', [], false)),
                'icon' => 'fa-chalkboard-teacher',
                'color' => '#ffc107',
                'description' => __('استمارة تسجيل الطلاب الجدد للورش'),
                'description_en' => 'Registration form for workshops',
            ],
            [
                'id' => 'daily-wird',
                'name' => __('الورد اليومي'),
                'name_en' => 'Daily Portion',
                'route' => LaravelLocalization::getLocalizedURL($locale, route('registration.daily-wird.index', [], false)),
                'icon' => 'fa-book-open',
                'color' => '#17a2b8',
                'description' => __('استمارة تسجيل الورد اليومي'),
                'description_en' => 'Registration form for daily portion',
            ],
            [
                'id' => 'founding-day',
                'name' => __('يوم التأسيس'),
                'name_en' => 'Founding Day',
                'route' => LaravelLocalization::getLocalizedURL($locale, route('registration.founding-day.index', [], false)),
                'icon' => 'fa-calendar-alt',
                'color' => '#6f42c1',
                'description' => __('استمارة تسجيل لحدث يوم التأسيس'),
                'description_en' => 'Registration form for founding day event',
            ],
        ];

        return view('home', compact('forms'));
    }
}
