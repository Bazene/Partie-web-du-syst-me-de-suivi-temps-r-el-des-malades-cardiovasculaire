<?php
    include_once "../Configuration/config.php";
    include_once "../Models/tuteur.php";

    if(isset($_POST)) {
        $id_patient = $_POST['id_patient'];

        if(Tuteur :: deleteTuteur($id_patient)) {
            header("Location:../Views/tuteur.php");
        } else {
            header("Location:../Views/tuteur.php");
        }
    } else {
        header("Location:../Views/tuteur.php");
    }