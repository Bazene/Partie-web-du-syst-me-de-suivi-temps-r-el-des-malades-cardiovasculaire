<?php
    session_start();

    if(!empty($_POST)) {
        $id_patient = $_POST['id_patient'];
        $_SESSION['id_patient_for_vitalSign'] = $id_patient;
        
        header("Location:../Views/suivi.php");
    }