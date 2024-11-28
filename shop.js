// Array untuk menyimpan produk dalam keranjang (localStorage)
let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

// Fungsi untuk menambahkan produk ke keranjang
function addToCart(productName, productPrice) {
    console.log('Adding to cart:', productName, productPrice); // Debug log
    //find untuk mengecek produk sudah ada atau belum
    const existingProduct = cartItems.find(item => item.name === productName);

    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        const product = {
            name: productName,
            price: parseFloat(productPrice.replace(/[Rp\s.]/g, '').trim()), // Konversi harga ke angka
            quantity: 1
        };
        cartItems.push(product);
    }

    localStorage.setItem('cartItems', JSON.stringify(cartItems));
    updateCartIcon();
}

// Fungsi untuk update ikon keranjang (jumlah produk)
function updateCartIcon() {
    const cartBadge = document.querySelector('.badge');
    cartBadge.textContent = cartItems.length;
}

// Fungsi untuk memformat angka menjadi Rupiah
function formatRupiah(number) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(number);
}

// Event listener untuk tombol "Add"
document.querySelectorAll('.btn-dark').forEach(button => {
    button.addEventListener('click', (event) => {
        const productElement = event.target.closest('div');
        const productName = productElement.querySelector('p:nth-child(2)').textContent;
        const productPrice = productElement.querySelector('p:nth-child(3)').textContent;

        console.log('Product clicked:', productName, productPrice); // Debug log
        addToCart(productName, productPrice);
    });
});
