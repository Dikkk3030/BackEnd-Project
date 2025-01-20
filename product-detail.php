<?php
    require_once 'koneksi.php';

    $id = htmlspecialchars($_GET['id']);
    $queryproduk = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$id'");
    $produk = mysqli_fetch_array($queryproduk);

    $ukuran = mysqli_query($conn, "SELECT ukuran FROM produk WHERE nama = '{$produk['nama']}'");
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
        <div class="container mt-5">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="image/<?php echo $produk ['foto'] ?>" class="img-fluid rounded-start" alt="Foto Produk">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fs-3"><?php echo $produk ['nama'] ?></h5>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">Harga</th>
                                        <td>Rp. <?php echo $produk ['harga'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Ukuran</th>
                                        <td>
                                            <?php
                                                if ($ukuran->num_rows > 0) {
                                                    while($row = $ukuran->fetch_assoc()) {
                                                    echo $row["ukuran"] . " , ";
                                                    }
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Ketersediaan</th>
                                        <td><?php echo $produk ['ketersediaan_stok'] ?></td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end align-items-end">
                                <a href="addorder.php?nama=<?php echo $produk['nama']; ?>" class="btn btn-success" style="width: 16%;">Pesan</a>
                            </div>
                        </div>
                    </div>
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
                        <img src="assets/<?php echo $data ['foto']?>"
                            class="image-fluid img-thumbnail produk-terkait-image">
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
            <p class="fs-5 mb-3">Selamat datang di Membatik, destinasi online untuk Anda yang mencari keindahan,
                kualitas, dan keunikan Batik Indonesia. Kami adalah toko e-commerce yang didedikasikan untuk
                memperkenalkan dan memasarkan karya seni Batik dari berbagai daerah di Indonesia, sekaligus mendukung
                para pengrajin lokal yang dengan penuh cinta menciptakan setiap helainya. Menjadi platform terdepan
                dalam memperkenalkan warisan budaya Batik Indonesia ke seluruh dunia, sembari memberikan pengalaman
                berbelanja yang nyaman, modern, dan aman. Kami percaya bahwa Batik bukan sekadar kain, tetapi sebuah
                cerita, tradisi, dan identitas. Dengan setiap pembelian di Membatik, Anda turut mendukung keberlanjutan
                seni dan budaya Indonesia.</p>
        </div>
    </div>


    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>

</html>