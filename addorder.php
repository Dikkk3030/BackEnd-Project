<?php
    require_once 'koneksi.php';

    session_start();

    $email = $_SESSION['email'];

    // Memperbaiki query SQL
    $account = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

    if (!$account) {
        die("Query Error: " . mysqli_error($conn));
    }

    $akun = mysqli_fetch_assoc($account);

    if (!$akun) {
        die("Akun tidak ditemukan.");
    }


    $nama = htmlspecialchars($_GET['nama']);

    // Menggunakan prepared statement untuk menghindari SQL injection
    $stmt = $conn->prepare("SELECT * FROM produk WHERE nama = ?");
    $stmt->bind_param("s", $nama);
    $stmt->execute();
    $result = $stmt->get_result();
    $produk = $result->fetch_assoc();

    if (!$produk) {
        die("Produk tidak ditemukan.");
    }

    // Ambil ukuran yang tersedia untuk produk ini
    $stmtUkuran = $conn->prepare("SELECT ukuran FROM produk WHERE nama = ?");
    $stmtUkuran->bind_param("s", $produk['nama']);
    $stmtUkuran->execute();
    $resultUkuran = $stmtUkuran->get_result();

    $ukuran_options = [];
    while ($row = $resultUkuran->fetch_assoc()) {
        $ukuran_options[] = $row['ukuran'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Produk</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require "navbar.php"; ?>
    
    <!-- Form Pemesanan -->
    <div class="container-fluid py-5">
        <div class="container mt-5">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="image/<?php echo $produk['foto']; ?>" class="img-fluid rounded-start" alt="Foto Produk">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fs-3"><?php echo $produk['nama']; ?></h5>
                            <form action="order.php" method="POST">
                                <input type="hidden" name="nama_" value="<?php echo $produk['nama']; ?>">
                                <input type="hidden" name="harga" value="<?php echo $produk['harga']; ?>">
                                
                                <div class="mb-3">
                                    <label for="ukuran" class="form-label">Ukuran</label>
                                    <select class="form-select" id="ukuran" name="ukuran" required>
                                        <option value="" disabled selected>Pilih ukuran</option>
                                        <?php foreach ($ukuran_options as $ukuran) { ?>
                                            <option value="<?php echo $ukuran; ?>"><?php echo $ukuran; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required>
                                </div>

                                <div class="d-flex justify-content-end align-items-end">
                                    <button type="submit" class="btn btn-success" style="width: 16%;">Pesan</button>
                                </div>
                            </form>
                        </div>
                    </div>
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