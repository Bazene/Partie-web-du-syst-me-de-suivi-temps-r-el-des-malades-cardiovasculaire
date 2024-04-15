<?php
    include_once "../Configuration/config.php";
    include_once "../Models/notifications.php";

    if(!empty($_POST)) {
        $id_notification = $_POST['id_notification'];

        $isDeleted = Notifications :: deleteNotification($id_notification);

        if($isDeleted) {
            header("Location:../Views/notifications.php") ;
        } else {
            header("Location:../Views/notifications.php") ;
        }
    }