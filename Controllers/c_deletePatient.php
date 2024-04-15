<?php
    include_once "../Configuration/config.php";
    include_once "../Models/patient.php";

    if(isset($_POST)) {
        $id_patient = $_POST['id_patient'];

        if(Patient :: deletePatientById($id_patient)) {
            header("Location:../Views/patients.php");
        } else {
            header("Location:../Views/tuteur.php");
        }
    } else {
        header("Location:../Views/tuteur.php");
    }