<?php
// Koneksi ke database
require_once 'koneksi.php';

// Mengambil data dari URL
$nama_produk = htmlspecialchars($_POST['nama']);
$jumlah_pesanan = htmlspecialchars($_POST['jumlah']);
$ukuran_pesanan = htmlspecialchars($_POST['ukuran']);

// Mengambil detail produk dari database
$queryproduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama = '$nama_produk'");
$produk = mysqli_fetch_array($queryproduk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require "navbar.php"; ?>

    <div class="container mt-5">
        <h2 class="text-center">Detail Pesanan</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $produk['nama']; ?></h5>
                <img src="image/<?php echo $produk['foto']; ?>" class="img-fluid" alt="Foto Produk">
                <table class="table mt-3">
                    <tbody>
                        <tr>
                            <th scope="row">Harga</th>
                            <td>Rp. <?php echo number_format($produk['harga'], 0, ',', '.'); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Ukuran</th>
                            <td><?php echo $ukuran_pesanan; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Jumlah Pesanan</th>
                            <td><?php echo $jumlah_pesanan; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Total Harga</th>
                            <td>Rp. <?php echo number_format($produk['harga'] * $jumlah_pesanan, 0, ',', '.'); ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>

</html>