document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('images'); // inputのID修正
    const dropArea = document.getElementById('drop-area');
    const imagePreview = document.getElementById('image-preview');
    const uploadText = document.getElementById('upload-text');

    // ドロップエリアをクリックした際にファイル選択ダイアログを表示
    dropArea.addEventListener('click', function () {
        imageInput.click(); // クリックでファイル選択ダイアログを開く
    });

    // ドラッグ＆ドロップ時の動作を設定
    dropArea.addEventListener('dragover', function (e) {
        e.preventDefault();  // デフォルトの動作を無効に
        e.stopPropagation();  // イベントの伝播を止める
        dropArea.style.backgroundColor = '#e1e7f0';  // ドラッグ中のスタイル
    });

    dropArea.addEventListener('dragleave', function (e) {
        e.preventDefault();  // デフォルトの動作を無効に
        e.stopPropagation();  // イベントの伝播を止める
        dropArea.style.backgroundColor = 'rgb(243, 244, 246)';  // 元のスタイルに戻す
    });

    // ドロップ時の動作
    dropArea.addEventListener('drop', function (e) {
        e.preventDefault();  // デフォルトの動作を無効に
        e.stopPropagation();  // イベントの伝播を止める

        dropArea.style.backgroundColor = 'rgb(243, 244, 246)';  // 元のスタイルに戻す

        const files = e.dataTransfer.files;  // ドロップされたファイルを取得

        // ファイルが選択された時と同じ動作を行う
        if (files.length > 0) {
            imageInput.files = files;  // ドロップされたファイルを<input>にセット
            previewFiles(files);  // 画像プレビューを表示
        }
    });

    // ファイルが選択された時のプレビュー表示
    imageInput.addEventListener('change', function () {
        previewFiles(imageInput.files);  // 選択されたファイルをプレビュー
    });

    function previewFiles(files) {
        // 既存のプレビュー画像をクリア
        while (imagePreview.firstChild) {
            imagePreview.removeChild(imagePreview.firstChild);
        }

        // 選択されたファイルがあればプレビュー表示、なければテキストを再表示
        if (files.length > 0) {
            Array.from(files).forEach(file => {
                // 画像ファイルの場合のみプレビュー表示
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '200px';  // プレビュー画像のサイズを調整
                        img.style.margin = '10px';  // 少し余白を追加
                        imagePreview.appendChild(img);
                    };

                    reader.readAsDataURL(file);  // ファイルをDataURL形式で読み込む
                }
            });
            // プレビューが表示された場合、テキストを消す
            uploadText.style.display = 'none';
        } else {
            // 画像が選択されなければ、テキストを再表示
            uploadText.style.display = 'block';
        }
    }
});
