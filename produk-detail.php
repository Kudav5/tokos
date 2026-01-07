<?php 
    require "koneksi.php";

    $nama = htmlspecialchars($_GET['nama']);
    $queryProduk = mysqli_query($conn,"SELECT * FROM produk WHERE nama='$nama'");
    $produk = mysqli_fetch_array($queryProduk);

    $queryProdukTerkait = mysqli_query($conn,"SELECT * FROM produk WHERE kategori_id='$produk[kategori_id]' AND id!='$produk[id]' LIMIT 4");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Produk</title>
    <link rel="stylesheet" href="fontawesome/fontawesome-5/css/all.min.css">
    <link rel="stylesheet" href="bootstrap/bootstrap-5/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require 'navbar.php'; ?>

    <div class="container-fluid py-5">
        <div class="container ">
            <div class="row">
                <div class="col-lg-5 mb-5 ">
                    <img src="image/<?php echo  $produk['foto']; ?>" class="w-100" alt="">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1><?php echo $produk['nama']; ?></h1>
                    <p class="fs-5">
                        <?php echo $produk['detail']; ?>
                    </p>
                    <p class="text-harga" id="harga">
                        Rp <?php echo $produk['harga']; ?>
                    </p>
                    <p class="fs-5">Status Ketersediaan : <strong><?php echo $produk['ketersediaan_stok']; ?></strong></p>

                    <form id="purchaseForm" method="post" action="process-purchase.php">
                        <input type="hidden" name="product_id" id="product_id" value="<?php echo $produk['id']; ?>">
                        
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="namaProduk" autocomplete="off">

                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat" autocomplete="off">

                        <label for="hp">No. HP</label>
                        <input type="number" id="hp" name="hp">

                        <label for="produknam">Produk</label>
                        <input type="text" id="produknam" name="produknam" disabled placeholder="<?php echo $produk['nama']; ?>">

                        <label for="harga">Harga</label>
                        <input type="number" id="harga" name="harga" disabled value="<?php echo $produk['harga']; ?>">

                        <label for="unites">Berapa unit</label>
                        <input type="number" id="unites" name="unites">

                        <h5 id="totalTransaksi">Total transaksi adalah Rp.</h5>

                        <button type="button" class="btn btn-primary warna2" id="cart">Add to Cart</button>
                        
                        <!-- hapus opsional
                            <a href="barcode.php?nama=<?php echo urlencode($produk['nama']); ?>&kode=<?php echo urlencode($produk['id']); ?>" target="_blank"></a>
                        -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Produk Terkait-->
    <div class="container-fluid py-5 warna2">
        <div class="container">
            <h2 class="text-center text-white mb-5">Produk Terkait</h2>
        
            <div class="row">
                <?php while($data=mysqli_fetch_array($queryProdukTerkait)){?>
                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="produk-detail.php?nama=<?php echo $data['nama'];?>">
                        <img src="image/<?php echo $data['foto'];?>" class="img-fluid img-thumbnail produk-terkait-img" alt="">
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require 'footer.php'; ?>
    <script src="bootstrap/bootstrap-5/js/bootstrap.bundle.min.js"></script> 
    <script src="fontawesome/fontawesome-5/js/all.min.js"></script>
    <script src="js/adtocart.js?v=1.0.1"></script>
</body>
</html>
