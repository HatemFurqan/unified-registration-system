const apiUrl = document.getElementById("api_url").value;
const payButton = document.getElementById("pay-button");
const form = document.getElementById("payment-form");
let errorStack = [];
const amountElement = document.getElementById('checkout_gateway');
const _token = document.querySelector("meta[name='csrf-token']").getAttribute("content");

Frames.init(document.getElementById("mode_key").value);
console.log(document.getElementById("mode_pay").value)

Frames.addEventHandler(Frames.Events.CARD_VALIDATION_CHANGED, onCardValidationChanged);

function onCardValidationChanged(event) {
    console.log("CARD_VALIDATION_CHANGED: %o", event);
    payButton.disabled = !Frames.isCardValid();
}

Frames.addEventHandler(Frames.Events.FRAME_VALIDATION_CHANGED, onValidationChanged);

function onValidationChanged(event) {
    console.log("FRAME_VALIDATION_CHANGED: %o", event);

    const errorMessageElement = document.querySelector(".error-message");
    const hasError = !event.isValid && !event.isEmpty;

    if (hasError) {
        errorStack.push(event.element);
    } else {
        errorStack = errorStack.filter(function (element) {
            return element !== event.element;
        });
    }

    errorMessageElement.textContent = errorStack.length ? getErrorMessage(errorStack[errorStack.length - 1]) : "";
}

function getErrorMessage(element) {
    const errors = {
        "card-number": "Please enter a valid card number",
        "expiry-date": "Please enter a valid expiry date",
        cvv: "Please enter a valid cvv code",
    };

    return errors[element];
}

Frames.addEventHandler(Frames.Events.CARD_TOKENIZATION_FAILED, onCardTokenizationFailed);

function onCardTokenizationFailed(error) {
    console.log("CARD_TOKENIZATION_FAILED: %o", error);
    Frames.enableSubmitForm();
}

Frames.addEventHandler(Frames.Events.CARD_TOKENIZED, onCardTokenized);

function onCardTokenized(event) {
    console.log('On Credit Card Tokenized : ' + event.token)
    $('#token_pay').val(event.token);
    $('#pay-button').attr('disabled', true);
    $('#pay-button .fa-spinner').removeClass('d-none');
    setTimeout(function () {
        $('#msform').submit();
    }, 250);
}

form.addEventListener("submit", function (event) {
    event.preventDefault();
    Frames.submitCard();
});
