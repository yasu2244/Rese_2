document.addEventListener('DOMContentLoaded', () => {
    const stripe = Stripe(stripePublicKey);

    document.querySelectorAll('.pay-button').forEach(button => {
        button.addEventListener('click', async () => {
            const reservationId = button.getAttribute('data-reservation-id');
            if (!reservationId) {
                alert('予約IDが無効です。ページを再読み込みしてください。');
                return;
            }

            // **支払い方法を更新**
            const updated = await updatePaymentMethod(reservationId, 'credit_card');
            if (!updated) return;

            fetch('/payment/session', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ reservation_id: reservationId }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(`決済エラー: ${data.error}`);
                    return;
                }
                stripe.redirectToCheckout({ sessionId: data.id });
            })
            .catch(error => {
                console.error('決済エラー:', error);
                alert('決済処理にエラーが発生しました。');
            });
        });
    });

    document.querySelectorAll('.qr-button').forEach(link => {
        link.addEventListener('click', async (event) => {
            // event.preventDefault(); // ← 一旦コメントアウトして遷移を許可
    
            const reservationId = link.getAttribute('data-reservation-id');
            const qrPaymentUrl = link.getAttribute('href');
            const method = link.getAttribute('data-method');
    
            if (!reservationId || !qrPaymentUrl) {
                alert('予約IDまたはQR決済URLが無効です。ページを再読み込みしてください。');
                return;
            }
    
            // **支払い方法の更新**
            const updated = await updatePaymentMethod(reservationId, method);
            if (!updated) {
                alert('支払い方法の更新に失敗しました。');
                return;
            }
    
            console.log('支払い方法の更新成功: ', method);
            console.log('遷移先URL: ', qrPaymentUrl);
    
            // **支払い方法の更新が成功したらQRコードページへ遷移**
            window.location.href = qrPaymentUrl;
        });
    });
    
    
    
});
