<?php include_once "../includes/redurection_to_log_in.php" ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Notications</title>

        <?php include_once "../includes/links.php" ;?>
        <link rel="stylesheet" href="../Styles/notifications.css" >
    </head>

    <body>
        <?php include_once "../Controllers/getAllPatients.php"; ?>
        <?php include_once "../Controllers/getAllNotifications.php"; ?>
        <?php include_once "../Controllers/getNotificationsForTuteur.php"; ?>

        <?php   include_once "../includes/nav_bar.php" ; ?>

        <section class="right_part">
            <section class="header_notification">
                <h2>Notifications</h1>
            </section>

            <?php
                $session_connected = $_SESSION['connected'];
                $notifications = getAllNotifications();

                if($session_connected == "doctor") {
                    $id_doctor = $_SESSION['idDoctor'];
                    $notificationsForDoctor = [];
                    foreach($notifications  as $notification) {
                        if($notification->isANotificationForDocto($id_doctor)) {
                            array_push($notificationsForDoctor, $notification);
                        }
                    }

                    if(!empty($notificationsForDoctor)) {
                        foreach ($notificationsForDoctor as $notification) {
                            echo'
                                <section class="notification_to_generate">
                                    <div class="div_header_notification">
                                        <div>
                                            <strong class="date_and_hour">'.$notification->getNotification_date().' | '.$notification->getNotification_hour().'</strong>
                                            <p class="name_patient_notification">'.$notification->getNamesPatient().'</p>
                                        </div>
    
                                        <div class="btns_on_notifications">
                                            <form method="POST" action="../Controllers/c_follow_patient.php" enctype="multipart/form-data">
                                                <input type = "hidden" name="id_patient" value = "'.$notification->getId_patient().'">
                                                <input type="submit" class = "btn_follow" style="width:70px;" value="suivre">
                                            </form>
                                            
                                            <form method="POST" action="../Controllers/c_delete_notification.php" enctype="multipart/form-data">
                                                <input type = "hidden" name="id_notification" value = "'.$notification->getIdNotification($notification).'">
                                                <input type="submit" class = "btn_delete_notification" value="supprimer">
                                            </form>
                                        </div>
                                    </div> <br>
    
                                    <p style="color: gray; ">Etat de santé</p>
                                    <div class="vitalSign">
                                        <strong>'.$notification->getNotification_content().'</strong>
                                    </div>
                                </section>
                                ';
                        }
                    } else {
                        echo '
                            <div class="no_result_classe">
                                Vous avez aucune notification
                            </div>
                        ';
                    }
                } 

                elseif($session_connected == "tuteur") {
                    $id_patient = $_SESSION['id_patient_for_tuteur'];
                    $notificationForTureur = getNotificationsForTuteur($id_patient);
                    if(!empty($notificationForTureur)) {
                        foreach ($notificationForTureur as $notification) {
                            echo'
                                <section class="notification_to_generate">
                                    <div class="div_header_notification">
                                        <div>
                                            <strong class="date_and_hour">'.$notification->getNotification_date().' | '.$notification->getNotification_hour().'</strong>
                                            <h2 class="name_patient_notification">'.$notification->getNamesPatient().'</h2>
                                        </div>

                                        <div class="btns_on_notifications">
                                            <p class = "btn_follow"><a href="../Views/suiviForTuteur.php" style="text-decoration:none; color:white;">suivre</a></p>
                                        </div>
                                    </div> <br>

                                    <h3 style="color: gray;">Etat de santé</h3>
                                    <div class="vitalSign">
                                        <strong>'.$notification->getNotification_content().'</strong>
                                    </div>
                                </section>
                                ';
                        }
                    } else {
                        echo '
                            <div class="no_result_classe">
                                Vous avez aucune notification
                            </div>
                        ';
                    }
                }
            ?>
        </section>
    </body>
</html>