document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Mencegah reload halaman

    const formData = new FormData(this);
    const data = {};

    formData.forEach((value, key) => {
        data[key] = value;
    });

    fetch('process_checkout.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message); // Tampilkan pesan sukses/gagal
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
