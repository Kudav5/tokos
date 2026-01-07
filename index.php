<?php
    session_start();
    
    // kalau tidak login, ke login.php
    if(!isset($_SESSION['login'])) {
        header('location: login.php');
        exit;
    }

    require "koneksi.php";
    
    $queryProduk = mysqli_query($conn,"SELECT *FROM produk  LIMIT 6");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop | Home</title>
    <link rel="stylesheet" href="fontawesome/fontawesome-5/css/fontawesome.min.css">
    <link rel="stylesheet" href="bootstrap/bootstrap-5/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require 'navbar.php'; ?>

    <!-- Banner -->
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Foodrinks shop</h1>
            <h2>What do you want to find?</h2>
            <div class="col-8 offset-2">
                <form method="get" action="produk.php">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Nama Barang" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                        <button class="btn warna2 text-white zindex" type="submit">Telusuri</button>
                        <style>

                        </style>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- kategori -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Kategori</h3>
            <div class="row mt-5 ">
                <div class="col-md-4 mb-3" >
                    <div class="highlighted-kategori kategori_makanan d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=makanan">Makanan</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3" >
                    <div class="highlighted-kategori kategori_minuman d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=minuman">minuman</a> </h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3" >
                    <div class="highlighted-kategori d-flex kategori_rinso justify-content-center align-items-center">
                    <h4 class="text-white"><a class="no-decoration" href="produk.php">Lainnya</a></h4>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- tentang kami -->
    <div class="container-fluid warna3 py-5">
        <div class="container text-center">
            <h3>About Us</h3>
            <p>
            We are a team that sells various foods and drinks to our customers.
            </p>
        </div>
    </div>

    <!-- produk -->
    <div class="container-fluid  py-5">
        <div class="container text-center">
            <h3>Produk</h3>
            
            <div class="row mt-5">
            <?php while($data = mysqli_fetch_array($queryProduk)){ ?>
                <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card h-100" >
                        <div class="image-box">
                            <img src="image/<?php echo $data ['foto'];?>" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $data['nama'];?></h5>
                            <p class="card-text text-truncate"><?php echo $data['detail'] ?></p>
                            <p class="card-text text-harga">Rp <?php echo $data['harga']; ?></p>
                            <a href="produk-detail.php?nama=<?php echo $data['nama'];?>" class="btn warna1 text-white">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
            <a href="produk.php" class="btn btn-outline-warning mt-4 p-3">See More</a>

        </div>
    </div>

   <?php require 'footer.php'; ?>
    <style>
        @import url(css/style.css);
    </style>

    <script src="bootstrap/bootstrap-5/js/js.bundle.min.js"></script> 
    <script src="fontawesome/fontawesome-5/js/all.min.js"></script>   
</body>
</html>
