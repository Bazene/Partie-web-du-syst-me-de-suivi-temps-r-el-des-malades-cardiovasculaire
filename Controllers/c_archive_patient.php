<?php 

    include_once "../Configuration/config.php";
    include_once "../Models/patient.php";

    if(!empty($_POST)) {
        $id_patient = $_POST['id_patient'];
        $id_doctor_archiver = $_POST['id_doctor_archiver'];

       if(Patient :: archive_patient($id_patient, $id_doctor_archiver)) {
            header("Location:../Views/home.php");
       }
    }