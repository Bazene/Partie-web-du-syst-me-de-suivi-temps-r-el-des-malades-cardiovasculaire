<?php include_once "../includes/redurection_to_log_in.php" ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tuteurs</title>

        <?php include_once "../includes/links.php" ;?>
        <link rel="stylesheet" href="../Styles/patients.css">

    </head>

    <body>
        <?php include_once "../Controllers/getAllTuteurs.php"; ?>
        <?php   include_once "../includes/nav_bar.php" ; ?>

        <section class="right_part">
            <div class="header_patients">
                <h2 style="margin-bottom: 10px; width: 60px; font-size:16px; color:#1F57EC; padding:10px; background-color: #D7E5FF;">Tuteurs</h2>

                <form method="POST" action="" enctype="multipart/form-data">
                    <input type="text" name="tuteur_search" class="searching_input" placeholder="Rechercher un patient">
                    <input type="submit" class="btn_search" value="recherche">
                </form>
            </div>

            <section class="header_section_displaying_patients">
                <p style="width:300px;">Nom</p>
                <p style="width:100px;">Genre</p>
                <p style="width:130px;">Téléphone</p>
                <p style="width:120px;">Date création</p>
            </section>

            <section class="displaying_patients">
                <?php 
                    if(!empty(getTuteursSearch())) {
                        if(getTuteursSearch() != "no_patients_founded") $allTuteurs = getTuteursSearch();
                        elseif (getTuteursSearch() == "no_patients_founded") $allTuteurs = null;
                    } else $allTuteurs = getAllTuteurs();

                    if(!empty($allTuteurs)) {
                        if(count($allTuteurs) > 0) {
                            foreach($allTuteurs as $tuteur) {
                                if($tuteur->getTuteurPicture() == "") $tuteurPicture = '../images/default_image.png'; 
                                else $tuteurPicture = $tuteur->getTuteurPicture();

                                echo 
                                    '<secion class="patient_view">
                                        <section class ="patient_view_left">
                                            <div style="width:305px;">
                                                <img src="'.$tuteurPicture.'">
                                                <div>
                                                    <strong>'.$tuteur->getTuteurName().' '.$tuteur->getTuteurPostName().' '.$tuteur->getTuteurSurName().'</strong>
                                                    <p style="font-size: 12px;">'.$tuteur->getTuteurMail().'</p>
                                                </div>
                                            </div>

                                            <div style="width:100px;">
                                                '.$tuteur->getTuteurGender().'
                                            </div>

                                            <div style="width:130px;">
                                                '.$tuteur->getTuteurPhoneNumber().'
                                            </div>

                                            <div style="width:120px;">
                                                '.$tuteur->getTuteurDateCreated().'
                                            </div>
                                        </section>

                                        <form method="POST" action="../Controllers/c_deleteTuteur.php" enctype="multipart/form-data">
                                            <input type = "hidden" name="id_patient" value = "'.$tuteur->getIdPatien().'">
                                            <input type="submit" class="btn_delete" style="border:0px;" value="supprimer">
                                        </form> 
                                    </section>
                                    ';
                        
                            }    
                        }
                    } 

                    elseif($allTuteurs == null && (getTuteursSearch() == "no_patients_founded")) {
                        echo '
                            <div class="no_result_classe" style="width:73%; margin-top:40px;">
                                Aucun tuteur trouvé, utilise son nom d\'utilisateur pour faire la recherche
                            </div>';
                    }  else {
                        echo 
                            '<div class="no_result_classe" style="width:73%; margin-top:40px;">
                                Aucun tuteur n\'est enregistrer dans le système
                            </div>';
                    }
                ?>

            </section>

        </section>
    </body>
</html>