<?php
    session_start();
    if(empty($_SESSION['connected'])) {
        header("Location:./authentification.php");
    }
?>