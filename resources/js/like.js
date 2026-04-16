document.addEventListener('DOMContentLoaded', () => {
    const likeBtn = document.getElementById('like-btn');
    if (!likeBtn) return;

    likeBtn.addEventListener('click', async () => {
        const url = likeBtn.dataset.likeUrl;
        const icon = likeBtn.querySelector('i');
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
            });

            const data = await response.json();

            if (data.liked) {
                icon.classList.remove('fa-regular');
                icon.classList.add('fa-solid');
                icon.classList.remove('text-secondary');
                icon.classList.add('text-danger');
            } else {
                icon.classList.remove('fa-solid');
                icon.classList.add('fa-regular');
                icon.classList.remove('text-danger');
                icon.classList.add('text-secondary');
            }
        } catch (error) {
            console.error('いいね処理に失敗しました', error);
        }
    });
});