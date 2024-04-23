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

            <section>
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
                                                
                                            </div>
        
                                            <div class="btns_on_notifications">
                                                <form method="POST" action="../Controllers/c_follow_patient.php" enctype="multipart/form-data">
                                                    <input type = "hidden" name="id_patient" value = "'.$notification->getId_patient().'">
                                                    <input type="submit" class = "btn_follow1" value="">
                                                </form>
                                                
                                                <form method="POST" action="../Controllers/c_delete_notification.php" enctype="multipart/form-data">
                                                    <input type = "hidden" name="id_notification" value = "'.$notification->getIdNotification($notification).'">
                                                    <input type="submit" class = "btn_delete_notification" value="supprimer">
                                                </form>
                                            </div>
                                        </div> <br>
        
                                        <div style = "display: flex; flex-direction: row; justify-content:flex-start; align-items: center;">
                                            <p style="margin-right:10px; ">Etat de santé</p>
                                            <p class="name_patient_notification">'.$notification->getNamesPatient().'</p>
                                        </div>

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
                                                <p class = "btn_follow">
                                                    <a href="../Views/suiviForTuteur.php" style="display:flex; flex-direction:row; justify-content:center; align-items: center; text-decoration:none; color:white;">
                                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M13 8V16C13 16.7956 12.6839 17.5587 12.1213 18.1213C11.5587 18.6839 10.7956 19 10 19H7.83C7.59409 19.6675 7.1298 20.2301 6.51919 20.5884C5.90858 20.9466 5.19098 21.0775 4.49321 20.9578C3.79545 20.8381 3.16246 20.4756 2.70613 19.9344C2.2498 19.3931 1.99951 18.708 1.99951 18C1.99951 17.292 2.2498 16.6069 2.70613 16.0656C3.16246 15.5244 3.79545 15.1619 4.49321 15.0422C5.19098 14.9225 5.90858 15.0534 6.51919 15.4116C7.1298 15.7699 7.59409 16.3325 7.83 17H10C10.2652 17 10.5196 16.8946 10.7071 16.7071C10.8946 16.5196 11 16.2652 11 16V8C11 7.20435 11.3161 6.44129 11.8787 5.87868C12.4413 5.31607 13.2044 5 14 5H17V2L22 6L17 10V7H14C13.7348 7 13.4804 7.10536 13.2929 7.29289C13.1054 7.48043 13 7.73478 13 8Z" fill="white"/>
                                                        </svg>
                                                    </a>
                                                </p>
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
        </section>
    </body>
</html>