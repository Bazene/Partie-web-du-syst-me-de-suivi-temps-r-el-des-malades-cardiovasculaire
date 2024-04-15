<?php
    session_start();

    include_once "../Configuration/config.php";
    include_once "../Models/notifications.php";

    $user_connected = $_SESSION['connected'] ;
    

    if($user_connected === "doctor") {
        $ID_DOCTOR = $_SESSION['idDoctor'];
        $notifications = Notifications :: getAllNotifications();

        $JsonArray  = array();
        $i = 0;
        foreach($notifications as $notification) {
            if($notification->isANotificationForDocto($ID_DOCTOR)) {
                if(($notification->getActive()) == 0) {
                    $i += 1;
                }
            }
        }

        $JsonArray = [
            'nbr_notifications' => $i
        ];

        echo json_encode($JsonArray);

    } elseif ($user_connected === "tuteur") {
        $ID_PATIENT = $_SESSION['id_patient_for_tuteur'];
        $notifications = Notifications :: getNotificationsForTuteur($ID_PATIENT);

        $JsonArray  = array();
        $i = 0;
        foreach($notifications as $notification) {
            if(($notification->getActive()) == 0) {
                $i += 1;
            }
        }

        $JsonArray = [
            'nbr_notifications' => $i
        ];

        echo json_encode($JsonArray);
    }