<?php 
    session_start();
    require_once 'koneksi.php' 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                <h1>Login</h1>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
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
                            <div class="alert alert-danger" role="alert">
                                Email dan password yang anda masukan salah
                            </div>
                            <?php
                        }
                    }else {
                        ?>
                            <div class="alert alert-danger" role="alert">
                                Email dan password yang anda masukan salah
                            </div>
                        <?php
                    }
                }
            
            ?>
        </div>
    </div>
</body>
</html>