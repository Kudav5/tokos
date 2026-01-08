<?php
require 'session.php';
require '../koneksi.php';

$queryPembeli = mysqli_query($conn, "SELECT * FROM pembeli");
$jumlahPembeli = mysqli_num_rows($queryPembeli);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembeli</title>
    <link rel='stylesheet' href="../bootstrap/bootstrap-5/css/bootstrap.min.css">
    <link rel='stylesheet' href="../fontawesome/fontawesome-5/css/fontawesome.min.css">
    <style>
        .nodecoration {
            text-decoration: none;
        }

        /* Additional styles for table */
        table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }

        .btn-action {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel" class="no-decoration text-muted">
                        <i class="fa-solid fa-house"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Pembeli
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="pembeli" class="form-label">Cari Nama Pembeli</label>
                    <input type="text" id="pembeli" name="pembeli" autocomplete="off" class="form-control">
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="cari_pembeli">Cari</button>
                </div>
            </form>

            <?php
            // PHP untuk menampilkan hasil pencarian
            if (isset($_POST['cari_pembeli'])) {
                // Ambil nilai dari input pencarian
                $pembeli = htmlspecialchars($_POST['pembeli']);

                // Query untuk mencari pembeli berdasarkan nama
                $queryExist = mysqli_query($conn, "SELECT * FROM pembeli WHERE nama LIKE '%$pembeli%'");
                $jumlahDataPembeli = mysqli_num_rows($queryExist);

                $queProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama LIKE '%$pembeli%'");
                $jumlahDataProduk = mysqli_num_rows($queProduk);

                // Jika ada hasil pencarian
                if ($jumlahDataPembeli > 0) {
                    echo "<p>Pencarian untuk nama '$pembeli' ditemukan:</p>";
            ?>
                    <div class="table-responsive mt-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Produk yang Dibeli</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nomor = 1;
                                while ($dataPembeli = mysqli_fetch_assoc($queryExist)) {
                                ?>
                                    <tr>
                                        <td><?php echo $nomor; ?></td>
                                        <td><?php echo $dataPembeli['nama']; ?> </td>
                                        <td><?php echo $dataPembeli['alamat']; ?></td>
                                        <td><?php echo $dataPembeli['produk']; ?></td>

                                        
                                    </tr>
                                    
                                <?php
                                    $nomor++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                } else {
                    echo "<p>Pencarian untuk nama '$pembeli' tidak ditemukan.</p>";
                }

                // Pastikan untuk menutup koneksi setelah selesai digunakan
                mysqli_close($conn);
            }
            ?>
        </div>

        <div class="mt-3">
            <h2>List Pembeli</h2>

            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. HP</th>
                            <th>Produk yang Dibeli</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahPembeli == 0) {
                        ?>
                            <tr>
                                <td colspan="5" class="text-center">Data Pembeli tidak tersedia.</td>
                            </tr>
                            <?php
                        } else {
                            $nomor = 1;
                            while ($data = mysqli_fetch_array($queryPembeli)) {
                            ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo $data['alamat']; ?></td>
                                    <td><?php echo $data['nohp']; ?></td>
                                    <td><?php echo $data['produk']; ?></td>
                                </tr>
                        <?php
                                $nomor++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../bootstrap/bootstrap-5/js/js.bundle.min.js"></script>
    <script src="../fontawesome/fontawesome-5/js/all.min.js"></script>
</body>

</html>
