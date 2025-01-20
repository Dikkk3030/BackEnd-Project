<?php 
    require_once 'session.php';
    require_once '../koneksi.php';

    $query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id = b.id");
    $productCount = mysqli_num_rows($query);

    $kategoriQuery = mysqli_query($conn, "SELECT * FROM kategori");

    function generateRandom($length = 10){
        $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charLength = strlen($char);
        $randomString = '';
        for($i = 0; $i < $length; $i++){
            $randomString .= $char[rand(0, $charLength - 1)];
        }
        return $randomString;
    }
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
        .no-decoration{
            text-decoration: none;
        }
    </style>
<body>
    <?php require_once 'navbar.php' ?>

    <div class="container mt-5">
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active pt-2" aria-current="page">
                    <a href="index.php" class="no-decoration text-muted"><i class="fa-solid fa-house px-2"></i> Home</a>
                </li>
                <li class="breadcrumb-item active pt-2" aria-current="page">
                     Produk
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Produk</h3>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="" hidden>Pilih Satu</option>
                        <?php
                            while($data = mysqli_fetch_array($kategoriQuery)){
                                ?>
                                    <option value="<?php echo $data['id'] ?>">
                                        <?php echo $data['nama'] ?>
                                    </option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="ukuran" class="form-label">Ukuran</label>
                    <select name="ukuran" id="ukuran" class="form-control" required>
                        <option value="" hidden>Pilih Ukuran</option>
                        <?php
                            $queryUkuran = mysqli_query($conn, "SHOW COLUMNS FROM produk LIKE 'ukuran'");
                            $result = mysqli_fetch_array($queryUkuran);
                            
                            // Mengambil bagian enum dari hasil kolom
                            $enumList = str_replace(["enum(", ")", "'"], "", $result['Type']);
                            $enumValues = explode(",", $enumList);  // Pecah string menjadi array berdasarkan koma
                            
                            // Loop untuk menampilkan opsi
                            foreach ($enumValues as $value) {
                                echo "<option value='$value'>$value</option>";
                            }
                        ?>
                </select>
                </div>
                <div class="mb-3">
                    <label for="ketersediaan_stok" class="form-label">Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control" required>
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-warning" name="btnTambahProduk">
                        Simpan
                    </button>
                </div>
            </form>
            <?php 
                if(isset($_POST['btnTambahProduk'])){
                    $nama = htmlspecialchars($_POST['nama']);
                    $kategori = htmlspecialchars($_POST['kategori']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $ukuran = htmlspecialchars($_POST['ukuran']);
                    $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                    $target_dir = "../image/";
                    $nama_file = basename($_FILES["foto"]["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $imageSize = $_FILES["foto"]["size"];
                    $randomName = generateRandom(10);
                    $newName = $randomName . "." . $imageFileType;

                    if($nama == '' || $kategori == '' || $harga == '' || $ukuran == '' || $ketersediaan_stok == ''){

                        ?>
                            <div class="alert alert-danger mt-3" role="alert">
                                Data mohon diisi dengan lengkap!
                            </div>
                        <?php
                    }else {
                        if($nama_file != ''){
                            if($imageSize > 10000000){
                                ?>
                                    <div class="alert alert-danger" role="alert">
                                        File Tidak boleh lebih dari 500kb
                                    </div>
                                <?php
                            }else {
                                if($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'gif'){
                                    ?>
                                        <div class="alert alert-danger" role="alert">
                                            File harus bertipe .png / .jpg / .jpeg / .gif!
                                        </div>
                                    <?php
                                }else{
                                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $newName);
                                }
                            }
                        }
                        // query insert
                        $queryTambahProduk = mysqli_query($conn, "INSERT INTO produk (kategori_id, nama, harga, foto, ukuran, ketersediaan_stok) VALUES ('$kategori' , '$nama', '$harga', '$newName', '$ukuran', '$ketersediaan_stok')");

                        if($queryTambahProduk){
                        ?>
                            <div class="alert alert-success" role="alert">
                                Data berhasil tersimpan!
                            </div>

                            <meta http-equiv="refresh" content="1.8; url=produk.php" />
                        <?php
                        }else{
                            echo mysqli_error($conn);
                        }
                    }
                }
            
            ?>
        </div>

        <div class="mt-5">
            <h2>List Produk</h2>
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-secondary table-hover">
                    <thead>
                        <tr class="table-dark">
                            <th>No.</th>
                            <th>Nama</th>   
                            <th>Kategori</th>   
                            <th>Harga</th>
                            <th>ukuran</th>
                            <th>Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if($productCount == 0){
                                ?>
                                    <tr>
                                        <td class="text-center" colspan="7">
                                            Data Tidak Tersedia
                                        </td>
                                    </tr>
                                <?php
                            }else{
                                $nomor = 1;
                                while($data = mysqli_fetch_array($query)){
                                    ?>
                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $data['nama'] ?></td>
                                            <td><?php echo $data['nama_kategori'] ?></td>
                                            <td><?php echo $data['harga'] ?></td>
                                            <td><?php echo $data['ukuran'] ?></td>
                                            <td><?php echo $data['ketersediaan_stok'] ?></td>
                                            <td class="col-2 text-center">
                                                <a href="detail-produk.php?qi=<?php echo $data['id']; ?>" class="btn btn-info">EDIT & DELETE</a>
                                            </td>
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


    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>