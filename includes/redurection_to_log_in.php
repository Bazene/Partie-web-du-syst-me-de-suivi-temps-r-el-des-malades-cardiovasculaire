<?php
    session_start();
    if(!$_SESSION['connected']) {
        header("Location:./v_authentification.php");
    }
?>