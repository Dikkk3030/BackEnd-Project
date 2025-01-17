<?php
    require_once 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
</head>
<>
    <h1>
        Ini adalah laman Pengguna
    </h1>

<?php
    require "navbar.php"
?>
    <!-- Banner -->
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Toko Online Batik</h1>
            <h2>Search</h2>
            <!-- Search bar -->
            <div class="col-md-8 offset-md-2">
                <form method="get" action="produk.php">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Nama Batik" aria-label="NamaBatik" aria-describedby="basic-addon2" name="keyword">
                        <button type="submit" class="btn">Search</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
    
    <!-- Highlighted kategori -->
     <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Kategori Paling Laris</h3>
            <div class="row mt-5">
                <!-- Kalo nambahin kategori copy paste dari Div ini sampai /div pertama sama gambar di isi di css -->
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-batik-pria d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="">Batik Pria</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori .kategori-batik-wanita d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="">Batik Wanita</a></h4>
                    </div>
                </div>
            </div>
        </div>
     </div>

     <!-- Tentang Kami (warna bisa di fluid (disini) py-5) -->
      <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Tentang Kami</h3>
            <p class="fs-5 mb-3">"Paragraph"</p>
        </div>
      </div>

      <!-- Halaman Produk -->
        <div class="container-fluid py5">
            <div class="container text-center">
                <h3>Produk</h3>
        <!-- Produk Card foto bisa di isi di src-->
                <div class="row mt-5">
                    <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card">
                        <img class="card-img-top" src="..." alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                    <p class="card-text text-truncate">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <p class="card-text text-harga">Rp.999.999</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
<!-- Sampai di Menit 45.27 Video ke part 6 (nunggu nama database karena mau di input) -->
    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html> 