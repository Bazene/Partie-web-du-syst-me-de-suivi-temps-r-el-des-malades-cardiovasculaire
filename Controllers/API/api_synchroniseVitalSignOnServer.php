<?php

    include_once "../../Configuration/config.php";
    include_once "../../Models/VitalSigns.php";

    header("Content-Type: application/json");    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données JSON envoyées dans la requête POST
        $listVitalSigns = json_decode(file_get_contents('php://input'), true);

        // Traiter les données (insérer dans la base de données, etc.)
        try {

            $identifiants = [];
            foreach ($listVitalSigns as $vitalSign) {
                $id = $vitalSign['id'];
                $id_patient = $vitalSign['id_patient'];
                $temperature = $vitalSign['temperature'];
                $heart_rate = $vitalSign['heart_rate'];
                $oxygen_level = $vitalSign['oxygen_level'];
                $blood_glucose = $vitalSign['blood_glucose'];
                $systolic_blood = $vitalSign['systolic_blood'];
                $diastolic_blood = $vitalSign['diastolic_blood'];
                $vital_hour = $vitalSign['vital_hour'];
                $vital_date = $vitalSign['vital_date'];
                $sync_vitalSign = "synchronise";
    
                $new_VitalSign = new VitalSigns($id, $id_patient, $temperature, $heart_rate, $oxygen_level, $blood_glucose, $systolic_blood, $diastolic_blood, $vital_hour, $vital_date, $sync_vitalSign);
                
                if($new_VitalSign->isInTable()) {
                    if($new_VitalSign->updateVitalSign()) {
                        array_push($identifiants, $id);
                    }
                } else {
                    if($new_VitalSign->createVitalSign()) {
                        array_push($identifiants, $id);
                    }
                }
            }

            if(!empty($identifiants)) {
                // check if we can create or not a notification
                if ($temperature > 40.0 || $temperature < 30.0) {
                    $message = "Temperature : ".$temperature." *C";
                    $new_notification = new Notifications($id_patient, $message, $vital_date, $vital_hour, 0);
                    if($new_notification->createNotification()) echo "notification creee";
                    else echo "Nooooooooooooooo";
                }

                if($heart_rate > 120 || $heart_rate < 40)  {
                    $message = "Frequence cardiaque : ".$heart_rate." BPM";
                    $new_notification = new Notifications($id_patient, $message, $vital_date, $vital_hour, 0);
                    if($new_notification->createNotification()) echo "notification creee";
                    else echo "Nooooooooooooooo";
                }

                if($oxygen_level < 80)  {
                    $message = "Niveau d'oxygene : ".$oxygen_level." %";
                    $new_notification = new Notifications($id_patient, $message, $vital_date, $vital_hour, 0);
                    if($new_notification->createNotification()) echo "notification creee";
                    else echo "Nooooooooooooooo";              
                }

                if($blood_glucose >= 400 || $blood_glucose <= 70) {
                    $message = "Glycémie : ".$blood_glucose." mg/dL";
                    $new_notification = new Notifications($id_patient, $message, $vital_date, $vital_hour, 0);
                    if($new_notification->createNotification()) echo "notification creee";
                    else echo "Nooooooooooooooo";         
                }

                if(($systolic_blood >= 160 && $diastolic_blood >= 120) || ($systolic_blood <= 80 && $diastolic_blood <= 50)) {
                    $message = "Tension artérielle : ".$systolic_blood." / ".$diastolic_blood." mmHg";
                    $new_notification = new Notifications($id_patient, $message, $vital_date, $vital_hour, 0);
                    if($new_notification->createNotification()) echo "notification creee";
                    else echo "Nooooooooooooooo";        
                }

                // data that will be returned to the client
                $responseData = array(
                    'success' => true, 
                    'sync_vitalSign' => $sync_vitalSign,
                    'identifiants' => $identifiants
                );            
            
                echo json_encode($responseData);

            } else {
                echo json_encode(["success" => false, "error" => "Echec d'enregistrement dans la base"]);
            }
        } 
        catch (PDOException $e) {
            echo json_encode(["success" => false, "error" => $e->getMessage()]);
        }

    } else {
        echo json_encode(["success" => false, "error" => "Invalid request method"]);
    }

