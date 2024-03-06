document.addEventListener('DOMContentLoaded', function () {
    let favoriteButtons = document.querySelectorAll('.favorite-btn');

    // お気に入りボタンがクリックされた時の処理
    favoriteButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            let restaurantId = this.getAttribute('data-restaurant-id');
            let isFavorite = this.classList.contains('clicked');

            let formData = new FormData();
            formData.append('restaurant_id', restaurantId);

            let formAction = isFavorite ? '/favorite/remove' : '/favorite/add';

            let csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                console.error('CSRF token meta tag not found');
                return;
            }

            fetch(formAction, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content')
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        button.classList.toggle('clicked');
                    } else {
                        console.error('Request failed:', data.error);
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });
        });
    });

    // お気に入り情報を取得する
    fetch('/user/favorites')
        .then(response => response.json())
        .then(data => {
            // レスポンスからお気に入りのレストランIDのリストを取得する
            let favorites = data.favorites;

            // 各restaurant_cardのハートアイコンの状態を更新する
            favoriteButtons.forEach(function (button) {
                let restaurantId = button.getAttribute('data-restaurant-id');
                if (favorites.includes(parseInt(restaurantId))) {
                    button.classList.add('clicked');
                }
            });
        })
        .catch(error => {
            console.error('Fetch error:', error);
            console.error('Specific error message:', error.message); // エラーの詳細メッセージを出力
        });
});