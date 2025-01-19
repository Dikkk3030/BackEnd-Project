<?php 
    session_start();
    require_once 'koneksi.php' 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floating Login Form</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .login-box {
            display: flex;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .login-container {
            display: flex;
            flex-direction: column;
        }

        .login-image {
            width: 40px;
            /* Atur lebar gambar sesuai kebutuhan */
            background: url('assets/batik-theme.jpg') no-repeat center center;
            /* Ganti dengan URL gambar Anda */
            background-size: cover;
        }

        .login-form {
            padding: 20px;
            width: 300px;
            /* Atur lebar form sesuai kebutuhan */
        }

        .btn-primary {
            background-color: #8B4513;
            /* Warna cokelat untuk tombol */
            border-color: #8B4513;
            /* Border cokelat untuk tombol */
        }

        .btn-primary:hover {
            background-color: #A0522D;
            /* Warna cokelat lebih terang saat hover */
            border-color: #A0522D;
            /* Border cokelat lebih terang saat hover */
        }

        .text-brown {
            color: #FFBB70;
            /* Warna teks cokelat */
        }

        .text-brown :hover {
            color: #FFBB70;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-box shadow">
            <div class="login-image"></div>
            <div class="login-form">
                <h2 class="text-center">Register</h2>
                <form method="post" action="">
                    <div class="form-group m-2">
                        <label for="email" class="">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email"
                            required>
                    </div>

                    <div class="form-group m-2">
                        <label for="password" class="">Password</label>
                        <input type="password" class="form-control mb-2" id="password" name="password"
                            placeholder="Password" required>
                    </div>

                    <div class="form-group m-2">
                        <label for="name" class="">Nama</label>
                        <input type="text" class="form-control mb-2" id="name" name="name" placeholder="Nama" required>
                    </div>

                    <div class="form-group m-2">
                        <label for="notlp" class="">No Telp</label>
                        <input type="number" class="form-control mb-2" id="notlp" name="notlp" placeholder="No Telp"
                            required>
                    </div>

                    <div class="form-group m-2">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                    </div>

                    <div class="form-group m-2">
                        <button type="submit" class="btn btn-primary btn-block" name="registerbtn">Daftar</button>
                    </div>

                </form>
                <p class="text-center m-2">Sudah punya akun? <a href="login.php" class="text-brown">Login di sini</a>
                </p>
            </div>

        </div>

        <?php
                // Proses registrasi
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $password = mysqli_real_escape_string($conn, $_POST['password']);
                    $name = mysqli_real_escape_string($conn, $_POST['name']);
                    $notlp = mysqli_real_escape_string($conn, $_POST['notlp']);
                    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

                // Hash password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Query untuk menyimpan data pengguna
                $query = "INSERT INTO user (email, password, name, notlp, alamat) VALUES ('$email', '$hashed_password', '$name', '$notlp', '$alamat')";

                    if (mysqli_query($conn, $query)) {
                        header('Location: login.php');

                    } else {
                        echo "Error: " . $query . "<br>" . mysqli_error($conn);
                    }
                }
                
                mysqli_close($conn);
            ?>
    </div>  
    <script src="/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="/fontawesome/js/all.min.js"></script>
</body>

</html>