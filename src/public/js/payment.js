
var stripe = Stripe("{{ config('services.stripe.key') }}");
var elements = stripe.elements();
var cardElement = elements.create('card');
cardElement.mount('#card-element');

var form = document.getElementById('payment-form');
form.addEventListener('submit', async function(event) {
    event.preventDefault();

    const {token, error} = await stripe.createToken(cardElement);
    if (error) {
        alert(error.message);
    } else {
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        form.submit();
    }
});
