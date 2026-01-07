<?php
    // Pastikan koneksi database ($conn) sudah tersedia dari file induk (index.php)
    
    // Inisialisasi status admin
    $showDashboard = false;

    // Cek apakah ada user yang login
    if (isset($_SESSION['username'])) {
        $userLog = $_SESSION['username'];
        
        // Ambil data role user tersebut dari database
        $queryCekRole = mysqli_query($conn, "SELECT roles FROM users2 WHERE username = '$userLog'");
        
        if ($row = mysqli_fetch_assoc($queryCekRole)) {
            // LOGIKA: Tentukan siapa yang boleh melihat dashboard
            // Ganti '1' atau 'admin' sesuai dengan nilai role admin di database Anda
            if ($row['roles'] == 'admin' || $row['roles'] == 1) { 
                $showDashboard = true;
            }
        }
    }
?>

<script src="https://unpkg.com/@phosphor-icons/web"></script>
<link rel="stylesheet" href="css/style1.css">
<style>
    @import url(css/login2.css);
    @import url(css/login3.css);
</style>

<nav>
    <div id="menu-icon" class="menu-icon">
        <i class="ph-fill ph-list"></i>
    </div>

    <ul id="menu-list" class="hidden">
        <li><a href="index.php">Home</a></li>
        <li><a href="produk.php">Product</a></li>
        <li><a href="tentang-kami.php">About Us</a></li>
        <li><a href="contact-us.php">Contact Us</a></li>
    </ul>

    <ul>
        <?php if ($showDashboard) : ?>
            <li class="menu">
                <a href="adminpanel/index.php" style="color: blue;">Dashboard</a>
            </li>
        <?php endif; ?>
        <li class="menu">
            <a href="logout.php" style="color: red;">Logout</a>
        </li>
    </ul>

    <script src="js/navbarKlik.js"></script>
</nav>