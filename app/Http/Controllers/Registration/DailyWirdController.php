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
use Illuminate\Http\Request;

class DailyWirdController extends Controller
{
    use FilesHelper;

    public function index()
    {
        session()->forget('error');
        session()->forget('success');

        $countries = Country::query()->where('lang', '=', App::getLocale())->get();
        $course_35 = Course::query()->where('code', 'minutes_35')->first();
        $course_70 = Course::query()->where('code', 'minutes_70')->first();

        return view('daily-wird.index', [
            'countries' => $countries,
            'course_35' => $course_35,
            'course_70' => $course_70,
        ]);
    }

    public function thankYouPage()
    {
        $course_type = session()->get('course_type');
        $countries = Country::query()->where('lang', '=', App::getLocale())->get();
        $course = Course::query()->findOrFail($course_type);

        if(request()->query('cko-session-id')){
            try {
                $data = (new Checkout())->getPaymentDetails(request()->query('cko-session-id'));
                $response = $data->http_metadata;

                if ($response->getStatusCode() != 404){
                    $subscribe = Subscribe::query()
                        ->where('payment_id', '=', $data->id)
                        ->first();

                    if ($data->approved){
                        if (is_null($subscribe->student_id)) {
                            $last_new_serial_number = NewStudent::query()
                                ->where('section', '=', $subscribe->newStudent->section)
                                ->where('branch', '=', $subscribe->newStudent->branch)
                                ->max('serial_number');

                            $is_test = ($subscribe->email == 'aziz@furqangroup.com');

                            if(empty($last_new_serial_number) && $subscribe->newStudent->section == '1' && empty($subscribe->newStudent->serial_number) && !$is_test) {
                                $subscribe->newStudent->update([
                                    'serial_number' => env('LAST_NEW_SERIAL_NUMBER_MALES') + 1,
                                ]);
                            }elseif(empty($last_new_serial_number) && $subscribe->newStudent->section == '2' && empty($subscribe->newStudent->serial_number) && !$is_test){
                                $subscribe->newStudent->update([
                                    'serial_number' => env('LAST_NEW_SERIAL_NUMBER_FEMALES') + 1,
                                ]);
                            }else{
                                if (empty($subscribe->newStudent->serial_number) && !$is_test){
                                    $subscribe->newStudent->update([
                                        'serial_number' => $last_new_serial_number + 1,
                                    ]);
                                }
                            }
                        }

                        $coupon = Coupon::find($subscribe->coupon_id);
                        $student_id = $subscribe->student_id ?? $subscribe->new_student_id;

                        if ($coupon && @$coupon->is_valid){
                            $coupon->use($student_id);
                        }

                        session()->flash('success', __('resubscribe.The registration process has been completed successfully'));
                    }else{
                        session()->flash('error', __('resubscribe.Payment failed'));
                    }

                    $subscribe->update([
                        'payment_status' => $data->status,
                        'response_code'  => $data->actions[0]->response_code ?? '-',
                    ]);
                }else{
                    session()->flash('error', __('resubscribe.Payment failed'));
                }
            } catch (CheckoutApiException $e) {
                Log::error($e);
                session()->flash('error', __('resubscribe.Payment failed'));
            }
        }

        if (! (session('error') || session('success')) ) {
            return redirect()->route('registration.daily-wird.index');
        }

        return view('daily-wird.thank-you', ['countries' => $countries, 'course' => $course]);
    }

    public function getStudentInfo()
    {
        // منطق خاص بالورد اليومي
        return response()->json(['name' => '', 'amount' => ''], 500);
    }

    public function resubscribe(Request $request)
    {
        // منطق التسجيل للورد اليومي
        return redirect()->route('registration.daily-wird.thankYouPage');
    }

    // تم نقل Apple Pay و Google Pay methods إلى PaymentController الموحد
    // يمكن استخدام Routes الموحدة: payment.applePayValidateMerchant, payment.applePayValidateToken, payment.googlePayValidateToken
}
