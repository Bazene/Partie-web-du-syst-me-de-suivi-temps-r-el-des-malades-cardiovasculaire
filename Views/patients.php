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
        <?php   include_once "../includes/nav_bar.php" ; ?>

        <section class="right_part">
            <div class="header_patients">
                <h2 style="margin-bottom: 10px; width: 60px; font-size:16px; color:#1F57EC; padding:10px; background-color: #D7E5FF;">Patients</h2>

                <form>
                    <input type="text" class="searching_input" placeholder="Rechercher un patient">
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

                <secion class="patient_view">
                    <div style="width:300px;">
                        <img src="../images/serge.JPG">
                        <div>
                            <strong>BAZENE SERGE Amos</strong>
                            <p style="font-size: 12px;">bazenesergeamos0@gmail.com</p>
                        </div>
                    </div>

                    <div style="width:100px;">
                        Masculin
                    </div>

                    <div style="width:130px;">
                        0975 149 026
                    </div>

                    <div style="width:120px;">
                        22/02/2024
                    </div>

                    <div style="width:130px;">
                        Himbi
                    </div>

                    <div style="width:120px;">
                        Goma
                    </div>

                    <div class="btns_archiver_suivre">
                        <div class="btn_archived">
                            archiver
                        </div>

                        <div class="btn_follow">
                            <p>suivre</p>
                        </div>
                    </div>
                </secion>

                <secion class="patient_view">
                    <div style="width:300px;">
                        <img src="../images/serge.JPG">
                        <div>
                            <strong>BAZENE SERGE Amos</strong>
                            <p style="font-size: 12px;">bazenesergeamos0@gmail.com</p>
                        </div>
                    </div>

                    <div style="width:100px;">
                        Masculin
                    </div>

                    <div style="width:130px;">
                        0975 149 026
                    </div>

                    <div style="width:120px;">
                        22/02/2024
                    </div>

                    <div style="width:130px;">
                        Himbi
                    </div>

                    <div style="width:120px;">
                        Goma
                    </div>

                    <div class="btns_archiver_suivre">
                        <div class="btn_archived">
                            archiver
                        </div>

                        <div class="btn_follow">
                            <p>suivre</p>
                        </div>
                    </div>
                </secion>

                <secion class="patient_view">
                    <div style="width:300px;">
                        <img src="../images/serge.JPG">
                        <div>
                            <strong>BAZENE SERGE Amos</strong>
                            <p style="font-size: 12px;">bazenesergeamos0@gmail.com</p>
                        </div>
                    </div>

                    <div style="width:100px;">
                        Masculin
                    </div>

                    <div style="width:130px;">
                        0975 149 026
                    </div>

                    <div style="width:120px;">
                        22/02/2024
                    </div>

                    <div style="width:130px;">
                        Himbi
                    </div>

                    <div style="width:120px;">
                        Goma
                    </div>

                    <div class="btns_archiver_suivre">
                        <div class="btn_archived">
                            archiver
                        </div>

                        <div class="btn_follow">
                            <p>suivre</p>
                        </div>
                    </div>
                </secion>
            </section>

        </section>
    </body>
</html>