<?php
require "koneksi.php";

// Memeriksa apakah parameter 'nama' tersedia
if (isset($_GET['nama'])) {
    $nama = htmlspecialchars($_GET['nama']);
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama='$nama'");

    // Memeriksa apakah query berhasil dan mendapatkan hasil
    if ($produk = mysqli_fetch_array($queryProduk)) {
        $queryProdukTerkait = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='{$produk['kategori_id']}' AND id!='{$produk['id']}' LIMIT 4");
    } else {
        echo "Produk tidak ditemukan.";
        exit;
    }
} else {
    echo "Parameter 'nama' tidak tersedia.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.js"></script>
</head>

<body>
    <input type="hidden" name="product_id" value="<?php echo $produk['id']; ?>">
    <?php
    if (isset($_GET['kode'])) {
        $kode_barcode = str_replace(' ', '_', $_GET['kode']);
        ?>
        <center>
            <br>
            <style>
                #qrcode {
                    width: 160px;
                    height: 160px;
                    margin-top: 15px;
                    color: blue;
                }
            </style>
        </center>
        <div id="qrcode"></div>
        <script type="text/javascript">
            var qrcode = new QRCode(document.getElementById("qrcode"), {
                text: "Kode: <?php echo $kode_barcode; ?>, <?php echo $produk['nama']; ?>, Harga: Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?>",
                width: 128,
                height: 128,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

            function makeCode() {
                setTimeout(function() {
                    var canvas = document.querySelector('#qrcode canvas');
                    var context = canvas.getContext('2d');
                    context.lineWidth = 2;
                    context.strokeStyle = '#ffffff';
                    context.strokeRect(0, 0, canvas.width, canvas.height);

                    var dataURL = canvas.toDataURL('image/png');
                    var downloadLink = document.getElementById('download-link');
                    downloadLink.href = dataURL;
                }, 500); // Waktu tunda untuk memastikan QR code telah selesai digambar
            }

            makeCode();
        </script>

        <a id="download-link" href="#" download="qrcode.png">
            <button>Unduh QR Code</button>
        </a>
        <?php
    } else {
        echo "Kode QR tidak tersedia.";
    }
    ?>
</body>

</html>