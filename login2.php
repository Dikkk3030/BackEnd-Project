<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floating Login Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa; /* Latar belakang tetap putih */
        }
        .login-container {
            display: flex;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .login-image {
            width: 300px; /* Atur lebar gambar sesuai kebutuhan */
            background: url('assets/batik-theme.jpg') no-repeat center center; /* Ganti dengan URL gambar Anda */
            background-size: cover;
        }
        .login-form {
            padding: 20px;
            width: 300px; /* Atur lebar form sesuai kebutuhan */
        }
        .btn-primary {
            background-color: #8B4513; /* Warna cokelat untuk tombol */
            border-color: #8B4513; /* Border cokelat untuk tombol */
        }
        .btn-primary:hover {
            background-color: #A0522D; /* Warna cokelat lebih terang saat hover */
            border-color: #A0522D; /* Border cokelat lebih terang saat hover */
        }
        .text-brown {
            color: #FFBB70; /* Warna teks cokelat */
        }
        .text-brown :hover {
            color: #FFBB70;
            text-decoration: none;
        }



    </style>
</head>
<body>

<div class="login-container">
    <div class="login-image"></div>
    <div class="login-form">
        <h2 class="text-center">Login</h2>
        <form>
            <div class="form-group">
                <label for="email" class="">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="password" class="">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <p class="text-center mt-2">Belum punya akun? <a href="#" class="text-brown">Daftar di sini</a></p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>