paypal.Buttons({
    style: {layout: 'vertical', color: 'black', shape: 'rect', label: 'pay'},
    async createOrder() {
        const amount = (Math.round(amountElement.getAttribute('data-course-amount') * 100) / 100).toFixed(2)
        const form = document.getElementById("msform");
        const formData = new FormData(form);
        formData.set("payment_method", "paypal");
        formData.set("amount", amount);
        const response = await fetch($('#msform').attr("action"), {method: "POST", body: formData});
        const data = await response.json();
        return data.id;
    },
    async onApprove(data) {
        window.location.assign(document.getElementById('api_url').value + '/thank-you?' + "p_pay_id=" + data.paymentID);
    },
    async onCancel(data) {
        console.log(data)
    },
    async onError(err) {
        console.log(err)
    }
}).render('#paypal-pay-button');
