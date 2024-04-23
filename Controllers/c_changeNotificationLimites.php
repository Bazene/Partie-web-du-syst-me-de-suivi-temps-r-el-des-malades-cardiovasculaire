<?php
    include_once "../Configuration/config.php";
    include_once "../Models/limitesvitalsignspatient.php";

    if(isset($_POST) && !empty($_POST)) {
        $id_patient = $_POST['id_patient'];
        $min_temp = $_POST['min_temp'];
        $max_temp = $_POST['max_temp'];
        $min_spo2 = $_POST['min_spo2'];
        $max_spo2 = $_POST['max_spo2'];
        $min_heartRate = $_POST['min_heartRate'];
        $max_heartRate = $_POST['max_heartRate'];
        $min_systol = $_POST['min_systol'];
        $max_systol = $_POST['max_systol'];
        $min_diastol = $_POST['min_diastol'];
        $max_diastol = $_POST['max_diastol'];
        $min_glucose = $_POST['min_glucose'];
        $max_glucose = $_POST['max_glucose'];

        $min_pression = "".$min_systol."/".$min_diastol;
        $max_pression = "".$max_systol."/".$max_diastol;
        
        if(Limitesvitalsignspatient::updateLimitesVitalSign($id_patient, $min_temp, $max_temp, $min_spo2, $max_spo2, $min_heartRate, $max_heartRate, $min_pression, $max_pression, $min_glucose, $max_glucose)) {
            header("Location:../Views/suivi.php");
        } else {
            header("Location:../Views/suivi.php");
        }
    }