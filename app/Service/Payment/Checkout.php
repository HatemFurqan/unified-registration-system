<?php

namespace App\Service\Payment;

use App\Models\Subscribe;
use Carbon\Carbon;
use Checkout\CheckoutApi;
use Checkout\CheckoutApiException;
use Checkout\CheckoutArgumentException;
use Checkout\CheckoutSdk;
use Checkout\Common\Address;
use Checkout\Common\Currency;
use Checkout\Common\CustomerRequest;
use Checkout\Common\Phone;
use Checkout\Environment;
use Checkout\Payments\Request\PaymentRequest;
use Checkout\Payments\Request\Source\RequestTokenSource;
use Checkout\Payments\RiskRequest;
use Checkout\Payments\ShippingDetails;
use Checkout\Payments\ThreeDsRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Checkout\Tokens\ApplePayTokenData;
use Checkout\Tokens\ApplePayTokenRequest;
use Exception;
use Checkout\Tokens\GooglePayTokenData;
use Checkout\Tokens\GooglePayTokenRequest;
use Illuminate\Http\Response;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class Checkout
{
    /**
     * @var string
     */
    private $secret;
    /**
     * @var string
     */
    private $public;
    /**
     * @var string
     */
    private $mode;
    /**
     * @var CheckoutApi
     */
    public $checkoutApi;

    /**
     * @var PayPalClient
     */
    private $provider;

    public function __construct()
    {
        $config = config('checkoutpayment');
        $this->secret = $config['checkout_sk'];
        $this->public = $config['checkout_pk'];
        $this->mode = $config['mode'];
        try {
            $this->checkoutApi = CheckoutSdk::builder()
                ->staticKeys()
                ->publicKey($this->public)
                ->secretKey($this->secret)
                ->environment($this->mode == 'sandbox' ? Environment::sandbox() : Environment::production())
                ->build();
        } catch (CheckoutArgumentException $e) {
            Log::info("CheckoutSdk::builder()" . $e->getMessage());
        }
        try {
            $this->provider = new PayPalClient;
            $this->provider->setApiCredentials(config('paypal'));
        } catch (Exception $e) {
            Log::info("PayPalClient::provider()" . $e->getMessage());
        }
    }

    /**
     * @param string $token
     * @param $customer
     * @param $amount
     * @return object
     * @throws CheckoutApiException
     */
    public function payment(string $token, $customer, $amount): object
    {
        try{
            $now = Carbon::now();
            $reference_number = Subscribe::whereYear('created_at', '=', $now->year)->max('reference_number');
            $reference_number = $reference_number ? intval($reference_number) + 1 : $now->year . '0001';

            $payment = new PaymentRequest;
            $payment->capture = true;
            $payment->payment_type = 'Regular';
            $payment->reference = $reference_number;
            $payment->currency = Currency::$USD;
            $payment->amount = $amount;
            $payment->success_url = url('/thank-you');
            $payment->failure_url = url('/thank-you');


            $requestTokenSource = new RequestTokenSource();
            $requestTokenSource->type = 'token';
            $requestTokenSource->token = $token;
            $payment->source = $requestTokenSource;

            $riskRequest = new RiskRequest;
            $riskRequest->enabled = false;
            $payment->risk = $riskRequest;

            $threeDs = new ThreeDsRequest();
            $threeDs->enabled = true;
            $threeDs->attempt_n3d = true;
            $payment->three_ds = $threeDs;

            $customerRequest = new CustomerRequest();
            $customerRequest->name = $customer['name'];
            $customerRequest->email = $customer['email'];
            $payment->customer = $customerRequest;

            if ($this->mode == 'sandbox')
                $payment->processing_channel_id = 'pc_ria24ltda3menleubpycxtiuwa';

            $details = (object)$this->checkoutApi->getPaymentsClient()->requestPayment($payment);

            Session::put('payment_id', $details->id);
            Session::put('payment_status', $details->status);
            Session::put('reference_number', $reference_number);
            return $details;
        } catch (Exception $e) {
            $message =  $e->getMessage() . ' ' . $e->error_details['error_codes'][0] ?? '';
            Log::error("Checkout::payment()" . $message);
            return json_decode('{"error":"' . $message . '"}');
        }
    }


    /**
     * @param string $ckoSessionId
     * @return object
     */
    public function getPaymentDetails(string $ckoSessionId): object
    {
        try{
            $paymentDetails = (object)$this->checkoutApi->getPaymentsClient()->getPaymentDetails($ckoSessionId);

            if(isset($paymentDetails->actions)){
                $paymentDetails->actions[0] = (object) $paymentDetails->actions[0];
            }else{
                $paymentDetails->actions = [];
            }
            $paymentDetails->source = (object) $paymentDetails->source;
            return $paymentDetails;
        } catch (Exception $e) {
            Log::error("Checkout::payment()" . $e->getMessage());
            return json_decode('{"error":"' . $e->getMessage() . '"}');
        }
    }

    /**
     * @param string $email
     * @param string $name
     * @return CustomerRequest
     * @noinspection PhpUnusedPrivateMethodInspection
     */
    private function customer(string $email, string $name): CustomerRequest
    {
        $customer = new CustomerRequest();
        $customer->email = $email;
        $customer->name = $name;
        return $customer;
    }

    /**
     * @param array $address
     * @param array $phone
     * @return ShippingDetails
     * @noinspection PhpUnusedPrivateMethodInspection
     */
    private function shipping(array $address, array $phone): ShippingDetails
    {
        $shippingDetails = new ShippingDetails();
        $shippingDetails->phone = $phone;
        $shippingDetails->address = $address;
        return $shippingDetails;
    }

    /**
     * @param string $address_line1
     * @param string $address_line2
     * @param string $city
     * @param string $state
     * @param string $zip
     * @param string $country
     * @return Address
     * @noinspection PhpUnusedPrivateMethodInspection
     */
    private function address(string $address_line1, string $address_line2, string $city, string $state, string $zip, string $country): Address
    {
        $address = new Address();
        $address->address_line1 = $address_line1;
        $address->address_line2 = $address_line2;
        $address->city = $city;
        $address->state = $state;
        $address->zip = $zip;
        $address->country = $country;
        return $address;
    }

    /**
     * @param string $countryCode
     * @param string $number
     * @return Phone
     * @noinspection PhpUnusedPrivateMethodInspection
     */
    private function phone(string $countryCode, string $number): Phone
    {
        $phone = new Phone();
        $phone->country_code = $countryCode;
        $phone->number = $number;
        return $phone;
    }



    /**
     * @param string $validation_url
     * @return mixed
     */
    public function applePayValidateMerchant(string $validation_url = "https://apple-pay-gateway-cert.apple.com/paymentservices/startSession") {
        try {
            $merchantIdentifier = env("APPLE_PAY_MERCHANT_ID");
            $displayName = env("APPLE_PAY_MERCHANT_DISPLAY_NAME");
            $intiative = env("APPLE_PAY_MERCHANT_INITIATIVE");
            $intiativeContext = env("APPLE_PAY_MERCHANT_CONTEXT");
            $cert = env("APPLE_PAY_MERCHANT_CERTIFICATION");
            $secretPath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'secrets' . DIRECTORY_SEPARATOR . $cert;
            $postDataEncoded = json_encode(['merchantIdentifier' => $merchantIdentifier, 'displayName' => $displayName, 'domainName' => $intiativeContext, 'initiative' => $intiative, 'initiativeContext' => $intiativeContext]);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $validation_url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataEncoded);
            curl_setopt($ch, CURLOPT_SSLCERT, $secretPath . '.pem');
            curl_setopt($ch, CURLOPT_SSLKEY, $secretPath . '.key');
            curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
            curl_setopt($ch, CURLOPT_SSLVERSION, 'CURL_SSLVERSION_TLSv1_2');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); //for production, set value to 2
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);//for production, set value to true or 1
            $result = curl_exec($ch);
            curl_close($ch);

            if ($result === false)
                return json_decode('{"error":"' . curl_error($ch) . '"}');
            return json_decode($result);
        } catch (Exception $e) {
            Log::error("ApplePay::applePayValidateMerchant()" . $e->getMessage());
            return json_decode('{"error":"' . $e->getMessage() . '"}');
        }
    }

    /**
     * @param array $applePayTokenData
     * @param $amount
     * @return array
     */
    public function getApplePayToken(array $applePayTokenData, $amount, $customer) {
        try {
            Log::info('----------------StartApplePayToken--------------------------');
            $amount = $amount * 100;
            $paymentData = $applePayTokenData['paymentData'];

            $applePayTokenRequest = new ApplePayTokenRequest();
            $applePayTokenRequest->type = 'applepay';
            $applePayTokenRequest->token_data = new ApplePayTokenData();
            $applePayTokenRequest->token_data->version = $paymentData['version'];
            $applePayTokenRequest->token_data->header = $paymentData['header'];
            $applePayTokenRequest->token_data->signature = $paymentData['signature'];
            $applePayTokenRequest->token_data->data = $paymentData['data'];
            $resultGenerateCheckoutToken = $this->checkoutApi->getTokensClient()->requestWalletToken($applePayTokenRequest);
            Log::info('getApplePayToken@requestWalletToken');
            Log::info($resultGenerateCheckoutToken);

            $requestCheckoutProcess = $this->payment($resultGenerateCheckoutToken['token'], $customer, $amount);
            Log::info('getApplePayToken@requestCheckoutProcess');
            Log::info(get_object_vars($requestCheckoutProcess));
            Log::info('----------------EndApplePayToken--------------------------');

            if ($requestCheckoutProcess->status === 'approved' || @$requestCheckoutProcess->approved === true) {
                return ['status' => 'Successful', 'session' => $resultGenerateCheckoutToken, 'token' => $requestCheckoutProcess->id];
            }
            if (isset($requestCheckoutProcess->_links['redirect']['href'])) {
                return ['status' => 'Pending', 'session' => $resultGenerateCheckoutToken, 'token' => $requestCheckoutProcess->id];
            }
            return ['status' => $requestCheckoutProcess->status, 'session' => $resultGenerateCheckoutToken, 'token' => $requestCheckoutProcess->id];
        } catch (Exception $e) {
            Log::error("ApplePay::getApplePayToken()" . $e->getMessage());
            return json_decode('{"error":"' . $e->getMessage() . '"}');
        }
    }

    /**
     * @param string $googlePayTokenData
     * @param $amount
     * @return array
     */
    public function getGooglePayToken(string $googlePayTokenData, $amount, $customer): array {
        try {
            Log::info('----------------StartGooglePayToken--------------------------');
            $amount = $amount * 100;
            $googlePayTokenData = json_decode($googlePayTokenData);

            $googlePayTokenRequest = new GooglePayTokenRequest();
            $googlePayTokenRequest->type = 'googlepay';
            $googlePayTokenRequest->token_data = new GooglePayTokenData();
            $googlePayTokenRequest->token_data->protocolVersion = $googlePayTokenData->protocolVersion;
            $googlePayTokenRequest->token_data->signedMessage = $googlePayTokenData->signedMessage;
            $googlePayTokenRequest->token_data->signature = $googlePayTokenData->signature;
            $resultGenerateCheckoutToken = $this->checkoutApi->getTokensClient()->requestWalletToken($googlePayTokenRequest);
            Log::info('GooglePay@requestWalletToken');
            Log::info($resultGenerateCheckoutToken);

            $requestCheckoutProcess = $this->payment($resultGenerateCheckoutToken['token'], $customer, $amount);
            $walletToken = $requestCheckoutProcess->id;
            Log::info('GooglePay@requestCheckoutProcess');
            Log::info(get_object_vars($requestCheckoutProcess));

            if ($requestCheckoutProcess->status === 'approved' || @$requestCheckoutProcess->approved === true) {
                return ['status' => 'Successful', 'wallet_token' => $walletToken, 'wallet_type' => $googlePayTokenRequest->type];
            }
            if (isset($requestCheckoutProcess->_links['redirect']['href'])) {
                return ['status' => 'Pending', 'wallet_token' => $walletToken, 'wallet_type' => $googlePayTokenRequest->type];
            }
            return ['status' => $requestCheckoutProcess->status, 'wallet_token' => $walletToken, 'wallet_type' => $googlePayTokenRequest->type];
        } catch (Exception $e) {
            Log::error("GooglePay::getGooglePayToken" . $e->getMessage());
            return json_decode('{"error":"' . $e->getMessage() . '"}');
        }
    }

    /**
     * process transaction.
     *
     * @param float $amount
     * @param string $referenceNumber
     * @return Response
     * @throws \Throwable
     */
    public function processPaypalTransaction(float $amount, string $referenceNumber, $thankYouRoute = null) {
        $this->provider->getAccessToken();
        
        // استخدام route ديناميكي إذا تم تمريره، وإلا استخدام route افتراضي
        $returnUrl = $thankYouRoute ? route($thankYouRoute) : url('/thank-you');
        $cancelUrl = $thankYouRoute ? route($thankYouRoute) : url('/thank-you');
        
        $response = $this->provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => $returnUrl,
                "cancel_url" => $cancelUrl
            ],
            "purchase_units" => [
                0 => [
                    "invoice_id" => $referenceNumber,
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $amount
                    ]
                ]
            ]
        ]);
        Log::info('processPaypalTransaction - Reference Number ' . $referenceNumber);
        Log::info($response);
        return $response;
    }

    /**
     * validateTransaction.
     *
     * @param string $token
     * @return Response
     * @throws \Throwable
     */
    public function validatePaypalTransaction(string $token) {
        $this->provider->getAccessToken();
        $response = $this->provider->capturePaymentOrder($token);
        Log::info('validatePaypalTransaction: ' . $token);
        Log::info($response);

        if(isset($response['status']) && $response['status'] == 'COMPLETED'){
            $res = new \stdClass();
            $capturedPayment = $response['purchase_units'][0]['payments']['captures'][0];
            $res->capturedPaymentId = $capturedPayment['id'];
            $res->paypalFee = $capturedPayment['seller_receivable_breakdown']['paypal_fee']['value'];
            return $res;
        }
        return false;
    }

}
