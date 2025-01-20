<?php
    session_start();
?>
<nav class="navbar navbar-expand-lg navbar-light">
     <div class="container-fluid">
     <a class="navbar-brand" href="index.php">
        <img src="assets/YUDIKARYA1.png" alt="YudiKarya Logo" style="height: 100px;">
     </a>

     <a class="navbar-brand" href="index.php">
        <img src="assets/YUDIKARYAtext1.png" alt="YudiKarya Logo" style="height: 100px;">
     </a>

      <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav ms-auto fs-5">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="product.php">Produk</a>
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
                <script src="bootstrap/js/bootstrap.bundle.js"></script>
                <script src="fontawesome/js/all.min.js"></script>
</body>
  </div>
  </div>
</nav>