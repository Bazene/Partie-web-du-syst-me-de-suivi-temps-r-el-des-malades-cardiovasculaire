<?php

include_once "../../Configuration/config.php";
include_once "../../Models/patient.php";

header("Content-Type: application/json");    

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données JSON envoyées dans la requête POST
    $data = json_decode(file_get_contents('php://input'), true);

    // Traiter les données (insérer dans la base de données, etc.)
    try {
        $token = $data['patient_role'];
        $patient_name = $data['patient_name'];
        $patient_phone_number = $data['patient_phone_number'];
        $patient_age = $data['patient_age'];
        $patient_weight = $data['patient_weight'];
        $patient_size = $data['patient_size'];
        $patient_commune = $data['patient_commune'];
        $patient_quater = $data['patient_quater'];
        $patient_gender = $data['patient_gender'];
        
        
        if(Patient :: updatePatientProfile($token, $patient_name, $patient_phone_number, $patient_age, $patient_weight, $patient_size, $patient_commune, $patient_quater, $patient_gender)) {
            // data to retrun to the client
            $responseData = array(
                'success' => true,
                'patient_role' => $token,
                'patient_name' => $patient_name,
                'patient_gender' => $patient_gender,
                'patient_phone_number' => $patient_phone_number,
                'patient_age' => $patient_age,
                'patient_commune' => $patient_commune,
                'patient_quater' => $patient_quater,
                'patient_size' => $patient_size,
                'patient_weight' => $patient_weight
            );

            echo json_encode($responseData);
        }
        else {
            echo json_encode(["success" => false, "error" => "Echec du mise à jour"]);
        }
        
    } 
    catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }

} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}