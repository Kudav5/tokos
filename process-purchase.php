<?php
require "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data dari form
    //$id = $_GET["product_id"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $hp = $_POST["hp"];
    $unit = $_POST["unites"];
    $produk = $_POST["produknam"];
    $harga = $_POST["harga"];

    $query = "INSERT INTO pembeli (nama, alamat, nohp) VALUES ('$nama', '$alamat', '$hp')";
    mysqli_query($conn, $query);

    mysqli_close($conn);

    // Perform necessary actions (e.g., update database, add to cart, etc.)
    // You can add more logic here based on your requirements.

    // Redirect to a thank you page or shopping cart page
    header("Location: thank-you.php");
    exit();
} else {
    // Redirect to an error page if accessed without POST request
    header("Location: error.php");
    exit();
}


