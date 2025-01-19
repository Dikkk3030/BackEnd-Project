<?php
    session_start();
?>
<nav class="navbar navbar-expand-lg navbar-light">
     <div class="container-fluid">
         <a class="navbar-brand" href="#">Membatik</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

      <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav ms-auto ">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home </a>

                <li class="nav-item">
                    <a class="nav-link" href="#">Kategori</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Produk</a>
                </li>
                
                <li class="nav-item">
                <?php
                    if (isset($_SESSION['loginuser']) && $_SESSION['loginuser'] == true) {
                        echo '<a class="nav-link" href="accountinfo.php">Info Akun</a>';
                    } else {
                        echo '<a class="nav-link" href="login.php">Login</a>';
                    }
                ?>
                </li> 
            
  </div>
  </div>
</nav>