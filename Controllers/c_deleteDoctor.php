<?php 

    include_once "../Configuration/config.php";
    include_once "../Models/doctor.php";

    if(isset($_POST)) {
        $id_doctor = $_POST['id_doctor'];

        if(Doctor :: deleteDoctor($id_doctor)) {
            header("Location:../Views/doctor.php");
        } else {
            header("Location:../Views/doctor.php");
        }
    } else {
        header("Location:../Views/tuteur.php");
    }