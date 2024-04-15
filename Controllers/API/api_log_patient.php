<?php

    include_once "../../Configuration/config.php";
    include_once "../../Models/patient.php";

    header("Content-Type: application/json");    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données JSON envoyées dans la requête POST
        $data = json_decode(file_get_contents('php://input'), true);

        // Traiter les données (insérer dans la base de données, etc.)
        try {
            $patientName = $data['patient_name'];
            $patientPassword = $data['patient_password'];
            $passwordHashed = null;

            // $patientName = "claude";
            // $patientPassword = "claude";
            
            $patients = Patient :: getAllPatients();

            $patientData = null;
            foreach($patients as $patient) {
                if (password_verify($patientPassword, $patient->getPatientPassword()) && strcasecmp($patientName, $patient->getPatientName()) == 0) { 
                    $patientData = $patient;
                    $passwordHashed = $patient->getPatientPassword();
                    break;
                }
            }


            if($patientData != null) {
                // update token
                $token = bin2hex(random_bytes(32));

                if(Patient :: update_token($patientData->getPatientPassword(), $token)) {
                    // recupération de l'id du patient
                    $patientId = Patient :: getIdOnAuthentification($patientName, $passwordHashed);

                    $imagePath = $patientData->getPatientPicture(); // Chemin de l'image du patient
                    
                    $patientImage = null;
                    if (file_exists($imagePath)) { // Vérifier si le fichier existe
                        $imageBytes = file_get_contents($imagePath); // Lire le contenu du fichier

                        if ($imageBytes !== false) { // Vérifier si la lecture a réussi
                            $patientImage =  base64_encode($imageBytes);  // Encodage en base64 pour faciliter le transfert
                        } 
                    } 

                    
                    // data to retrun to the client
                    $responseData = array(
                        'success' => true,
                        'patient_id' => $patientId,
                        'patient_name' => $patientData->getPatientName(),
                        'patient_postname'=> $patientData->getPatientPostName(), 
                        'patient_surname' => $patientData->getPatientSurName(),
                        'patient_gender' => $patientData->getPaientGender(),
                        'patient_mail' => $patientData->getPatientMail(),
                        'patient_phone_number' => $patientData->getPatientPhoneNumber(),
                        'patient_password' => $patientData->getPatientPassword(), 
                        'patient_date_created' => $patientData->getPatientDateCreated(), 
                        'patient_age' => $patientData->getPatientAge(),
                        'patient_role' => $token,
                        'id_doctor' => $patientData->getIdDoctor(),
                        'id_doctor_archived' => $patientData->getIdDoctorArchived(),
                        'patient_picture' => $patientImage,
                        'patient_commune' => $patientData->getPatientCommune(),
                        'patient_quater' => $patientData->getPatientQuater(),
                        'patient_size' => $patientData->getPatientSize(),
                        'patient_weight' => $patientData->getPatientWeight()
                    );

                    // var_dump($responseData);
                    // die;
                    echo json_encode($responseData);
                }

            } 
            else {
                echo json_encode(["success" => false, "error" => "Nom d'utilisateur ou mot de passe incorrect"]);
            }
            
        } 
        catch (PDOException $e) {
            echo json_encode(["success" => false, "error" => $e->getMessage()]);
        }

    } else {
        echo json_encode(["success" => false, "error" => "Invalid request method"]);
    }