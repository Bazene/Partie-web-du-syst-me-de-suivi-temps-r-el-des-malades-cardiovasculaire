<?php
    session_start();

    include_once "../Configuration/config.php";
    include_once "../Models/VitalSigns.php";

    $jsonArray2 = array();
    $jsonArrayResult = array();
    
    if(!empty($_SESSION['id_patient_for_vitalSign'])) {
        $id_patient = $_SESSION['id_patient_for_vitalSign'];
        $allVitalSings = VitalSigns :: getAllVitalSignsForPatient($id_patient);
        
        if(!empty($allVitalSings)) {
            foreach ($allVitalSings as $vitalSign) {
                $jsonArray2[] = $vitalSign->objectToJson();
            }
        }    
    }   

    // conditions that will be applied to choose the array wich will we 
    if(isset($_SESSION['jsonArray1']) && !empty($_SESSION['jsonArray1'])) {
        $jsonArrayResult = $_SESSION['jsonArray1'] ;
    } else {
        $jsonArrayResult = $jsonArray2;
    }

    echo json_encode($jsonArrayResult);
?>