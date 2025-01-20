<?php 
    session_start();
    require_once 'koneksi.php' ;
    if($_SESSION['loginuser'] == true){
        header(header: 'Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - YudiKarya</title>
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
            width: 300px;
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
                <h2 class="text-center">Login</h2>
                <form method="post" action="">
                    <div class="form-group m-2">
                        <label for="email" class="">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email"
                            required>
                    </div>
                    <div class="form-group m-2">
                        <label for="password" class="">Password</label>
                        <input type="password" class="form-control mb-2" id="password" name="password" placeholder="Password" required>
                    </div>

                    <div class="form-group m-2">
                        <button style="width: 100%;" type="submit" class="btn btn-primary btn-block" name="loginbtn">Login</button>
                    </div>
                </form>
                <p class="text-center m-2">Belum punya akun? <a href="register.php" class="text-brown">Daftar di sini</a></p>
            </div>

        </div>
        <?php
                if(isset($_POST['loginbtn'])){
                    $email = htmlspecialchars($_POST['email']);
                    $password = htmlspecialchars($_POST['password']);

                    $query = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
                    $countdata = mysqli_num_rows($query);
                    $data = mysqli_fetch_array($query);
                    
                    if($countdata > 0){
                        if(password_verify($password, $data['password'])){
                            $_SESSION['email'] = $data['email'];
                            $_SESSION['loginuser'] = true;
                            header('Location: index.php');
                        }else{
                            
            ?>
            <div class="alert alert-danger mt-2" role="alert">
                Email dan password yang anda masukan salah
            </div>
        <?php
                        }
                }else {
        ?>

        <div class="alert alert-danger mt-2" role="alert">
            Email dan password yang anda masukan salah
        </div>

        <?php
                    }
                }
            
        ?>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>

</html>