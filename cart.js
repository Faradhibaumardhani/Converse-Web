// cart.js
document.addEventListener('DOMContentLoaded', function() {
    const cart = JSON.parse(localStorage.getItem('cartItems')) || [];
    const cartItemsContainer = document.getElementById('cart-items');
    const cartTotalElement = document.getElementById('cart-total');
    let total = 0;

    // Display cart items
    cart.forEach((item, index) => {
        cartItemsContainer.innerHTML += `
            <tr>
                <td>${item.name}</td>
                <td>${formatRupiah(item.price)}</td>
                <td>
                    <button class="btn btn-secondary btn-sm" onclick="changeQuantity(${index}, 1)">+</button>
                    ${item.quantity}
                    <button class="btn btn-secondary btn-sm" onclick="changeQuantity(${index}, -1)">-</button>
                </td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="removeItem(${index})">Remove</button>
                </td>
            </tr>
        `;
        total += item.price * item.quantity;
    });

    cartTotalElement.textContent = formatRupiah(total);

    // Event listener for checkout button
    document.getElementById('checkout-btn').addEventListener('click', function() {
        // Simpan cart ke localStorage dengan key 'checkout-cart'
        localStorage.setItem('checkout-cart', JSON.stringify(cart));
        // Arahkan ke halaman checkout
        window.location.href = 'checkout.html'; // Misalnya ke halaman checkout
    });
});

// Function to remove item from cart
function removeItem(index) {
    let cart = JSON.parse(localStorage.getItem('cartItems')) || [];
    cart.splice(index, 1);  // Remove item at specified index
    localStorage.setItem('cartItems', JSON.stringify(cart));
    location.reload();  // Refresh the page to update the cart display
}

// Function to change quantity of an item
function changeQuantity(index, change) {
    let cart = JSON.parse(localStorage.getItem('cartItems')) || [];
    const item = cart[index];
    item.quantity += change;

    // Remove item if quantity is 0 or less
    if (item.quantity <= 0) {
        cart.splice(index, 1);
    }

    localStorage.setItem('cartItems', JSON.stringify(cart));
    location.reload();  // Refresh the page to update the cart display
}

// Function to format number as Rupiah
function formatRupiah(number) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(number);
}
