<?php
session_start();
require_once 'koneksi.php';
require_once 'navbar.php'; 

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Akun</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        .col-1{
            text-align: center;
            width: 2px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Informasi Akun</h2>
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th class="">Nama</th>
                        <td class="col-1">:</td>
                        <td><?php echo htmlspecialchars($akun['name']); ?></td>
                    </tr>
                    <tr class="">
                        <th>Email</th>
                        <th class="col-1">:</th>
                        <td><?php echo htmlspecialchars($akun['email']); ?></td>
                    </tr>
                    <tr class="">
                        <th>Telepon</th>
                        <td class="col-1">:</td>
                        <td><?php echo htmlspecialchars($akun['notlp']); ?></td>
                    </tr>
                    <tr class="">
                        <th>Alamat</th>
                        <td class="col-1">:</td>
                        <td><?php echo htmlspecialchars($akun['alamat']); ?></td>
                    </tr>
                    
                </table>
                <div class="text-end">
                   <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="/fontawesome/js/all.min.js"></script>
</body>
</html>