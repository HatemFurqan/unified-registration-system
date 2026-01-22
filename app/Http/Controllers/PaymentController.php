<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Service\Payment\Checkout;
use Illuminate\Http\JsonResponse;
use Exception;

class PaymentController extends Controller
{
    /**
     * Validate Apple Pay Merchant
     * 
     * @return JsonResponse
     */
    public function applePayValidateMerchant(): JsonResponse
    {
        // استخدام default value من استمارة-المنتظمين (الأكثر اكتمالاً)
        $validation_url_apple = 'https://apple-pay-gateway-cert.apple.com/paymentservices/startSession';
        $validationUrl = request()->validation_url ?? $validation_url_apple;
        
        if($validationUrl){
            $result = (new Checkout())->applePayValidateMerchant($validationUrl);
            if (!isset($result->error)) {
                return response()->json(['session' => $result, 'status' => true], 200, [], JSON_UNESCAPED_UNICODE);
            }
            return response()->json(['message' => $result->error, 'status' => false], 404);
        }
        return response()->json(['message' => 'validation url not provided', 'status' => false], 404);
    }

    /**
     * Validate Apple Pay Token
     * 
     * @return JsonResponse
     */
    public function applePayValidateToken(): JsonResponse
    {
        $token = request()->token ?? null;
        $amount = request()->amount ?? null;
        $customer = ['email' => request()->student_email ?? "test@furqangroup.com", 'name' => request()->student_name ?? "Furqan User"];
        
        if ($token !== null && $amount !== null) {
            try {
                $result = (new Checkout())->getApplePayToken($token, $amount, $customer);
                if (!isset($result->error)) {
                    return response()->json(['result' => $result, 'status' => true], 200, [], JSON_UNESCAPED_UNICODE);
                }
                return response()->json(['message' => $result->error, 'status' => false], 404);
            } catch (Exception $e) {
                return response()->json(['message' => $e->getMessage(), 'status' => false], 404);
            }
        }
        return response()->json(['message' => 'token or|and amount not provided', 'status' => false], 404);
    }

    /**
     * Validate Google Pay Token
     * 
     * @return JsonResponse
     */
    public function googlePayValidateToken(): JsonResponse
    {
        $token = request()->token ?? null;
        $amount = request()->amount ?? null;
        $customer = ['email' => request()->student_email ?? "test@furqangroup.com", 'name' => request()->student_name ?? "Furqan User"];
        
        if ($token !== null) {
            try {
                $result = (new Checkout())->getGooglePayToken($token, $amount, $customer);
                if (!isset($result->error)) {
                    return response()->json(['result' => $result, 'status' => true], 200, [], JSON_UNESCAPED_UNICODE);
                }
                return response()->json(['message' => $result->error, 'status' => false], 404);
            } catch (Exception $e) {
                return response()->json(['message' => $e->getMessage(), 'status' => false], 404);
            }
        }
        return response()->json(['message' => 'token not provided', 'status' => false], 404);
    }
}
