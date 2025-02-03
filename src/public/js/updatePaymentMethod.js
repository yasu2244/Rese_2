async function updatePaymentMethod(reservationId, method) {
    try {
        const response = await fetch('/payment/method', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ reservation_id: reservationId, method: method }),
        });

        const data = await response.json();

        if (!response.ok) {
            console.error(`支払い方法の更新エラー: ${data.error || '不明なエラー'}`);
            alert(`支払い方法の更新に失敗しました: ${data.error || '不明なエラー'}`);
            return false;
        }

        console.log(`支払い方法更新成功: ${method}`);
        return true;
    } catch (error) {
        console.error('支払い方法更新エラー:', error);
        alert('支払い方法の更新に失敗しました。サーバーに問題がある可能性があります。');
        return false;
    }
}
