//ファイルを選択したとき現在表示されている画像を置き換える

document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');

    imageInput.addEventListener('change', function (event) {
        const file = event.target.files[0];

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result; // 選択した画像をプレビューに設定
            };

            reader.readAsDataURL(file); // ファイルを読み込む
        } else {
            alert('有効な画像ファイルを選択してください');
        }
    });
});
