<?php

    include_once "../Configuration/config.php";
    include_once "../Models/notifications.php";

    if(isset($_POST)) {
        $user_connected = $_POST['user_connected'];
        $input_id_user = $_POST['input_id_user'];

        if($user_connected == "tuteur") {
            $notifications = Notifications :: getNotificationsForTuteur($input_id_user);
         
            foreach($notifications as $notification) {
                $notification->updateActiveState(1, $notification->getId_patient());
            }
            
            header("Location:../Views/notifications.php"); 
        } 
        elseif($user_connected == "doctor") {
            $notifications = Notifications :: getAllNotifications();

            foreach($notifications as $notification) {
                if($notification->isANotificationForDocto($input_id_user)) {
                    $notification->updateActiveState(1, $notification->getId_patient());
                }
            }

            header("Location:../Views/notifications.php");
        }
    }