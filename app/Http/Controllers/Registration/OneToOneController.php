<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\FavoriteTime;
use App\Models\Student;
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
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class OneToOneController extends Controller
{
    use FilesHelper;

    public function index()
    {
        session()->forget('error');
        session()->forget('success');
        $countries = Country::query()->where('lang', '=', App::getLocale())->get();
        $favorite_times_male = FavoriteTime::query()->where('section', '=', 'male')->get();
        $favorite_times_female = FavoriteTime::query()->where('section', '=', 'female')->get();
        $course = Course::query()->where('code', '=', 'one_to_one')->first();

        return view('one-to-one.index', [
            'countries' => $countries, 
            'favorite_times_male' => $favorite_times_male, 
            'favorite_times_female' => $favorite_times_female, 
            'course' => $course
        ]);
    }

    public function thankYouPage()
    {
        if(request()->query('cko-session-id')){
            try {
                $data = (new Checkout())->getPaymentDetails(request()->query('cko-session-id'));
                $response = $data->http_metadata;

                if ($response->getStatusCode() != 404){
                    $subscribe = Subscribe::query()
                        ->where('payment_id', '=', $data->id)
                        ->first();

                    $subscribe->update([
                        'payment_status' => $data->status,
                        'response_code'  => $data->actions[0]->response_code ?? '-',
                    ]);

                    if ($data->approved){
                        $coupon = Coupon::find($subscribe->coupon_id);
                        if ($coupon && @$coupon->is_valid){
                            $coupon->use($subscribe->student_id);
                        }
                        if ($subscribe->student->customPrice){
                            $subscribe->student->customPrice->update(['status' => '0']);
                        }
                        session()->flash('success', __('resubscribe.The registration process has been completed successfully'));
                    }else{
                        session()->flash('error', __('resubscribe.Payment failed'));
                    }
                }else{
                    session()->flash('error', __('resubscribe.Payment failed'));
                }
            } catch (CheckoutApiException $e) {
                Log::error($e);
                session()->flash('error', __('resubscribe.Payment failed'));
            }
        }
        elseif (request()->query('p_pay_id')) {
            try {
                $paypalToken = request()->query('p_pay_id');
                $validatePaypalTransaction = (new Checkout())->validatePaypalTransaction($paypalToken);
                if ($validatePaypalTransaction) {
                    $subscribe = Subscribe::where('payment_id', '=', $paypalToken)->first();
                    $subscribe->update([
                        'payment_id' => $validatePaypalTransaction->capturedPaymentId,
                        'paypal_fee' => $validatePaypalTransaction->paypalFee,
                        'payment_status' => 'Captured',
                        'response_code' => '10000'
                    ]);

                    $coupon = Coupon::find($subscribe->coupon_id);
                    if ($coupon && @$coupon->is_valid) {
                        $coupon->use($subscribe->student_id);
                    }
                    if ($subscribe->student->customPrice) {
                        $subscribe->student->customPrice->update(['status' => '0']);
                    }

                    session()->flash('success', __('resubscribe.The registration process has been completed successfully'));
                } else {
                    session()->flash('error', __('resubscribe.Payment failed'));
                }
            } catch (Exception $e) {
                Log::error($e);
                session()->flash('error', __('resubscribe.Payment failed'));
            }
        }

        $countries = Country::query()->where('lang', '=', App::getLocale())->get();
        $favorite_times_male = FavoriteTime::query()->where('section', '=', 'male')->get();
        $favorite_times_female = FavoriteTime::query()->where('section', '=', 'female')->get();
        $course = Course::query()->where('code', '=', 'one_to_one')->first();

        if (session()->get('subscribe_id')){
            $subscribe_id = session()->get('subscribe_id');
            $subscribe = Subscribe::query()->where('id', '=', $subscribe_id)->first();
            $coupon = Coupon::find($subscribe->coupon_id);
            
            if ($coupon && @$coupon->is_valid){
                $coupon->use($subscribe->student_id);
            }
            if($subscribe->student->customPrice) {
                $subscribe->student->customPrice->update(['status' => '0']);
                $subscribe->update([
                    'payment_status' => 'Captured',
                    'response_code' => '-',
                ]);
            }
            session()->forget('subscribe_id');
        }

        if (! (session('error') || session('success')) ) {
            return redirect()->route('registration.one-to-one.index');
        }

        return view('one-to-one.thank-you', [
            'countries' => $countries, 
            'favorite_times_male' => $favorite_times_male, 
            'favorite_times_female' => $favorite_times_female, 
            'course' => $course
        ]);
    }

    public function getStudentInfo()
    {
        $student = Student::query()
            ->where('serial_number', '=', request()->std_number)
            ->where('section', '=', request()->std_section)
            ->first();

        if (request()->query('form_type') == 'one_to_one' && $student){
            if ($student->path != 'حفظ'){
                return response()->json(['msg' => __('Sorry just')], 500);
            }
        }

        if ($student){
            $amount = Course::query()->where('code', 'one_to_one')->first()->amount;
            $discount_reason = false;
            $baseAmount = $amount;

            if ($student->customPrice){
                if (!empty($student->customPrice->discount_value)){
                    $amount = $amount - ($student->customPrice->discount_value*100);
                    $discount_reason = $student->customPrice->discount_reason;
                }elseif(!empty($student->customPrice->discount_percent)){
                    $amount = $amount - ( $amount * ($student->customPrice->discount_percent/100) );
                    $discount_reason = $student->customPrice->discount_reason;
                }
            }

            return response()->json([
                'name' => $student->name,
                'base_amount' => ($baseAmount/100),
                'discount_amount' => ($baseAmount/100) - ($amount/100),
                'amount' => $amount/100,
                'discount_reason' => $discount_reason,
                'email' => $student->email ?? null,
                'favorite_time' => $student->f_time ?? null,
                'residence_country_name' => $student->country ?? null,
            ], 200, [], JSON_UNESCAPED_UNICODE);
        }

        return response()->json(['msg' => __('resubscribe.serial number is incorrect')], 404);
    }

    public function resubscribe(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'student_number' => 'required|numeric',
            'section' => 'required|numeric',
            'student_name' => 'required|string',
            'residence_country' => 'required|exists:countries,id',
            'email' => 'required|email',
            'favorite_time' => 'required',
        ]);

        if ($request->payment_method == 'hsbc'){
            $request->validate([
                'money_transfer_image_path' => 'required',
                'bank_name' => 'required|string',
                'account_owner' => 'required|string',
                'transfer_date' => 'required|date',
                'bank_reference_number' => 'required|string',
            ]);
        }

        $student = Student::query()
            ->where('serial_number', '=', $request->student_number)
            ->where('section', '=', $request->section)
            ->first();

        if (is_null($student)){
            session()->flash('error', __('resubscribe.The student ID is not in our records'));
            return redirect()->route('registration.one-to-one.index');
        }

        if ($student->path != 'حفظ'){
            session()->flash('error', __('one_to_one.Sorry just'));
            return redirect()->route('registration.one-to-one.index');
        }

        Session::put('student_id', $student->id);
        $course = Course::query()->where('code', 'one_to_one')->first();
        $amount = $course->amount;

        $have_discount = false;
        if ($student->customPrice){
            if (!empty($student->customPrice->discount_value)){
                $amount = $amount - ($student->customPrice->discount_value*100);
            }elseif(!empty($student->customPrice->discount_percent)){
                $amount = $amount - ( $amount * ($student->customPrice->discount_percent/100) );
            }
            $have_discount = true;
        }

        $coupon = null;
        $discount = 0;
        if (isset($request->hidden_apply_coupon) && !empty($request->hidden_apply_coupon)){
            $coupon_code = $request->hidden_apply_coupon;
            $coupon = Coupon::where('code', $coupon_code)->where('course_id', $course->id)->first();

            if (@$coupon->is_valid) {
                $discount = $coupon->getDiscount($course->amount);
                $base_amount = $course->amount;
                $amount = $base_amount - $discount;
            }
        }

        if ($request->payment_method == 'checkout_gateway') {
            $customer = ['email' => $request->email, 'name' => $request->student_name];
            if ($amount != 0){
                $request->validate(['token_pay' => 'required|string']);
                try {
                    $tokenType = $request->token_pay_type ?? 'credit';
                    if (in_array($tokenType, ['applepay', 'googlepay'])) {
                        Log::info("getPaymentDetails-($tokenType): token_pay => $request->token_pay, amount => $amount");
                        $result = (new Checkout())->getPaymentDetails($request->token_pay);
                        Log::info("----------------End " . $tokenType . " Token--------------------------");
                    } else {
                        Log::info("payment-($tokenType): token_pay => $request->token_pay, amount => $amount");
                        $result = (new Checkout())->payment($request->token_pay, $customer, $amount);
                    }
                    Log::info(get_object_vars($result));
                } catch (CheckoutApiException $ex) {
                    session()->flash('error', __('resubscribe.Payment failed') . "\r\n" . $ex->getMessage() . "\r\n" . $ex->error_details['error_codes'][0]);
                    return redirect()->route('registration.one-to-one.thankYouPage');
                }
            }

            $referenceNumber = Session::get('reference_number') ?? Subscribe::generateReferenceNumber();
            $paymentId = Session::get('payment_id');
            $paymentStatus = Session::get('payment_status');

            $subscribe = Subscribe::createNewSubscribe(
                $request, 
                $student, 
                $coupon, 
                $have_discount, 
                $discount * 100, 
                $referenceNumber, 
                'checkout_gateway', 
                $paymentId, 
                $paymentStatus,
                FormType::ONE_TO_ONE
            );

            Session::forget('payment_id');
            Session::forget('payment_status');
            Session::forget('reference_number');

            if ($amount != 0){
                $redirection = @$result->_links['redirect']['href'];
                if ($redirection){
                    return Redirect::to($redirection);
                }else{
                    if (@$result->approved) {
                        if (isset($coupon) && @$coupon->is_valid) {
                            $coupon->use($student->id);
                        }
                        session()->flash('success', __('resubscribe.The registration process has been completed successfully'));
                    }else{
                        session()->flash('error', __('resubscribe.Payment failed!'));
                    }
                    return view('one-to-one.thank-you', ['countries' => [], 'course' => null]);
                }
            }else{
                session()->flash('success', __('resubscribe.The registration process has been completed successfully'));
                return redirect()->route('registration.one-to-one.thankYouPage')->with(['subscribe_id' => $subscribe->id]);
            }
        }
        elseif ($request->payment_method === 'paypal') {
            $referenceNumber = Subscribe::generateReferenceNumber();
            $paypalTransaction = (new Checkout())->processPaypalTransaction($amount / 100, $referenceNumber);
            Subscribe::createNewSubscribe($request, $student, $coupon, $have_discount, $discount * 100, $referenceNumber, 'paypal', $paypalTransaction['id'], 'Pending', FormType::ONE_TO_ONE);
            return response()->json($paypalTransaction);
        }
        elseif ($request->payment_method === 'hsbc') {
            $referenceNumber = Subscribe::generateReferenceNumber();
            $subscribe = Subscribe::createNewSubscribe($request, $student, $coupon, $have_discount, $discount * 100, $referenceNumber, 'hsbc', null, 'Pending', FormType::ONE_TO_ONE);
            
            if ($request->hasFile('money_transfer_image_path')) {
                $subscribe->update([
                    'money_transfer_image_path' => $request->file('money_transfer_image_path')->store('public/money_transfer'),
                    'bank_name' => $request->bank_name,
                    'account_owner' => $request->account_owner,
                    'transfer_date' => $request->transfer_date,
                    'bank_reference_number' => $request->bank_reference_number,
                ]);
            }
        }

        session()->flash('success', __('resubscribe.The registration process has been completed successfully'));
        return redirect()->route('registration.one-to-one.thankYouPage');
    }

    // تم نقل Apple Pay و Google Pay methods إلى PaymentController الموحد
    // يمكن استخدام Routes الموحدة: payment.applePayValidateMerchant, payment.applePayValidateToken, payment.googlePayValidateToken
}
