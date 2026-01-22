
const environment = document.getElementById("mode_pay").value === 'sandbox' ? "TEST" : "PRODUCTION";
const gateway = "checkoutltd";
const gatewayMerchantId = document.getElementById("mode_key").value;
// @todo a merchant ID is available for a production environment after approval by Google
const merchantId = document.getElementById("google_merchant_id").value;

document.addEventListener('DOMContentLoaded', () => onGooglePayLoaded());

/**
 * Define the version of the Google Pay API referenced when creating your
 * configuration
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#PaymentDataRequest|apiVersion in PaymentDataRequest}
 */
const baseRequest = {apiVersion: 2, apiVersionMinor: 0};

/**
 * Card networks supported by your site and your gateway
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
 */
const allowedCardNetworks = ["AMEX", "DISCOVER", "MASTERCARD", "VISA"]

/**
 * Card authentication methods supported by your site and your gateway
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
 * supported card networks
 */
const allowedCardAuthMethods = ["PAN_ONLY", "CRYPTOGRAM_3DS"]

/**
 * Identify your gateway and your site's gateway merchant identifier
 *
 * The Google Pay API response will return an encrypted payment method capable
 * of being charged by a supported gateway after payer authorization
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#gateway|PaymentMethodTokenizationSpecification}
 */
const tokenizationSpecification = {
    type: "PAYMENT_GATEWAY",
    parameters: {
        gateway: gateway,
        gatewayMerchantId: gatewayMerchantId,
    }
}

/**
 * Describe your site's support for the CARD payment method and its required
 * fields
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
 */
const baseCardPaymentMethod = {
    type: "CARD",
    parameters: {
        allowedAuthMethods: allowedCardAuthMethods,
        allowedCardNetworks: allowedCardNetworks,
    },
}

/**
 * Describe your site's support for the CARD payment method including optional
 * fields
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
 */
const cardPaymentMethod = Object.assign({}, baseCardPaymentMethod, {
    tokenizationSpecification: tokenizationSpecification,
})

/**
 * An initialized Google.payments.api.PaymentsClient object or null if not yet set
 *
 * @see {@link getGooglePaymentsClient}
 */
let paymentsClient = null

/**
 * Configure your site's support for payment methods supported by the Google Pay
 * API.
 *
 * Each member of allowedPaymentMethods should contain only the required fields,
 * allowing reuse of this base request when determining a viewer's ability
 * to pay and later requesting a supported payment method
 *
 * @returns {object} Google Pay API version, payment methods supported by the site
 */
function getGoogleIsReadyToPayRequest() {
    return Object.assign({}, baseRequest, {allowedPaymentMethods: [baseCardPaymentMethod]})
}

/**
 * Configure support for the Google Pay API
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#PaymentDataRequest|PaymentDataRequest}
 * @returns {object} PaymentDataRequest fields
 */
function getGooglePaymentDataRequest() {
    const paymentDataRequest = Object.assign({}, baseRequest)
    paymentDataRequest.allowedPaymentMethods = [cardPaymentMethod]
    paymentDataRequest.transactionInfo = getGoogleTransactionInfo()
    paymentDataRequest.merchantInfo = {
        // See {@link https://developers.google.com/pay/api/web/guides/test-and-deploy/integration-checklist|Integration checklist}
        merchantId: merchantId,
        merchantName: "Furqan Group: Eservices Checkout",
    }
    return paymentDataRequest
}

/**
 * Return an active PaymentsClient or initialize
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/client#PaymentsClient|PaymentsClient constructor}
 * @returns {google.payments.api.PaymentsClient} Google Pay API client
 */
function getGooglePaymentsClient() {
    if (paymentsClient === null) {
        paymentsClient = new google.payments.api.PaymentsClient({
            environment: environment
        })
    }
    return paymentsClient
}

/**
 * Initialize Google PaymentsClient after Google-hosted JavaScript has loaded
 *
 * Display a Google Pay payment button after confirmation of the viewer's
 * ability to pay.
 */
function onGooglePayLoaded() {
    const paymentsClient = getGooglePaymentsClient();
    paymentsClient.isReadyToPay(getGoogleIsReadyToPayRequest())
        .then(function (response) {
            if (response.result) {
                addGooglePayButton()
                prefetchGooglePaymentData();
            }
        })
        .catch(function (err) {
            console.error(err)
        })
}

/**
 * Add a Google Pay purchase button alongside an existing checkout button
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#ButtonOptions|Button options}
 * @see {@link https://developers.google.com/pay/api/web/guides/brand-guidelines|Google Pay brand guidelines}
 */
function addGooglePayButton() {
    const paymentsClient = getGooglePaymentsClient()
    const button = paymentsClient.createButton({
        buttonColor: 'black',
        buttonType: 'checkout',
        buttonRadius: 4,
        buttonLocale: document.documentElement.lang,
        onClick: onGooglePaymentButtonClicked,
    })
    document.getElementById("google-pay-button").appendChild(button)
}

/**
 * Provide Google Pay API with a payment amount, currency, and amount status
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#TransactionInfo|TransactionInfo}
 * @returns {object} transaction info, suitable for use as transactionInfo property of PaymentDataRequest
 */
function getGoogleTransactionInfo() {
    const amount = (Math.round(amountElement.getAttribute('data-course-amount') * 100) / 100).toFixed(2)
    return {
        countryCode: "US",
        currencyCode: "USD",
        totalPriceStatus: "FINAL",
        totalPrice: amount
    }
}

/**
 * Prefetch payment data to improve performance
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/client#prefetchPaymentData|prefetchPaymentData()}
 */
function prefetchGooglePaymentData() {
    const paymentDataRequest = getGooglePaymentDataRequest() // transactionInfo must be set but does not affect cache
    paymentDataRequest.transactionInfo = {
        totalPriceStatus: "NOT_CURRENTLY_KNOWN",
        currencyCode: "USD",
    }
    const paymentsClient = getGooglePaymentsClient()
    paymentsClient.prefetchPaymentData(paymentDataRequest)
}

/**
 * Show Google Pay payment sheet when Google Pay payment button is clicked
 */
function onGooglePaymentButtonClicked() {
    const paymentDataRequest = getGooglePaymentDataRequest()
    paymentDataRequest.transactionInfo = getGoogleTransactionInfo()

    const paymentsClient = getGooglePaymentsClient()
    paymentsClient
        .loadPaymentData(paymentDataRequest)
        .then(function (paymentData) {
            processPayment(paymentData)
        })
        .catch(function (err) {
            console.error(err)
        })
}

/**
 * Process payment data returned by the Google Pay API
 *
 * @param {object} paymentData response from Google Pay API after user approves payment
 * @see {@link https://developers.google.com/pay/api/web/reference/response-objects#PaymentData|PaymentData object reference}
 */
function processPayment(paymentData) {
    const studentName = document.getElementById("std-name").value;
    const studentEmail = document.getElementById("std-email").value;
    const paymentRequestData = {
        _token: _token,
        token: paymentData.paymentMethodData.tokenizationData.token,
        amount: (Math.round(amountElement.getAttribute('data-course-amount') * 100) / 100).toFixed(2),
        student_name: studentName,
        student_email: studentEmail
    };
    $.ajax({
        url: `${apiUrl}/validate-google-pay-token`,
        dataType: "json",
        type: "POST",
        data: paymentRequestData,
        success: function (response) {
            document.getElementById('token_pay').value = response.result.wallet_token;
            document.getElementById('token_pay_type').value = response.result.wallet_type;
            setTimeout(() => $('#msform').submit(), 1500);
        },
        error: function (status) {
            console.log(JSON.stringify(status));
        }
    });
}
