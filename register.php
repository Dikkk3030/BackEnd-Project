<?php 
    session_start();
    require_once 'koneksi.php' 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<style>
    .main {
        height: 100vh;
    }    

    .login-box{
        width: 500px;
        height: 300px;
        box-sizing: border-box;
        border-radius: 10px;
    }
</style>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-5 shadow">
            <form action="" method="post">
                <h1>Register</h1>
                <div>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div>
                    <button type="submit" class="btn btn-success form-control mt-3" name="loginbtn">Submit</button>
                </div>
            </form>
        </div>

        <div class="mt-3" style="width: 500px;">
            <?php
                // Proses registrasi
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $password = mysqli_real_escape_string($conn, $_POST['password']);

                // Hash password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Query untuk menyimpan data pengguna
                $query = "INSERT INTO user (email, password) VALUES ('$email', '$hashed_password')";

                    if (mysqli_query($conn, $query)) {
                        header('Location: login.php');

                    } else {
                        echo "Error: " . $query . "<br>" . mysqli_error($conn);
                    }
                }

    // Tutup koneksi
    mysqli_close($conn);
            ?>
        </div>
    </div>
</body>
</html>