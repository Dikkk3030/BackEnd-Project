<?php
    require_once 'session.php';
    require_once '../koneksi.php';

    $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);

    $queryProduk = mysqli_query($conn, "SELECT * FROM produk");
    $jumlahProduk = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>
    <style>
        .kotak{
            border: solid;
        }

        .summary-kategori{
            background-color: #02476C;
            border-radius: 10px;
        }

        .summary-produk{
            background-color: #027876;
            border-radius: 10px;
        }

        .link-button{
            background-color: white;
            padding: 10px;
            border-radius: 10px;
            text-decoration: none;
        }
    </style>
<body>
    <?php require_once 'navbar.php' ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fa-solid fa-house"></i>Home</li>
            </ol>
        </nav>
        <h2>Halo <?php echo $_SESSION['username'] ?></h2>
        <div class="container mt-5">
            <div class="row d-flex justify-content-between">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-kategori p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fa-solid fa-list-check fa-9x text-white"></i>
                            </div>
                            <div class="col-6">
                                <h3 class="fs-2 text-white">Kategori</h3>
                                <p class="fs-4 text-white"><?php echo $jumlahKategori; ?> Kategori</p>
                                <p><a href="kategori.php" class="text-dark link-button">Lihat Detail</a></p>
                            </div>
                        </div> 
                    </div>  
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-produk p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fa-solid fa-box fa-9x text-white"></i>
                            </div>
                            <div class="col-6">
                                <h3 class="fs-2 text-white">Produk</h3>
                                <p class="fs-4 text-white"><?php echo $jumlahProduk ?> Produk</p>
                                <p><a href="produk.php" class="text-dark link-button">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="summary-produk p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fa-solid fa-user fa-9x text-white"></i>
                            </div>
                            <div class="col-6">
                                <h3 class="fs-2 text-white">Customer</h3>
                                <p class="fs-4 text-white">15 Request</p>
                                <p><a href="#" class="text-dark link-button">Lihat Detail</a></p>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>