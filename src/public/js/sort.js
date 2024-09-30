document.addEventListener('DOMContentLoaded', function() {
    const selectElement = document.getElementById('order');
    
    // ページロード時に「並び替え：」を付ける
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    selectedOption.dataset.originalText = selectedOption.textContent; // 元のテキストを保持
    selectedOption.textContent = '並び替え：' + selectedOption.dataset.originalText.trim();

    // フォーカス時（プルダウンメニューを開くとき）
    selectElement.addEventListener('focus', function() {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        selectedOption.textContent = selectedOption.dataset.originalText; // 元のテキストに戻す
    });

    // フォーカスが外れた時（プルダウンメニューを閉じるとき）
    selectElement.addEventListener('blur', function() {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        selectedOption.textContent = '並び替え：' + selectedOption.dataset.originalText.trim();
    });

    // オプション変更時に「並び替え：」を付ける
    selectElement.addEventListener('change', function() {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        selectedOption.dataset.originalText = selectedOption.textContent; // 元のテキストを保持
        selectedOption.textContent = '並び替え：' + selectedOption.dataset.originalText.trim();
    });
});
