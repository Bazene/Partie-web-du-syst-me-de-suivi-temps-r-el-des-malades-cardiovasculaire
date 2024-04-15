<?php
    session_start();

    include_once "../Configuration/config.php";
    include_once "../Models/VitalSigns.php";

    $jsonArray = array();
    if(!empty($_SESSION['id_patient_for_vitalSign'])) {
        $id_patient = $_SESSION['id_patient_for_vitalSign'];
        $allVitalSings = VitalSigns :: getAllVitalSignsForPatient($id_patient);
                
        if(!empty($allVitalSings)) {
            foreach ($allVitalSings as $vitalSign) {
                $jsonArray[] = $vitalSign->objectToJson();
            }
        }     
    } 

    echo json_encode($jsonArray);