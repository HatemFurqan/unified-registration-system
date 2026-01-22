<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\FavoriteTime;
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
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class WorkshopsController extends Controller
{
    use FilesHelper;

    public function index()
    {
        session()->forget('error');
        session()->forget('success');

        $countries = Country::query()->where('lang', '=', App::getLocale())->get();
        $course = Course::query()->where('code', '=', 'new-students-warsh')->first();
        
        $time_table_image_path = Config::getValue('time_table_image_' . app()->getLocale(), '');
        $time_table_image = $time_table_image_path ? Storage::url($time_table_image_path) : '';

        return view('workshops.index', [
            'countries' => $countries, 
            'course' => $course,
            'time_table_image' => $time_table_image
        ]);
    }

    public function thankYouPage()
    {
        $countries = Country::query()->where('lang', '=', App::getLocale())->get();
        $course = Course::query()->where('code', '=', 'new-students-warsh')->first();

        if(request()->query('cko-session-id')){
            try {
                $data = (new Checkout())->getPaymentDetails(request()->query('cko-session-id'));
                $response = $data->http_metadata;
                
                if ($response->getStatusCode() != 404){
                    $subscribe = Subscribe::query()
                        ->where('payment_id', '=', $data->id)
                        ->first();

                    if ($data->approved){
                        $coupon = Coupon::find($subscribe->coupon_id);
                        $student_id = $subscribe->new_student_id ?? $subscribe->student_id;

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
            return redirect()->route('registration.workshops.index');
        }

        return view('workshops.thank-you', ['countries' => $countries, 'course' => $course]);
    }

    public function getStudentInfo()
    {
        // منطق خاص بالورش
        return response()->json(['name' => '', 'amount' => ''], 500);
    }

    public function resubscribe(Request $request)
    {
        // منطق التسجيل للورش - مشابه لـ NewStudentsController
        return redirect()->route('registration.workshops.thankYouPage');
    }

    // تم نقل Apple Pay و Google Pay methods إلى PaymentController الموحد
    // يمكن استخدام Routes الموحدة: payment.applePayValidateMerchant, payment.applePayValidateToken, payment.googlePayValidateToken
}
