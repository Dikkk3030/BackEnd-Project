<?php
    define("DB_HOST", "localhost");
    define("DB_USERNAME", "root");
    define("DB_PASSWORD", "UbiKukus");
    define("DB_NAME","toko_online");


    $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to mySQL :" .   mysqli_connect_error();
    }
?>