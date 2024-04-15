<?php include_once "../includes/redurection_to_log_in.php" ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Patients</title>

        <?php include_once "../includes/links.php" ;?>
        <link rel="stylesheet" href="../Styles/patients.css">

    </head>

    <body>
        <?php include_once "../Controllers/getAllPatients.php"; ?>
        <?php   include_once "../includes/nav_bar.php" ; ?>

        <section class="right_part">
            <div class="header_patients">
                <h2 style="margin-bottom: 10px; width: 60px; font-size:16px; color:#1F57EC; padding:10px; background-color: #D7E5FF;">Patients</h2>

                <form method="POST" action="" enctype="multipart/form-data">
                    <input type="text" name="patient_search" class="searching_input" placeholder="Rechercher un patient">
                    <input type="submit" class="btn_search" value="recherche">
                </form>
            </div>

            <section class="header_section_displaying_patients">
                <p style="width:300px;">Nom</p>
                <p style="width:100px;">Genre</p>
                <p style="width:130px;">Téléphone</p>
                <p style="width:120px;">Date création</p>
                <p style="width:130px;">Quartier</p>
                <p style="width:120px;">Commune</p>
            </section>

            <section class="displaying_patients">
                <?php 
                    if(!empty(getPatientsSearch())) {
                        if(getPatientsSearch() != "no_patients_founded") $allPatients = getPatientsSearch();
                        elseif (getPatientsSearch() == "no_patients_founded") $allPatients = null;
                    } else $allPatients = getAllPatients();

                    if(!empty($allPatients)) {
                        if(count($allPatients) > 0) {
                            foreach($allPatients as $patient) {
                                if($patient->getPatientPicture() == "") $patientPicture = '../images/default_image.png'; 
                                else $patientPicture = $patient->getPatientPicture();

                                echo 
                                '<secion class="patient_view">
                                    <section class ="patient_view_left">
                                        <div style="width:305px;">
                                            <img src="'.$patientPicture.'">
                                            <div>
                                                <strong>'.$patient->getPatientName().' '.$patient->getPatientPostName().' '.$patient->getPatientSurName().'</strong>
                                                <p style="font-size: 12px;">'.$patient->getPatientMail().'</p>
                                            </div>
                                        </div>

                                        <div style="width:100px;">
                                            '.$patient->getPaientGender().'
                                        </div>

                                        <div style="width:130px;">
                                            '.$patient->getPatientPhoneNumber().'
                                        </div>

                                        <div style="width:120px;">
                                            '.$patient->getPatientDateCreated().'
                                        </div>

                                        <div style="width:130px;">
                                            '.$patient->getPatientQuater().'
                                        </div>

                                        <div style="width:120px;">
                                            '.$patient->getPatientCommune().'
                                        </div>
                                    </section>';

                                    $connected = $_SESSION['connected'];
                                    if($connected == "doctor") {
                                        if(($patient->getIdDoctor() === $patient->getIdDoctorArchived()) || ($patient->getIdDoctor() === getIdDoctorCenter())) {
                                            echo '
                                                <form method="POST" class="btn_follow" action="../Controllers/c_newPatientToFollow.php" enctype="multipart/form-data">
                                                    <input type = "hidden" name="id_doctor" value = "'.$_SESSION['idDoctor'].'">
                                                    <input type = "hidden" name="id_patient" value = "'.$patient->getIdPatient($patient).'">
                                                    <input type="submit" style="border:0px; background-color: #8CC5CA; cursor:pointer" value="suivre">
                                                </form> ';
                                        } else {
                                            echo '
                                                <div class="btn_suivi_destroy" title = "Ce patient est suivi par un autre médecin">
                                                    suivre
                                                </div>';
                                        }
                                    } 
                                    elseif($connected == "admin") {
                                        echo '
                                            <form method="POST" action="../Controllers/c_deletePatient.php" enctype="multipart/form-data">
                                                <input type = "hidden" name="id_patient" value = "'.$patient->getIdPatient($patient).'">
                                                <input type="submit" class="btn_delete" style="border:0px;" value="supprimer">
                                            </form> 
                                            ';
                                    }

                                 echo '   
                                </secion>';
                        
                            }    
                        }
                    } 

                    elseif($allPatients == null && (getPatientsSearch() == "no_patients_founded")) {
                        echo '
                            <div class="no_result_classe" style="width:73%; margin-top:40px;">
                                Aucun patient trouvé, utilise son nom d\'utilisateur pour faire la recherche
                            </div>';
                    }  else {
                        echo 
                            '<div class="no_result_classe" style="width:73%; margin-top:40px;">
                                Aucun patient n\'est enregistrer dans le système
                            </div>';
                    }
                ?>

            </section>

        </section>
    </body>
</html>