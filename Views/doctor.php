<?php include_once "../includes/redurection_to_log_in.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médecin</title>

    <?php include_once "../includes/links.php" ?>
    <link rel="stylesheet" href="../Styles/doctor.css">
    <script src="../Js_files/doctor.js" defer></script>
</head>

<body>
    <?php include_once "../includes/nav_bar.php" ?>
    <?php include_once "../Controllers/getAllDoctors.php" ?>
    <?php include_once "../Controllers/getDoctorsSearch.php" ?>  <!-- allow us to serarch doctors -->

    <section class="right_part">
            <div class="header_doctor">
                <div class="tile_btn_add">
                    <h2 style=" width: 77px; font-size:16px; color:#1F57EC; padding:10px; background-color: #D7E5FF;">Médecins</h2>

                    <div class="btn_add_doctor">
                        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_155_30)">
                            <path d="M11 9V5H9V9H5V11H9V15H11V11H15V9H11ZM10 20C7.34784 20 4.8043 18.9464 2.92893 17.0711C1.05357 15.1957 0 12.6522 0 10C0 7.34784 1.05357 4.8043 2.92893 2.92893C4.8043 1.05357 7.34784 0 10 0C12.6522 0 15.1957 1.05357 17.0711 2.92893C18.9464 4.8043 20 7.34784 20 10C20 12.6522 18.9464 15.1957 17.0711 17.0711C15.1957 18.9464 12.6522 20 10 20Z" fill="#1F57EC"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_155_30">
                            <rect width="20" height="20" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </div>
                </div>

                <form method="POST" action="" enctype="multipart/form-data">
                    <input type="text" name="doctor_search" class="searching_input" placeholder="Rechercher un médecin">
                    <input type="submit" class="btn_search" value="recherche">
                </form>
            </div>

            <section class="frame_creation">
                <section class="sectionCreation">
                    <form method="POST" action="../Controllers/c_enregistrerDoctor.php" enctype="multipart/form-data">
                        <div class="headerForm">
                           <h1>AJOUTER UN DOCTEUR</h1>
                        </div>

                        <!-- <div class = "affichageErreur">
                            <p>Salut</p>
                        </div> --> 
                   
                        <div class="divInputs">
                            <div class="divInputsI">

                                <input type="text" name="doctor_name" placeholder="Nom" class="champEntree" required/> <br><br>
                                <input type="text" name="doctor_postname" placeholder="Post-nom" class="champEntree" required/> <br><br>
                                <input type="text" name="doctor_surname" placeholder = "Prénom" class="champEntree" required/> <br><br>

                                <select name = "doctor_gender" class="champSelect" required>
                                    <option value="">Choisi ton genre</option>
                                    <option value="masculin">Masculin</option>
                                    <option value="feminin">Féminin</option>
                                </select><br><br>
                                <input type="mail" name="doctor_mail" placeholder="Addresse mail" class="champEntree" required/> <br><br>
                            </div>

                            <div class="divInputsII">
                                <input type="number" placeholder="Numéro de téléphone" min="0" step="1" name="doctor_phone_number" class="champEntree" required/> <br><br>
                                <input type="file" name="doctor_picture" class="champPicture" required/><br>
                            
                                <label for="doctor_speciality"></label> <br>
                                <input type="text" placeholder="Spécialité" name="doctor_speciality" class="champEntree" required/><br><br>
                                <input type="text" placeholder="Hôspital de service" name="service_hospital" class="champEntree" required/><br><br>
                            </div>
                        </div>
                    
                        <div class="divCancel"> 
                            <button type="button" class="btnCancel">Annuler</button>
                            <input type="submit" class="btnSubmit" value="Enregistrer"/> <br>
                        </div>

                        
                    </form>
                </section>      
            </section>

            <section class="header_section_displaying_doctors">
                <p style="width:300px;">Nom</p>
                <p style="width:100px;">Genre</p>
                <p style="width:130px;">Téléphone</p>
                <p style="width:120px;">Date création</p>
                <!-- <p style="width:130px;">Quartier</p>
                <p style="width:120px;">Commune</p> -->
            </section>

            <section class="displaying_patients">
            
                <?php
                    // doctors search from the formuler
                    if(!empty(getDoctorsSearch())) {
                        if(getDoctorsSearch() != "no_doctor_founded") {
                            $doctors = getDoctorsSearch();
                        }

                        elseif(getDoctorsSearch() == "no_doctor_founded") {
                            $doctors = null;
                        }
                    } else $doctors = getAllDoctors();

                    if(!empty($doctors)) {
                        if(count($doctors)>0) {
                            foreach($doctors as $doctor) {
                                if($doctor->getDoctorRole() !== 'doctorCenter') {
                                    if($doctor->getDoctorPicture() == "") $doctorPicture = '../images/default_image.png'; 
                                    else  $doctorPicture = $doctor->getDoctorPicture();

                                    echo '
                                        <secion class="patient_view">
                                            <section class ="patient_view_left">
                                                <div style="width:305px;">
                                                    <img src="'.$doctorPicture.'">
                                                    <div>
                                                        <strong>'.$doctor->getDoctorName().' '.$doctor->getDoctorPostName().' '.$doctor->getDoctorSurName().'</strong>
                                                        <p style="font-size: 12px;">'.$doctor->getDoctorMail().'</p>
                                                    </div>
                                                </div>

                                                <div style="width:100px;">
                                                    '.$doctor->getDoctorGender().'
                                                </div>

                                                <div style="width:130px;">
                                                    '.$doctor->getDoctorPhoneNumber().'
                                                </div>

                                                <div style="width:120px;">
                                                    '.$doctor->getDoctorDateCreated().'
                                                </div>
                                            </section>

                                            <form method="POST" action="../Controllers/c_deleteDoctor.php" enctype="multipart/form-data">
                                                <input type = "hidden" name="id_doctor" value = "'.$doctor->getIdDoctor($doctor).'">
                                                <input type="submit" class="btn_delete" style="border:0px;" value="supprimer">
                                            </form>
                                        </secion>
                                        ';
                                }
                            }
                        }
                    }

                    elseif ($doctors == null && (getDoctorsSearch() == "no_doctor_founded")) {
                        echo '
                        <div class="no_result_classe" style="width:73%; margin-top:40px;">
                            Aucun médecin trouvé, utilise son nom d\'utilisateur pour faire la recherche
                        </div>';
                    }  else {
                        echo 
                            '<div class="no_result_classe" style="width:73%; margin-top:40px;">
                                Aucun médecin n\'est enregistrer dans le système
                            </div>';
                    }
                ?>

            </section>
        </section>
</body>
</html>