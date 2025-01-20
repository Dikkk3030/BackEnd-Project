<?php
        require_once 'session.php';
        require_once '../koneksi.php';
        $id = $_GET['qi'];

        $queryDetailProduk = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id = b.id WHERE a.id ='$id'");
        $dataProduk = mysqli_fetch_array($queryDetailProduk);
        $kategoriQuery = mysqli_query($conn, "SELECT * FROM kategori WHERE id !='$dataProduk[kategori_id]'");

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
<body>
    <?php require_once 'navbar.php' ?>
    <div class=" container mt-5">
        <h2>Detail Produk</h2>
        <div class="col-12 col-md-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $dataProduk['nama'] ?>" autocomplete="off" required>
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="<?php echo $dataProduk['kategori_id'] ?>" ><?php echo $dataProduk['nama_kategori'] ?></option>
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
                    <input type="number" name="harga" id="harga" class="form-control" value="<?php echo $dataProduk['harga'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="CurrentFoto" class="form-label">Foto Produk</label><br>
                    <img src="../image/<?php echo $dataProduk['foto'] ?>" alt="" width="300px">
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="ukuran" class="form-label">Ukuran</label>
                    <select name="ukuran" id="ukuran" class="form-control" required>
                    <option value="<?php echo $dataProduk['ukuran']?>" hidden>
                    <?php echo $dataProduk['ukuran']?>
                    </option>
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
                
                <div class="mb-3">
                    <label for="ketersediaan_stok" class="form-label">Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control" required>
                        <option value="<?php echo $dataProduk['ketersediaan_stok'] ?>">
                            <?php echo $dataProduk['ketersediaan_stok'] ?>
                        </option>
                        <?php
                            if($dataProduk['ketersediaan_stok']== 'tersedia'){
                                ?>
                                    <option value="habis">Habis</option>
                                <?php
                            }else{
                                ?>
                                    <option value="tersedia">Tersedia</option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3 d-flex">
                    <button type="submit" class="btn btn-warning me-3" name="btnEditProduk">
                        Edit
                    </button>
                    <button type="submit" class="btn btn-danger" name="btnDelete">
                        Delete
                    </button>
                </div>
            </form>

            <?php
                if(isset($_POST['btnEditProduk'])){
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
                    }else{
                    $queryUpdate = mysqli_query($conn, "UPDATE produk SET kategori_id = '$kategori', nama = '$nama', harga = '$harga', ukuran = '$ukuran', ketersediaan_stok = '$ketersediaan_stok' WHERE id = '$id'");

                        if($nama_file != ''){
                            if($imageSize > 10000000){
                        ?>
                            <div class="alert alert-danger" role="alert">
                                File Tidak boleh lebih dari 500kb
                            </div>
                        <?php
                            }else{
                                if($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'gif'){
                                ?>
                                    <div class="alert alert-danger" role="alert">
                                        File harus bertipe .png / .jpg / .jpeg / .gif!
                                    </div>
                                <?php
                                }else{
                                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $newName);

                                    $queryUpdate = mysqli_query($conn, "UPDATE produk SET foto = '$newName' WHERE id = '$id'");

                                    if ($queryUpdate){
                                ?>
                                        <div class="alert alert-success" role="alert">
                                            Data berhasil Di Update!
                                        </div>

                                        <meta http-equiv="refresh" content="1.8; url=produk.php" />

                                <?php
                                    }else{
                                        mysqli_error($conn);
                                    }
                                }
                            }
                        }
                    }
            }
                if(isset($_POST['btnDelete'])){
                    $queryHapus = mysqli_query($conn, "DELETE FROM produk WHERE id = '$id'");
                    if($queryHapus){
        ?>
                    <div class="alert alert-danger mt-2" role="alert">
                        Produk Berhasil dihapus !
                    </div>

                    <meta http-equiv="refresh" content="1.8; url = produk.php">
        <?php
                    }else{
                        mysqli_error($conn);
                    }
                }

            ?>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>