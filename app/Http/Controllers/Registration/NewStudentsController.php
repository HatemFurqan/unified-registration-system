<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\FavoriteTime;
use App\Models\Governorate;
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

class NewStudentsController extends Controller
{
    use FilesHelper;

    public function index()
    {
        session()->forget('error');
        session()->forget('success');

        $countries = Country::query()->where('lang', '=', App::getLocale())->get();
        $course = Course::query()->where('code', '=', 'new-students-all')->first();

        return view('new-students.index', ['countries' => $countries, 'course' => $course]);
    }

    public function thankYouPage()
    {
        // نفس منطق RegularStudentsController مع تعديلات بسيطة
        $countries = Country::query()->where('lang', '=', App::getLocale())->get();
        $course = Course::query()->where('code', '=', 'new-students-all')->first();

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
            return redirect()->route('registration.new-students.index');
        }

        return view('new-students.thank-you', ['countries' => $countries, 'course' => $course]);
    }

    public function getStudentInfo()
    {
        // منطق خاص بالطلاب الجدد
        return response()->json(['name' => '', 'amount' => ''], 500);
    }

    public function resubscribe(Request $request)
    {
        // منطق التسجيل للطلاب الجدد - سيتم نسخه من RegisterController
        // هذا يحتاج إلى منطق معقد أكثر
        return redirect()->route('registration.new-students.thankYouPage');
    }

    // تم نقل Apple Pay و Google Pay methods إلى PaymentController الموحد
    // يمكن استخدام Routes الموحدة: payment.applePayValidateMerchant, payment.applePayValidateToken, payment.googlePayValidateToken
}
