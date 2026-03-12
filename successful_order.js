document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const orderId = urlParams.get('id');
    const success = urlParams.get('success');
    const amountCents = urlParams.get('amount_cents');
    const currency = urlParams.get('currency');
    
    if (!success || success !== 'true' || !orderId || !amountCents || !currency) {
        window.location.href = `/`;
    }
    let amount = (Int16Array)(amountCents / 100);
    document.querySelector('.elementor-25 .elementor-element.elementor-element-f2f3ae1 .elementor-heading-title').textContent += `<br>with ${currency} ${amount} of total paid.`
});