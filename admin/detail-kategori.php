<?php
        require_once 'session.php';
        require_once '../koneksi.php';
        $id = $_GET['qi'];

        $queryDetail = mysqli_query($conn, "SELECT * FROM kategori WHERE id ='$id'");
        $dataQuery = mysqli_fetch_array($queryDetail);
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
    <div class="container">
        <h2 class="mt-5">Detail Kategori</h2>

        <div class="col-12 col-md-6 mt-3">
                <form action="" method="post">
                    <div>
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo $dataQuery['nama'] ?>">
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-warning" name="submit">Edit</button>
                        <button type="submit" class="btn btn-danger" name="delbtn">Delete</button>
                    </div>
                </form>
            
            <?php 
             if(isset($_POST['submit'])){
                $kategori = htmlspecialchars($_POST['kategori']);
                if($dataQuery['nama'] == $kategori){
                    ?>
                        <meta http-equiv="refresh" content="0; url = kategori.php">
                    <?php
                }else{
                    $query = mysqli_query($conn, "SELECT * FROM kategori WHERE nama = '$kategori'");
                    $dataCountDB = mysqli_num_rows($query);
                    if($dataCountDB > 0){
                        ?>
                            <div class="alert alert-danger mt-2" role="alert">
                                Data Kategori Sudah Ada!
                            </div>

                        <?php
                    }else{
                        $querySave = mysqli_query($conn, "UPDATE kategori SET nama = '$kategori' WHERE id = '$id'");
                        if($querySave){
                            ?>
                                <div class="alert alert-success mt-2" role="alert">
                                    Data Berhasil di update !
                                </div>

                                <meta http-equiv="refresh" content="1.8; url = kategori.php">
                            <?php
                        }else {
                            echo mysqli_error($conn);
                        }
                    }
                }
             }
            
                if(isset($_POST['delbtn'])){
                    $DBcheckedKategori = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id = '$id'");
                    $dataSama = mysqli_num_rows($DBcheckedKategori);
                    if($dataSama > 0){
                        ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                Kategori tidak dapat dihapus dikarenakan sudah digunakan pada laman produk!
                            </div>
                            <meta http-equiv="refresh" content="1.8; url=kategori.php">
                        <?php
                        die();
                    }

                    $deleteData = mysqli_query($conn, "DELETE FROM kategori WHERE id = '$id'");
                    if($deleteData){
                        ?>
                            <div class="alert alert-danger mt-2" role="alert">
                                    Data Berhasil dihapus !
                            </div>

                            <meta http-equiv="refresh" content="1.8; url = kategori.php">
                        <?php
                    }else{
                        echo mysqli_error($conn);
                    }
                }
            ?>
           
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>