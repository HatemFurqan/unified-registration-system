<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CouponLog;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;

class CouponLogController extends Controller
{
    public static function getDeviceName()
    {
        $device = '-';
        if (Agent::isDesktop()){
            $device = 'desktop';
        }elseif(Agent::isTablet()){
            $device = 'tablet';
        }elseif(Agent::isPhone()){
            $device = 'phone';
        }

        return $device;
    }

    public static function getBrowserInfo()
    {
        $browser = Agent::browser();
        $browser_version = Agent::version($browser);

        return $browser . ' - ' . $browser_version;
    }

    public static function getOsInfo()
    {
        $os = Agent::platform();
        $version = Agent::version($os);

        return $os . ' - ' . $version;
    }

    public static function storeLog($options)
    {
        CouponLog::query()->create([
            'email' => @$options['email'],
            'std_number' => @$options['std_number'],
            'coupon_code' => @$options['coupon_code'],
            'discount_value' => @$options['discount_value'],
            'type' => @$options['type'],
            'start_date' => @$options['start_date'],
            'end_date' => @$options['end_date'],
            'ip' => request()->ip(),
            'device' => static::getDeviceName(),
            'browser_info' => static::getBrowserInfo(),
            'operating_system' => static::getOsInfo(),
            'url' => request()->url(),
        ]);
    }

    public function index()
    {
        $logs = CouponLog::query()->orderByDesc('created_at')->paginate(20);

        return view('dashboard.coupon-logs.index', compact('logs'));
    }

    public function show($id)
    {
        $log = CouponLog::query()->findOrFail($id);

        return view('dashboard.coupon-logs.show', compact('log'));
    }
}
