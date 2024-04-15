<?php
    include_once "../Configuration/config.php";
    include_once "../Models/patient.php";

    if(!empty($_POST)) {
        $id_doctor = $_POST['id_doctor'];
        $id_patient = $_POST['id_patient'];
        $id_doctor_archived = 0;
        

        if(Patient :: newPatientToFOllow($id_patient, $id_doctor, $id_doctor_archived)) {
            header("Location:../Views/home.php");
        } else {
            header("Location:../Views/patients.php");
        }
    }