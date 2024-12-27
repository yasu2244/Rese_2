document.querySelector('form').addEventListener('submit', function(e) {
    const submitButton = this.querySelector('input[type="submit"]');
    submitButton.disabled = true;
    submitButton.value = '処理中...';
});
