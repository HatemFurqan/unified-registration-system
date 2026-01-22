const applePayButton = document.getElementById("apple-pay-button");

document.addEventListener('DOMContentLoaded', () => {
    if (window.ApplePaySession && ApplePaySession.canMakePayments) {
        applePayButton.className = "";
        applePayButton.addEventListener('click', applePayButtonClicked);
    }
});

function applePayButtonClicked() {
    if (window.ApplePaySession) {
        const amount = (Math.round(amountElement.getAttribute('data-course-amount') * 100) / 100).toFixed(2);
        const studentName = document.getElementById("std-name").value;
        const studentEmail = document.getElementById("std-email").value;
        const paymentRequest = {
            countryCode: 'US',
            currencyCode: 'USD',
            supportedNetworks: ['visa', 'masterCard', 'amex', 'discover'],
            merchantCapabilities: ['supports3DS', 'supportsCredit', 'supportsDebit'],
            total: {label: 'Furqan Group: Regular Students Registration', amount: amount},
        };
        const session = new ApplePaySession(3, paymentRequest);


        /**
         * Merchant Validation
         * We call our merchant session endpoint, passing the URL to use
         */
        session.onvalidatemerchant = (event) => $.ajax({
            url: `${apiUrl}/validate-apple-pay-merchant`,
            dataType: "json",
            type: "POST",
            data: {_token: _token, validation_url: event.validationURL},
            success: (response) => session.completeMerchantValidation(response['session']),
            error: () => session.abort()
        })

        /**
         * Payment Authorization
         * Here you receive the encrypted payment data. You would then send it
         * on to your payment provider for processing, and return an appropriate
         * status in session.completePayment()
         */
        session.onpaymentauthorized = (event) => $.ajax({
            url: `${apiUrl}/validate-apple-pay-token`,
            dataType: "json",
            type: "POST",
            data: {
                _token,
                token: event.payment.token,
                amount: amount,
                student_name: studentName,
                student_email: studentEmail
            },
            success: (response) => {
                document.getElementById('token_pay').value = response.result.token;
                document.getElementById('token_pay_type').value = 'applepay';
                if (response.result.status === 'Successful') {
                    session.completePayment(ApplePaySession.STATUS_SUCCESS);
                    setTimeout(() => $('#msform').submit(), 1500);
                } else if (response.result.status === 'Pending') {
                    session.completePayment(session.STATUS_PIN_REQUIRED);
                    setTimeout(() => $('#msform').submit(), 1500);
                } else {
                    session.completePayment(session.STATUS_FAILURE);
                }
            },
            error: () => session.abort()
        })

        session.begin();
    }
}
