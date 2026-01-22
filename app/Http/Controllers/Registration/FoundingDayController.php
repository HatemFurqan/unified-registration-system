<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\NewStudent;
use App\Models\Subscribe;
use App\Service\Payment\Checkout;
use App\Enums\FormType;
use App\Traits\FilesHelper;
use Checkout\CheckoutApiException;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FoundingDayController extends Controller
{
    use FilesHelper;

    private $date1;
    private $date2;

    public function __construct()
    {
        $this->date1 = Carbon::today()->addMonth()->format('Y-m-d');
        $this->date2 = Carbon::today()->addMonths(2)->format('Y-m-d');
    }

    public function index()
    {
        session()->forget('error');
        session()->forget('success');

        $countries = Country::query()->where('lang', '=', App::getLocale())->get();
        $course = Course::query()->where('code', '=', 'founding-day')->first();

        return view('founding-day.index', [
            'countries' => $countries, 
            'course' => $course,
            'date1' => $this->date1,
            'date2' => $this->date2
        ]);
    }

    public function thankYouPage()
    {
        $subscribeId = session()->get('subscribe_id');
        $ckoSessionId = request()->query('cko-session-id');
        $countries = Country::query()->where('lang', '=', App::getLocale())->get();
        $course = Course::query()->where('code', '=', 'founding-day')->first();

        if ($ckoSessionId) {
            try {
                $data = (new Checkout())->getPaymentDetails($ckoSessionId);
                $response = $data->http_metadata;
                
                if ($response->getStatusCode() != 404) {
                    $subscribe = Subscribe::query()
                        ->where('payment_id', '=', $data->id)
                        ->with('newStudent')
                        ->first();
                        
                    if ($data->approved) {
                        $this->setStudentSerialNumber($subscribe->newStudent, $subscribe);
                        $this->setUsedCoupon($subscribe);

                        $subscribe->update([
                            'payment_status' => $data->status,
                            'response_code' => $data->actions[0]->response_code ?? 0,
                        ]);

                        session()->flash('success', __('resubscribe.The registration process has been completed successfully'));
                    } else {
                        $subscribe->update([
                            'payment_status' => $data->status,
                            'response_code' => $data->actions[0]->response_code ?? '-',
                        ]);
                        session()->flash('error', __('resubscribe.Payment failed'));
                    }
                } else {
                    session()->flash('error', __('resubscribe.Payment failed'));
                }
            } catch (CheckoutApiException $e) {
                session()->flash('error', __('resubscribe.Payment failed'));
            }
        } elseif ($subscribeId) {
            $subscribe = Subscribe::query()
                ->where('id', '=', $subscribeId)
                ->with('newStudent')
                ->first();
                
            if ($subscribe && $course) {
                $courseDiscount = $this->getCourseAmountAfterDiscount($subscribe->coupon_code, $course);
                if ($courseDiscount->discount == $course->amount) {
                    $this->setStudentSerialNumber($subscribe->newStudent, $subscribe);
                    $this->setUsedCoupon($subscribe);
                    
                    $subscribe->update([
                        'payment_status' => 'Captured',
                        'response_code' => 0,
                    ]);
                    
                    session()->flash('success', __('resubscribe.The registration process has been completed successfully'));
                }
            }
        }

        if (! (session('error') || session('success')) ) {
            return redirect()->route('registration.founding-day.index');
        }

        return view('founding-day.thank-you', ['countries' => $countries, 'course' => $course]);
    }

    public function getStudentInfo()
    {
        // منطق خاص بيوم التأسيس
        return response()->json(['name' => '', 'amount' => ''], 500);
    }

    public function resubscribe(Request $request)
    {
        // منطق التسجيل ليوم التأسيس
        return redirect()->route('registration.founding-day.thankYouPage');
    }

    private function setStudentSerialNumber($newStudent, $subscribe)
    {
        if (is_null($subscribe->student_id) && $newStudent) {
            $last_new_serial_number = NewStudent::query()
                ->where('section', '=', $newStudent->section)
                ->where('branch', '=', $newStudent->branch)
                ->max('serial_number');

            $is_test = ($subscribe->email == 'aziz@furqangroup.com');

            if(empty($last_new_serial_number) && $newStudent->section == '1' && empty($newStudent->serial_number) && !$is_test) {
                $newStudent->update([
                    'serial_number' => env('LAST_NEW_SERIAL_NUMBER_MALES') + 1,
                ]);
            }elseif(empty($last_new_serial_number) && $newStudent->section == '2' && empty($newStudent->serial_number) && !$is_test){
                $newStudent->update([
                    'serial_number' => env('LAST_NEW_SERIAL_NUMBER_FEMALES') + 1,
                ]);
            }else{
                if (empty($newStudent->serial_number) && !$is_test){
                    $newStudent->update([
                        'serial_number' => $last_new_serial_number + 1,
                    ]);
                }
            }
        }
    }

    private function setUsedCoupon($subscribe)
    {
        $coupon = Coupon::find($subscribe->coupon_id);
        $student_id = $subscribe->student_id ?? $subscribe->new_student_id;

        if ($coupon && @$coupon->is_valid){
            $coupon->use($student_id);
        }
    }

    private function getCourseAmountAfterDiscount($coupon_code, $course)
    {
        $discount = 0;
        if ($coupon_code) {
            $coupon = Coupon::where('code', $coupon_code)->where('course_id', $course->id)->first();
            if ($coupon && @$coupon->is_valid) {
                $discount = $coupon->getDiscount($course->amount);
            }
        }
        return (object)['discount' => $discount];
    }

    // تم نقل Apple Pay و Google Pay methods إلى PaymentController الموحد
    // يمكن استخدام Routes الموحدة: payment.applePayValidateMerchant, payment.applePayValidateToken, payment.googlePayValidateToken
}
