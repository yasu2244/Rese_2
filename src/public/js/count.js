document.addEventListener('DOMContentLoaded', function () {
    var textarea = document.getElementById('comment');
    var charCounter = document.getElementById('char-counter');

    textarea.addEventListener('input', function () {
        var currentLength = textarea.value.length;
        charCounter.textContent = currentLength + "/400 (最高文字数)";
    });
});
