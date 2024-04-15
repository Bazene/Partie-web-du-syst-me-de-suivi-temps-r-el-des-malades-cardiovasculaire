<?php include_once "../includes/redurection_to_log_in.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <?php include_once "../includes/links.php";?>
    <link rel="stylesheet" href="../Styles/parametres.css">
    <script src="../Js_files/parametres.js" defer></script>
</head>
<body>
    <?php include_once "../Controllers/getAllDoctors.php" ?>
    <?php include_once "../Controllers/getTuteurByIdPatient.php" ?>
    <?php include_once "../includes/nav_bar.php" ;?>

    <?php 
        if($_SESSION['connected'] === "tuteur") {
            $id_user = $_SESSION['id_patient_for_tuteur'] ;
            $user_name = "tuteur";

            $tuteur = getTuteurByIdPatient($id_user);
            $user_picture_display = $tuteur->getTuteurPicture();
            $user_name_display = $tuteur->getTuteurName();
            $user_postname_display = $tuteur->getTuteurPostName();
            $user_surname_display = $tuteur->getTuteurSurName();
            $user_mail = $tuteur->getTuteurMail();
            $user_phone_number_display = $tuteur->getTuteurPhoneNumber();

        } elseif ($_SESSION['connected'] === "doctor") {
            $id_user = $_SESSION['idDoctor'] ;
            $user_name = "doctor";

            $doctor = getDoctorById($id_user);
            $user_picture_display = $doctor->getDoctorPicture();
            $user_name_display = $doctor->getDoctorName();
            $user_postname_display = $doctor->getDoctorPostName();
            $user_surname_display = $doctor->getDoctorSurName();
            $user_mail = $doctor->getDoctorMail();
            $user_phone_number_display = $doctor->getDoctorPhoneNumber();
        }
    ?>

    <section class="right_part">
        <section class="frame_creation">
            <section class="sectionCreation">
                <form class="formuler_1" method="POST" action="../Controllers/c_editDoctorAndTuteur.php" enctype="multipart/form-data">
                    <div class="headerForm">
                        <h1>MODIFIER PROFILE</h1>
                    </div>
                    <?php
                        echo '
                                <div class="divInputs">
                                    <div class="divInputsI">
                                        <input type="text" name="user_name" value = "'.$user_name_display.'" placeholder="Nom" class="champEntree" required/> <br><br>
                                        <input type="text" name="user_postname" value = "'.$user_postname_display.'" placeholder="Post-nom" class="champEntree" required/> <br><br>
                                    </div>

                                    <div class="divInputsII">
                                        <input type="text" name="user_surname" value = "'.$user_surname_display.'" placeholder="Prénom" class="champEntree" required/> <br><br>
                                        <input type="number" min="0" step="1" name="user_phone_number" value = "'.$user_phone_number_display.'" placeholder="Numéro de téléphone" class="champEntree" required/> <br><br>
                                        <input type = "hidden" name="id_user" value = "'.$id_user.'">
                                        <input type = "hidden" name="user_concerned" value = "'.$user_name.'">
                                    </div>
                                </div>
                            ';
                        ?>
                
                    <div class="divCancel"> 
                        <button type="button" class="btnCancel">Annuler</button>
                        <input type="submit" class="btnSubmit" value="Enregistrer"/> <br>
                    </div>
                </form>

                <form class="formuler_2" method="POST" action="../Controllers/c_editPictureDoctorAndTuteur.php" enctype="multipart/form-data">
                    <div class="headerForm">
                        <h1>MODIFIER PHOTO</h1>
                    </div>
                  
                        <div class="divInputs">
                            <div class="divInputsII">
                                <?php
                                    echo '
                                        <input type="file" name="user_picture" class="champPicture" required/><br><br>                            
                                        <input type = "hidden" name="user_concerned" value = "'.$user_name.'">
                                        <input type = "hidden" name="id_user" value = "'.$id_user.'">
                                    ';
                                ?>
                            </div>
                        </div>
                
                    <div class="divCancel"> 
                        <button type="button" class="btnCancel2">Annuler</button>
                        <input type="submit" class="btnSubmit" value="Enregistrer"/> <br>
                    </div>
                </form> 
            </section>      
        </section>

        <section class="my_patients">
            <div class="stroke_section">
                <?php
                    if($user_picture_display == "") $photo_user = '../images/default_image.png';
                    else $photo_user = $user_picture_display;
                
                echo '
                    <div class="image">
                        <img src="'.$photo_user.'">
                    </div>

                    <div class="info">
                        <section class="header_info_user">
                            <div style="color:black; padding-left:50px; display: flex; flex-direction:column; justify-content:center; align-items:center;">
                                <strong style="font-size:16px; margin-bottom:5px;">'.$user_name_display.' '.$user_postname_display.' '.$user_surname_display.'</strong> <br>
                                <span style="font-size:14px; color:gray;">'.$user_mail.'</span>
                            </div> 

                            <div id="edit_profil_user" style="background-color: #1F57EC;" >
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 17.25V21H6.75L17.81 9.94L14.06 6.19L3 17.25ZM20.71 7.04C20.8027 6.94749 20.8763 6.8376 20.9264 6.71663C20.9766 6.59565 21.0024 6.46597 21.0024 6.335C21.0024 6.20403 20.9766 6.07435 20.9264 5.95338C20.8763 5.83241 20.8027 5.72252 20.71 5.63L18.37 3.29C18.2775 3.1973 18.1676 3.12375 18.0466 3.07357C17.9257 3.02339 17.796 2.99756 17.665 2.99756C17.534 2.99756 17.4043 3.02339 17.2834 3.07357C17.1624 3.12375 17.0525 3.1973 16.96 3.29L15.13 5.12L18.88 8.87L20.71 7.04Z" fill="white"/>
                                </svg>
                            </div>
                        </section>

                        <section style = "margin-bottom:10px; display:flex; flex-direction:row; justify-content:center; align-items:center;">
                            <svg width="24" height="24" style="margin-right:5px;" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.62 10.79C8.06 13.62 10.38 15.93 13.21 17.38L15.41 15.18C15.68 14.91 16.08 14.82 16.43 14.94C17.55 15.31 18.76 15.51 20 15.51C20.55 15.51 21 15.96 21 16.51V20C21 20.55 20.55 21 20 21C10.61 21 3 13.39 3 4C3 3.45 3.45 3 4 3H7.5C8.05 3 8.5 3.45 8.5 4C8.5 5.25 8.7 6.45 9.07 7.57C9.18 7.92 9.1 8.31 8.82 8.59L6.62 10.79Z" fill="#1F57EC"/>
                            </svg>'.$user_phone_number_display.' 
                        </section>
                    </div>
                    ';
                ?>
            </div>
        </section>
    </section>
</body>
</html>