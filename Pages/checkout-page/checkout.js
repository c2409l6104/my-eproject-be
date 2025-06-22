const paymentSelect = document.querySelector('select[name="payment_method"]');
const bankOptions = document.getElementById('bank-options');

paymentSelect.addEventListener('change', function () {
    if (this.value === 'bank') {
        bankOptions.style.display = 'block';
        document.querySelectorAll('input[name="bank_option"]').forEach(e => e.required = true);
    } else {
        bankOptions.style.display = 'none';
        document.querySelectorAll('input[name="bank_option"]').forEach(e => e.required = false);
    }
});
function toggleBankOptions() {
    const payment = document.getElementById("payment-method").value;
    const bankOptions = document.getElementById("bank-options");
    bankOptions.style.display = payment === "bank" ? "block" : "none";
}