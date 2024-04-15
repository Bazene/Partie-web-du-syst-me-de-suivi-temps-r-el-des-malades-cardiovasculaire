<?php
    include_once "../Configuration/config.php";
    include_once "../Models/notifications.php";

    function getAllNotifications() {
        $notifications = Notifications :: getAllNotifications();
        return $notifications;
    }