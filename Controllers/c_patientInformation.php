<?php
    session_start();
    include_once "../Configuration/config.php";
    include_once "../Models/patient.php";
    include_once  "../Models/tuteur.php";

    $jsonArray = array();
    if(!empty($_SESSION['id_patient_for_vitalSign'])) {
        $id_patient = $_SESSION['id_patient_for_vitalSign'];

        $patient = Patient :: getPatientById($id_patient);
        $tuteurJsonArray = Tuteur :: getTuteurByPatient($id_patient);

        $patientJsonArray = $patient->objectToJson();

        // Décoder les tableaux JSON en tableaux PHP
        if(!$tuteurJsonArray == []) {
            $resultJsonArray = array (
                "patientJ" => $patientJsonArray,
                "tuteurJ" => $tuteurJsonArray
            );
        } else {
            $resultJsonArray = array (
                "patientJ" => $patientJsonArray,
                "tuteurJ" => "no tuteur added"
            );
        }
    }   

    echo json_encode($resultJsonArray);