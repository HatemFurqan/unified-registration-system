<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    /**
     * Apply coupon
     * 
     * @return JsonResponse
     */
    public function applyCoupon()
    {
        $coupon_code = request()->coupon_code;
        $course_code = request()->course_code ?? 'regular';
        
        $course = Course::query()->where('code', $course_code)->first();
        
        if (!$course) {
            return response()->json([
                'status' => false,
                'message' => __('Course not found')
            ], 404);
        }

        $coupon = Coupon::where('code', $coupon_code)
            ->where('course_id', $course->id)
            ->first();

        if (!$coupon) {
            return response()->json([
                'status' => false,
                'message' => __('Coupon not found')
            ], 404);
        }

        $student_id = Session::get('student_id');
        Session::put('student_id', $student_id);

        if (!$coupon->is_valid) {
            return response()->json([
                'status' => false,
                'message' => __('Coupon is not valid')
            ], 404);
        }

        $amount = $course->amount;
        $discount = $coupon->getDiscount($amount);
        $final_amount = ($amount - $discount) / 100;

        return response()->json([
            'status' => true,
            'discount' => $discount / 100,
            'final_amount' => $final_amount,
            'coupon_code' => $coupon->code
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
