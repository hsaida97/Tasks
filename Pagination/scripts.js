document.addEventListener('DOMContentLoaded', () => {
    const addToBasketButtons = document.querySelectorAll('.add-to-basket');
    const viewBasketButton = document.getElementById('view-basket');

    // Handle "Add to Basket" button clicks
    addToBasketButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const productItem = button.closest('.product-item');
            const productId = productItem.dataset.id;

            fetch('index.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'addToBasket',
                    productId: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    productItem.classList.add('hidden');
                } else {
                    console.error('Add to basket failed:', data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    // Handle "Remove from Basket" button clicks
    document.addEventListener('click', (event) => {
        if (event.target.classList.contains('btn-remove')) {
            event.preventDefault();

            const form = event.target.closest('form');
            const formData = new FormData(form);

            fetch('cart.php', {
                method: 'POST',
                body: new URLSearchParams(formData) // Convert FormData to URLSearchParams
            })
            .then(response => response.json())
            .then(data => {
                // console.log('Remove response:', data.message);
                window.location.reload(); // Reload to reflect changes
            })
            .catch(error => console.error('Error:', error));
        }
    });

    // Handle "View Basket" button click
    if (viewBasketButton) {
        viewBasketButton.addEventListener('click', () => {
            window.location.href = 'cart.php';
        });
    }
});
