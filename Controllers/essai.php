<?php 
  include_once "../Configuration/config.php";
  include_once "../Models/notifications.php";

  
    $ID_DOCTOR = 4;
    $notifications = Notifications :: getAllNotifications();

    // foreach($vitalSignsPatient : $vitalS) {
    // var_dump($notifications);
    // die;
    // }

    foreach($notifications as $notification) {
        if($notification->isANotificationForDocto($ID_DOCTOR)) {
           echo "yes";
        }
    }