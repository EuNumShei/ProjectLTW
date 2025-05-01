function showPaymentForm() {
    document.getElementById('payment-form').style.display = 'block';
    document.getElementById('cart-content').style.display = 'none';
    document.getElementById('alternative_title').style.display = 'block';
    document.getElementById('normal_title').style.display = 'none';
}

function hidePaymentForm() {
    event.preventDefault();
    document.getElementById('payment-form').style.display = 'none';
    document.getElementById('cart-content').style.display = 'block';
    document.getElementById('alternative_title').style.display = 'none';
    document.getElementById('normal_title').style.display = 'block';
}