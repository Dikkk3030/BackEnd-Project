<?php
    if($_SESSION['loginuser']== false){
        header('Location: login.php');
    }

    else{
        header(header: 'Location: index.php');
    }

?>