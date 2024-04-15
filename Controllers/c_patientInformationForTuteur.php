<?php
    session_start();
    include_once "../Configuration/config.php";
    include_once "../Models/patient.php";

    $jsonArray = array();
    if(!empty($_SESSION['id_patient_for_tuteur'])) {
        $id_patient = $_SESSION['id_patient_for_tuteur'];

        $patient = Patient :: getPatientById($id_patient);
        $patientJsonArray = $patient->objectToJson();

        $idDoctorWhoFollowPatient = $patientJsonArray["id_doctor"];
        $doctorJsonArray = Patient :: getDoctorWhoFollowPatient($idDoctorWhoFollowPatient, $id_patient);

        if($doctorJsonArray !== null) { 
            $resultJsonArray = array (
                "patientJ" => $patientJsonArray,
                "doctorJ" => $doctorJsonArray
            );

        } else {
            $resultJsonArray = array (
                "patientJ" => $patientJsonArray,
                "doctorJ" => "no doctor found"
            );
        }
       
    }   

    echo json_encode($resultJsonArray);