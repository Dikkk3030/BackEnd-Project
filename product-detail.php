<?php
    require_once 'koneksi.php';

    $nama = htmlspecialchars($_GET['nama']);
    $queryproduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama = '$nama'");
    $produk = mysqli_fetch_array($queryproduk);
    // var_dump($produk);

    $queryprodukterkait = mysqli_query($conn,"SELECT * FROM produk WHERE kategori_id = $produk[kategori_id]'AND id!='$produk[id]'LIMIT 4");
    $produkterkait = mysqli_fetch_array($queryprodukterkait);
    // var_dump($produkterkait)
    // Belum dapet tes karena data base kosong
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Detail</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php
        require "navbar.php"
    ?>
    <!-- Detail Produk -->
    <div class="container-fluid py-5">
        <div class="container">

            <div class="row">
                    <div class="col-lg-5 mb-5">
                        <img src="assets/<?php echo $produk ['foto'] ?>"class="w-100" alt="">
                    </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1><?php echo $produk ['nama'] ?></h1>
                    <p class=" fs-5"><?php echo $produk ['detail'] ?></p>
                    <p class="text-harga">Rp<?php echo $produk ['harga'] ?></p>
                    <p class="fs-5">Status Ketersediaan :<strong> <?php echo $produk ['ketersediaan_stok'] ?> </strong> </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Produk Terkait -->
     <div class="container-fluid py-5 warna2"> 
        <div class="container">
            <h2 class="text-center text-white mb-5"> Produk Terkait</h2>

            <div class="row">
            <?php while ($data = mysqli_fetch_array($queryprodukterkait)){?>
                < class=" col-md-6 col-lg-3 mb-3">
                    <a href="produk-detail.php?nama=<?php echo $data['nama']?>">
                        <img src="assets/<?php echo $data ['foto']?>" class="image-fluid img-thumbnail produk-terkait-image">
                     </a>
                </div>
            <?php }?>
                </div>
            </div>
        </div>
     </div>

    <!-- Tentang Kami  -->
      <div class="container-fluid warna3 mt-5 py-5">
        <div class="container text-center">
            <h3>Tentang Kami</h3>
            <p class="fs-5 mb-3">Selamat datang di Membatik, destinasi online untuk Anda yang mencari keindahan, kualitas, dan keunikan Batik Indonesia. Kami adalah toko e-commerce yang didedikasikan untuk memperkenalkan dan memasarkan karya seni Batik dari berbagai daerah di Indonesia, sekaligus mendukung para pengrajin lokal yang dengan penuh cinta menciptakan setiap helainya. Menjadi platform terdepan dalam memperkenalkan warisan budaya Batik Indonesia ke seluruh dunia, sembari memberikan pengalaman berbelanja yang nyaman, modern, dan aman. Kami percaya bahwa Batik bukan sekadar kain, tetapi sebuah cerita, tradisi, dan identitas. Dengan setiap pembelian di Membatik, Anda turut mendukung keberlanjutan seni dan budaya Indonesia.</p>
        </div>
      </div>


    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>