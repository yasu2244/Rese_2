document.addEventListener('DOMContentLoaded', () => {
    const reservationId = document.getElementById('reservation-id').value;

    document.getElementById('check-payment-status').addEventListener('click', async () => {
        try {
            const response = await fetch(`/payment/status/${reservationId}`);
            const data = await response.json();

            if (data.status === 'succeeded') {
                alert('支払いが完了しました。マイページに戻ります。');
                window.location.href = '/mypage';
            } else {
                alert('まだ支払いが完了していません。');
            }
        } catch (error) {
            console.error('支払い確認エラー:', error);
            alert('支払い状況の確認に失敗しました。');
        }
    });
});
