<?php
    include_once "../../Configuration/config.php";
    include_once "../../Models/notifications.php";
    include_once "../../Models/limitesvitalsignspatient.php";
    include_once "../../Models/NotificationSender.php";

    $id_patient = 42;
    $limitesValues = Limitesvitalsignspatient::getLimitesForPatient($id_patient);

    $min_systol_diastol = explode('/', $limitesValues->getMin_pression());
    $max_systol_diastol = explode('/',$limitesValues->getMax_pression());

    // for mail
    $notificationMail = new NotificationSender(); 

    $temperature = 29;
    $vital_date = "2024-04-23";
    $vital_hour = "01:59:2";

    if ($temperature > $limitesValues->getMax_temp() || $temperature < $limitesValues->getMin_temp()) {
        $message = "Temperature : ".$temperature." *C";
        $new_notification = new Notifications($id_patient, $message, $vital_date, $vital_hour, 0);
        if($new_notification->createNotification()) {
            if($notificationMail->sendNotification("Température", $temperature, $vital_hour, $vital_date, "bazenesergeamos0@gmail.com")) {
                
            }
        }
    }

    // if($heart_rate > $limitesValues->getMax_heartRate() || $heart_rate < $limitesValues->getMin_heartRate())  {
    //     $message = "Frequence cardiaque : ".$heart_rate." BPM";
    //     $new_notification = new Notifications($id_patient, $message, $vital_date, $vital_hour, 0);
    //     if($new_notification->createNotification()) {

    //     }
        
    // }

    // if($oxygen_level < $limitesValues->getMin_spo2() || $oxygen_level > $limitesValues->getMax_spo2())  {
    //     $message = "Niveau d'oxygene : ".$oxygen_level." %";
    //     $new_notification = new Notifications($id_patient, $message, $vital_date, $vital_hour, 0);
    //     if($new_notification->createNotification()) {

    //     }      
    // }

    // if($blood_glucose !== 0) {
    //     if($blood_glucose >= $limitesValues->getMax_glucose() || $blood_glucose <= $limitesValues->getMin_glucose()) {
    //         $message = "Glycémie : ".$blood_glucose." mg/dL";
    //         $new_notification = new Notifications($id_patient, $message, $vital_date, $vital_hour, 0);
    //         if($new_notification->createNotification()) {

    //         }
    //     }
    // }

    // if(($systolic_blood !== 0) && ($diastolic_blood !== 0)) {
    //     if(($systolic_blood >= intval($max_systol_diastol[0]) && $diastolic_blood >= intval($max_systol_diastol[1])) || ($systolic_blood <= intval($min_systol_diastol[0]) && $diastolic_blood <= intval($min_systol_diastol[1]))) {
    //         $message = "Tension artérielle : ".$systolic_blood." / ".$diastolic_blood." mmHg";
    //         $new_notification = new Notifications($id_patient, $message, $vital_date, $vital_hour, 0);
    //         if($new_notification->createNotification()) {

    //         }
    //     }
    // }               
