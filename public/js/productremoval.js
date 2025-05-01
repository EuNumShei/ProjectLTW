document.addEventListener('DOMContentLoaded', function() {
    var removeButtons = document.querySelectorAll('.remove-button-wishlist');

    removeButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            var phoneId = this.getAttribute('data-phone-id');
            var phonePrice = parseFloat(this.getAttribute('data-phone-price'));

            fetch('../actions/removing-items.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'phone_id': phoneId,
                    'action': 'remove_from_wishlist'
                })
            })
            .then(response => response.text())
            .then(() => {
                var row = document.querySelector('button[data-phone-id="' + phoneId + '"]').closest('tr');
                row.remove();

                var totalPriceElement = document.querySelector('#wishlist-total h3');
                var totalPriceText = totalPriceElement.textContent.replace('Total: €', '').replace(/\s/g, '');
                var totalPrice = parseFloat(totalPriceText) - phonePrice;
                totalPriceElement.textContent = 'Total: €' + totalPrice.toFixed(2);

                if (document.querySelectorAll('.wishlist-table tr').length === 1) {
                    document.querySelector('.wishlist-table').remove();
                    document.querySelector('#wishlist-total h3').textContent = 'Total: €0';
                }
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var removeButtons = document.querySelectorAll('.remove-button-cart');

    removeButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            var phoneId = this.getAttribute('data-phone-id');
            var phonePrice = parseInt(this.getAttribute('data-phone-price'));

            fetch('../actions/removing-items.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'phone_id': phoneId,
                    'action': 'remove_from_cart'
                })
            })
            .then(response => response.text())
            .then(data => {
                data = JSON.parse(data);
                if (data.success) {
                    var row = document.querySelector('button[data-phone-id="' + phoneId + '"]').closest('tr');
                    row.remove();
            
                    var totalPriceElement = document.querySelector('#cart-total h3');
                    var totalPriceText = totalPriceElement.textContent.replace('Total: €', '').replace(/\s/g, '');
                    var totalPrice = parseInt(totalPriceText) - phonePrice;
                    totalPriceElement.textContent = 'Total: €' + totalPrice.toFixed(2);
            
                    if (document.querySelectorAll('.cart-table tr').length === 1) {
                        document.querySelector('.cart-table').remove();
                        document.querySelector('#cart-total h3').textContent = 'Total: €0';
                    }
                } else {
                    console.error('Failed to remove item from cart');
                }
            });
        });
    });
});