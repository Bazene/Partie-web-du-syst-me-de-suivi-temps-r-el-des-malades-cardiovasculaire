<?php

    include_once "../Configuration/config.php";
    include_once "../Models/notifications.php";

    function getNotificationsForTuteur($Id_PATIENT) {
        $notifications = Notifications :: getNotificationsForTuteur($Id_PATIENT);
        
        return $notifications;
    }