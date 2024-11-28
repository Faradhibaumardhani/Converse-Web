// Ambil data cart dari localStorage
let cart = JSON.parse(localStorage.getItem("cart")) || [];

// Render data cart ke dalam form
const cartContainer = document.getElementById("cartItems");
cart.forEach((item, index) => {
    cartContainer.innerHTML += `
        <div class="cart-item">
            <p>Product Name: ${item.product_name}</p>
            <p>
                Size: 
                <select name="size_${index}">
                    <option value="6.5" ${item.size === "6.5" ? "selected" : ""}>6.5</option>
                    <option value="7" ${item.size === "7" ? "selected" : ""}>7</option>
                    <option value="8" ${item.size === "8" ? "selected" : ""}>8</option>
                </select>
            </p>
            <p>
                Color: 
                <select name="color_${index}">
                    <option value="White" ${item.color === "White" ? "selected" : ""}>White</option>
                    <option value="Black" ${item.color === "Black" ? "selected" : ""}>Black</option>
                </select>
            </p>
            <p>
                Quantity: 
                <input type="number" name="quantity_${index}" value="${item.quantity}" min="1">
            </p>
            <p>Price: ${item.price}</p>
        </div>
        <hr>
    `;
});

// Update hidden input dengan data cart saat form dikirim
document.getElementById("checkoutForm").addEventListener("submit", function () {
    // Update data cart berdasarkan input terbaru
    cart = cart.map((item, index) => {
        const size = document.querySelector(`select[name="size_${index}"]`).value;
        const color = document.querySelector(`select[name="color_${index}"]`).value;
        const quantity = document.querySelector(`input[name="quantity_${index}"]`).value;

        return { ...item, size, color, quantity };
    });

    // Simpan data cart yang diperbarui ke hidden input
    document.getElementById("cartData").value = JSON.stringify(cart);
});
