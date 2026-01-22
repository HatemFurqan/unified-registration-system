<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(){
        $today = Carbon::today();

        $statistics['today_subscribed_success'] = Subscribe::query()
            ->whereMonth('created_at', '=', $today->month)
            ->whereDay('created_at', '=', $today->day)
            ->whereYear('created_at', '=', $today->year)
            ->whereIn('payment_status', ['Captured', 'Authorized'])
            ->count();

        $statistics['today_subscribed_fail'] = Subscribe::query()
            ->whereMonth('created_at', '=', $today->month)
            ->whereDay('created_at', '=', $today->day)
            ->whereYear('created_at', '=', $today->year)
            ->whereNotIn('payment_status', ['Captured', 'Authorized'])
            ->count();

        $lastSubscribe = Subscribe::query()->orderBy('updated_at', 'DESC')->first();
        $statistics['last_try_subscription'] = $lastSubscribe ? $lastSubscribe->updated_at->timezone('Asia/Riyadh')->diffForHumans() : '-';

        return view('dashboard.index', compact('statistics'));
    }
}
