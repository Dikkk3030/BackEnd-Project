<?php
    require_once 'session.php';
    require_once '../koneksi.php';

    $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);
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
    <?php require_once 'navbar.php'; ?>
    <div class="container mt-5">
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="index.php" class="no-decoration text-muted"><i class="fa-solid fa-house"></i> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                     Kategori
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Kategori</h3>
            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" placeholder="Tambah Kategori" class="form-control mt-2"> 
                </div>
                <div class="mt-2">
                    <button type="submit" name="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </form>
            <?php
                if(isset($_POST['submit'])){
                    $kategori = htmlspecialchars($_POST['kategori']);
                    $queryChecked = mysqli_query($conn, "SELECT nama FROM kategori WHERE nama = '$kategori'");
                    $queryData = mysqli_num_rows($queryChecked);
                    
                    if($queryData > 0){
                        ?>
                        <div class="alert alert-danger mt-2" role="alert">
                            Kategori sudah ada!
                        </div>
                        <?php
                    }else{
                        $queryInsert = mysqli_query($conn, "INSERT INTO kategori (nama) VALUES ('$kategori')");

                        if($queryInsert){
                            ?>
                                <div class="alert alert-success mt-2" role="alert">
                                    Data Kategori Berhasil Ditambahkan!
                                </div>

                                <meta http-equiv="refresh" content="1.5; url = kategori.php">
                            <?php
                        }else{
                            echo mysqli_error($conn);
                        }
                    }
                }
            
            ?>
        </div>

        <div class="mt-5">
            <h2>List Kategori</h2>
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-secondary table-hover">
                    <thead>
                        <tr class="table-dark">
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                            if($jumlahKategori == 0){
                        ?>
                            <tr>
                                <td colspan="3" class="text-center">Data Kategori tidak tersedia</td>
                            </tr>
                        <?php
                            }else{
                                $nomor = 1;
                                while($data = mysqli_fetch_array($queryKategori)){
                        ?>
                            <tr>
                                <td class="col-1">
                                    <?php echo $nomor; ?>
                                </td>
                                <td>
                                    <?php
                                        echo $data['nama']
                                    ?>
                                </td>
                                <td class="col-2 text-center">
                                    <a href="detail-kategori.php?qi=<?php echo $data['id']; ?>" class="btn btn-info">EDIT & DELETE</a>
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