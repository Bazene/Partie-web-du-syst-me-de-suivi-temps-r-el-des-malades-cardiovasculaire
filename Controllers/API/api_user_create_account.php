<?php

    include_once "../../Configuration/config.php";
    include_once "../../Models/patient.php";

    header("Content-Type: application/json");    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     // Récupérer les données JSON envoyées dans la requête POST
        $data = json_decode(file_get_contents('php://input'), true);
        
        // Traiter les données (insérer dans la base de données, etc.)
        try {
            $patient_name = $data['patient_name'];
            $patient_postname = $data['patient_postname'];
            $patient_surname = $data['patient_surname'];
            $patient_gender = $data['patient_gender'];
            $patient_phone_number = $data['patient_phone_number'];
            $patient_mail = $data['patient_mail'];
            $patient_password = $data['patient_password'];
            $patient_date_created = $data['patient_date_created'];
            $patient_age = $data['patient_age'];
            $patient_role = $data['patient_role'];

            // hacher le mot de passe 
            $hashedPassword = password_hash($patient_password, PASSWORD_BCRYPT);

            // creat a new patient
            $new_patient = new Patient($patient_name, $patient_postname, $patient_surname, $patient_gender, $patient_mail, $patient_phone_number, $hashedPassword, $patient_date_created, $patient_age, $patient_role);
            $new_patient->setIdDoctor(0); $new_patient->setIdDoctorArchived(0); $new_patient->setPatientSize(10,2); $new_patient->setPatientWeight(10,2);

            // check if patient allready exist in database using his mail address
            $patients = Patient :: getAllPatients();

            $patientAllReadyExist = false;
            foreach($patients as $patient) {
                if($patient->getPatientMail() == $patient_mail) {
                    $patientAllReadyExist = true;
                    break;
                }
            }

            if(!$patientAllReadyExist) {
                if($new_patient->createPatient()) {
                    // Création de l'objet JSON à retourner
                    $responseData = array(
                        'patient_name' => $patient_name,
                        'patient_postname'=> $patient_postname, 
                        'patient_surname' => $patient_surname,
                        'patient_gender' => $patient_gender,
                        'patient_mail' => $patient_mail,
                        'patient_phone_number' => $patient_phone_number,
                        'patient_password' => $hashedPassword, 
                        'patient_date_created' => $patient_date_created, 
                        'patient_age' => $patient_age, 
                        'patient_role' => $patient_role,
                        'success' => true
                    );

                    echo json_encode($responseData);
                } 
                
                else {
                    echo json_encode(["success" => false, "error" => "Faild to create an account"]);
                }
            } else {
                echo json_encode(["success" => false, "error" => "Patient Allready exist using the same mail address"]);
            }
            
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "error" => $e->getMessage()]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Invalid request method"]);
    }
