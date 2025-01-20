<?php
    require_once 'koneksi.php';
    $sql = "SELECT * FROM produk";
    $result = $conn->query($sql);
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
            <h1>Toko Online Batik</h1>
            <h2>Mau cari Batik?</h2>
            <!-- Search bar -->
            <div class="col-md-8 offset-md-2">
                <form method="get" action="produk.php">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Nama Batik....." aria-label="NamaBatik" aria-describedby="basic-addon2" name="keyword">
                        <button type="submit" class="btn warna2 text-white">Search</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>


      <!-- Halaman Produk -->
        <div class="container-fluid py5">
            <div class="container text-center">
                <h3>Produk</h3>
        <!-- Produk Card foto bisa di isi di src-->
        <?php
        if ($result->num_rows > 0) {
        // Output data dari setiap baris
            while($product = $result->fetch_assoc()) {
            echo '<div class="col-sm-6 col-md-4 mb-3">';
            echo '    <div class="card">';
            echo '        <img class="card-img-top" src="' . $product["foto"] . '" alt="Card image cap">';
            echo '        <div class="card-body">';
            echo '            <h5 class="card-title">' . $product["nama"] . '</h5>';
            echo '            <p class="card-text text-harga">' . $product["harga"] . '</p>';
            echo '            <a href="#" class="btn btn-primary warna2 text-white" style="width: 100%;">Lihat detail</a>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';
        }
        } else {
            echo "Tidak ada produk yang ditemukan.";
        }
        $conn->close();
        ?>

            </div>
        </div>

 <!-- Tentang Kami  -->
      <div class="container-fluid warna3 py-5">
        <div class="container text-center">
            <h3>Tentang Kami</h3>
            <p class="fs-5 mb-3">Selamat datang di Membatik, destinasi online untuk Anda yang mencari keindahan, kualitas, dan keunikan Batik Indonesia. Kami adalah toko e-commerce yang didedikasikan untuk memperkenalkan dan memasarkan karya seni Batik dari berbagai daerah di Indonesia, sekaligus mendukung para pengrajin lokal yang dengan penuh cinta menciptakan setiap helainya. Menjadi platform terdepan dalam memperkenalkan warisan budaya Batik Indonesia ke seluruh dunia, sembari memberikan pengalaman berbelanja yang nyaman, modern, dan aman. Kami percaya bahwa Batik bukan sekadar kain, tetapi sebuah cerita, tradisi, dan identitas. Dengan setiap pembelian di Membatik, Anda turut mendukung keberlanjutan seni dan budaya Indonesia.</p>
        </div>
      </div>

<!-- Sampai di Menit 45.27 Video ke part 6 (nunggu nama database karena mau di input) -->
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html> 