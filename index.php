<?php
    require_once 'koneksi.php';
    $queryproduk = mysqli_query($conn,"SELECT id, nama, harga, foto, detail FROM produk LIMIT 6");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<?php
    require "navbar.php"
?>
    <!-- Banner -->
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Yudikarya Batik</h1>
            <h2>Mau cari Batik?</h2>
            <!-- Search bar -->
            <div class="col-md-8 offset-md-2">
                <form method="get" action="produk.php">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Nama Batik....." aria-label="NamaBatik" aria-describedby="basic-addon2" name="keyword">
                        <button type="submit" class="btn btn-outline-warning warna2 text-white">Search</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
    
    <!-- Highlighted kategori -->
     <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Kategori Terlaris</h3>
            <div class="row mt-5">
                <!-- Kalo nambahin kategori copy paste dari Div ini sampai /div pertama sama gambar di isi di css -->
                    <div class="col-md-4 mb-3">
                        <div class="highlighted-kategori kategori-batik-pria d-flex justify-content-center align-items-center">
                            <h4 class="text-white"><a class="no-decoration" href="product.php?">Batik Pria</a></h4>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="highlighted-kategori kategori-batik-wanita d-flex justify-content-center align-items-center">
                            <h4 class="text-white"><a class="no-decoration" href="product.php?">Batik Wanita</a></h4>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="highlighted-kategori kategori-batik-anak d-flex justify-content-center align-items-center">
                            <h4 class="text-white"><a class="no-decoration" href="product.php?">Batik Anak</a></h4>
                    </div> 
                </div>
            </div>
        </div>
     </div>

      <!-- Halaman Produk -->
        <div class="container-fluid py5">
            <div class="container text-center">
                <h3>Produk</h3>
        <!-- Produk Card foto bisa di isi di src-->
                <div class="row mt-5">
                    <?php while($data = mysqli_fetch_array($queryproduk)){ ?>
                    <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card">
                        <img class="card-img-top" src="assets/<?php echo $data['foto']; ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $data['nama']; ?></h5>
                                    <p class="card-text text-truncate"><?php echo $data['detail']; ?></p>
                                    <p class="card-text text-harga">Rp<?php echo $data['harga']; ?></p>
                                    <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>" class="btn warna2 text-white">Lihat Detail</a>
                            </div>
                        </div> 
                    </div>
                    <?php  } ?>
                    <!-- Button see more -->
                     <div class="seemore">
                    <a href="produk.php" class="btn btn-outline-warning warna1 mt-1 p-1 fs-1 text-white">See More</a>
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

<!-- Sampai di Menit 45.27 Video ke part 6 (nunggu nama database karena mau di input) -->
    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html> 