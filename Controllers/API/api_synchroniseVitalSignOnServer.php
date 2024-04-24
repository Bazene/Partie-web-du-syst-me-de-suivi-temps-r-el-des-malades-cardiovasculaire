<?php
    include_once "../../Configuration/config.php";
    include_once "../../Models/VitalSigns.php";

    include_once "../../Models/notifications.php";
    include_once "../../Models/limitesvitalsignspatient.php";
    include_once "../../Models/NotificationSender.php";

    header("Content-Type: application/json");    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        

        // Récupérer les données JSON envoyées dans la requête POST
        $listVitalSigns = json_decode(file_get_contents('php://input'), true);

        // Traiter les données (insérer dans la base de données, etc.)
        try {
            $identifiants = [];

            foreach ($listVitalSigns as $vitalSign) {
                $id_local = $vitalSign['id_local'];
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
    
                $new_VitalSign = new VitalSigns($id_local, $id_patient, $temperature, $heart_rate, $oxygen_level, $blood_glucose, $systolic_blood, $diastolic_blood, $vital_hour, $vital_date, $sync_vitalSign);
                
                $limitesValues = Limitesvitalsignspatient::getLimitesForPatient($id_patient);
                $min_systol_diastol = explode('/', $limitesValues->getMin_pression());
                $max_systol_diastol = explode('/',$limitesValues->getMax_pression());

                if($new_VitalSign->isInTable()) {
                    if($new_VitalSign->updateVitalSign()) {
                        array_push($identifiants, $id_local);                        
                        
                        // for mail
                        $notificationMail = new NotificationSender(); 
                    
                        if($temperature > $limitesValues->getMax_temp() || $temperature < $limitesValues->getMin_temp()) {
                            $message = "Temperature : ".$temperature." *C";
                            $new_notification = new Notifications($id_patient, $message, $vital_date, $vital_hour, 0);
                            if($new_notification->createNotification()) {
                                $notificationMail->sendNotification("Température", $temperature, $vital_hour, $vital_date, "bazenesergeamos0@gmail.com");
                            }
                        }
                    }
                } else {
                    if($new_VitalSign->createVitalSign()) {
                        array_push($identifiants, $id_local);
                    }
                }
            }

            if(!empty($identifiants)) {
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