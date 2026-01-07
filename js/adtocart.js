document.addEventListener("DOMContentLoaded", function() {
    const nama = document.getElementById("nama");
    const id = document.getElementById("product_id");
    let alamat = document.getElementById("alamat");
    let hp = document.getElementById("hp");
    let produk = document.getElementById("produknam");
    let unit = document.getElementById("unites");
    let harga = document.getElementById("harga");
    let button = document.querySelector("#cart");

    // Check if elements are present
    if (!nama || !id || !alamat || !hp || !produk || !unit || !harga || !button) {
        console.error("One or more elements are missing.");
        return;
    }

    button.addEventListener("click", function(event) {
        event.preventDefault();  // Prevent form submission

        let total = harga.value * unit.value;
        alert("Pesan terkirim");

        const formData = new FormData();
        formData.append("id", id.value);
        formData.append("nama", nama.value);
        formData.append("alamat", alamat.value);
        formData.append("hp", hp.value);
        formData.append("unit", unit.value.toString());
        formData.append("produk", produk.value);
        formData.append("harga", harga.value);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "process-purchase.php", true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log(xhr.responseText);

                // Open the barcode page in a new tab

                /*  error Produk 'nama' tidak ditemukan.
                let barcodeUrl = `barcode.php?nama=${encodeURIComponent(produk.value)}&kode=${encodeURIComponent(id.value)}`;
                window.open(barcodeUrl, '_blank');
                */
            }
        };
        xhr.send(formData);
    });
});
