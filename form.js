document.addEventListener('DOMContentLoaded', function() {
    const cart = JSON.parse(localStorage.getItem('checkout-cart')) || [];

        if (cart.length > 0) {
        cart.forEach(item => {
            document.getElementById('notes').value += `Product: ${item.name}, Quantity: ${item.quantity}, Price: ${formatRupiah(item.price)}\n`;
        });
    }

    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        e.preventDefault();  

        const formData = new FormData(this);
        const data = {};

        formData.forEach((value, key) => {
            data[key] = value;
        });

         data.cartItems = cart;

         fetch('process_checkout.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data) 
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message); 
            if (data.message === 'Checkout berhasil!') {
                localStorage.removeItem('checkout-cart');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

function formatRupiah(number) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(number);
}
