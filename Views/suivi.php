<?php include_once "../includes/redurection_to_log_in.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi</title>

    <?php include_once "../includes/links.php";?>
    <link rel="stylesheet" href="../Styles/suivi.css">
    <script src="../Js_files/suivi.js" defer></script>

    <script src="../Js_files/patientInformation.js" defer></script>
    <script src="../Js_files/vitalSingRealTime.js" defer></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../Js_files/graphique.js" defer></script>
</head>

<body>
    <?php include_once "../includes/nav_bar.php"; ?>

    <section class="section_patient_vitalSign">
        <section class="frame_creation">
            <section class="sectionCreation">
                <form method="POST" action="../Controllers/c_enregistrerTuteur.php" enctype="multipart/form-data">
                    <div class="headerForm">
                        <h1>AJOUTER UN TUTEUR</h1>
                    </div>

                    <!-- <div class = "affichageErreur">
                        <p>Salut</p>
                    </div> --> 
                
                    <div class="divInputs">
                        <div class="divInputsI">
                            <input type="text" name="tuteur_name" placeholder="Nom" class="champEntree" required/> <br><br>

                            <input type="text" name="tuteur_postname" placeholder="Post-nom" class="champEntree" required/> <br><br>

                            <input type="text" name="tuteur_surname" placeholder="Prénom" class="champEntree" required/> <br><br>

                            <select name = "tuteur_gender" class="champSelect" required>
                                <option value="" style="color:rgba(128, 128, 128, 20%);">Choisi ton genre</option>
                                <option value="masculin">Masculin</option>
                                <option value="feminin">Féminin</option>
                            </select><br><br>
                        </div>

                        <div class="divInputsII">
                            <input type="mail" name="tuteur_mail" placeholder="Adresse mail" class="champEntree" required/> <br><br>

                            <input type="number" min="0" step="1" name="tuteur_phone_number" placeholder="Numéro de téléphone" class="champEntree" required/> <br><br>
                        
                            <input type="text" name="relationship_type" placeholder="Type de relation" class="champEntree" required/><br><br>

                            <?php 
                                $id_patient = $_SESSION['id_patient_for_vitalSign'] ;
                                echo '<input type = "hidden" name="id_patient" value = "'.$id_patient.'">';
                            ?>
                        </div>
                    </div>
                
                    <div class="divCancel"> 
                        <button type="button" class="btnCancel">Annuler</button>
                        <input type="submit" class="btnSubmit" value="Enregistrer"/> <br>
                    </div>
                    
                </form>
            </section>      
        </section>

        <section class="section_dashbord_suivi">
            <h2>Information sur le patient</h2>

            <form method="POST" class="btn_archived" action="../Controllers/c_archive_patient.php" enctype="multipart/form-data">
                <input type = "hidden" name="id_patient" value = <?php echo $_SESSION['id_patient_for_vitalSign'] ; ?> >
                <input type = "hidden" name="id_doctor_archiver" value = <?php echo $_SESSION['idDoctor'] ; ?> >
                <input type="submit" style="border:0px; background-color: #B987AD; color:white; cursor:pointer;" value="archiver">
            </form>

            <div class="btn_add_tuteur">
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

            <!-- <div class="btn_rapport">
                rapport
            </div> -->
        </section>

        <section class="section_header_suivi">
            <div id="div_name_age" style="width:300px;">
                Noms : <br>
                Age : 
            </div>
          
            <div id ="div_gender_contact" style="width:200px;">
                Genre :  <br>
                Contact : 
            </div>
           
            <div id="div_weight_size" style="width:200px;">
                Poids : <br>
                Taille : 
            </div>

            <div class="btn_see_more">
                <div class="btn_see_more_cash">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.0001 6L8.59009 7.41L13.1701 12L8.59009 16.59L10.0001 18L16.0001 12L10.0001 6Z" fill="white"/>
                    </svg>
                </div>

                <div class="btn_see_more_show">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.70992 9.29001C6.61722 9.38253 6.54367 9.49242 6.49349 9.61339C6.44331 9.73436 6.41748 9.86405 6.41748 9.99501C6.41748 10.126 6.44331 10.2557 6.49349 10.3766C6.54367 10.4976 6.61722 10.6075 6.70992 10.7L11.2999 15.29C11.3924 15.3827 11.5023 15.4563 11.6233 15.5064C11.7443 15.5566 11.874 15.5825 12.0049 15.5825C12.1359 15.5825 12.2656 15.5566 12.3865 15.5064C12.5075 15.4563 12.6174 15.3827 12.7099 15.29L17.2999 10.7C17.3925 10.6074 17.4659 10.4975 17.5161 10.3766C17.5662 10.2556 17.5919 10.1259 17.5919 9.99501C17.5919 9.86408 17.5662 9.73444 17.5161 9.61347C17.4659 9.49251 17.3925 9.3826 17.2999 9.29001C17.2073 9.19743 17.0974 9.12399 16.9765 9.07389C16.8555 9.02378 16.7259 8.99799 16.5949 8.99799C16.464 8.99799 16.3343 9.02378 16.2134 9.07389C16.0924 9.12399 15.9825 9.19743 15.8899 9.29001L11.9999 13.17L8.11992 9.29001C7.72992 8.90001 7.08992 8.91001 6.70992 9.29001Z" fill="white"/>
                    </svg>
                </div>
            </div>
        </section>

        <section class="other_patient_attributs" style="display:none;"> 
            <div class="attributs_patient">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 4.5C5.20435 4.5 4.44129 4.81607 3.87868 5.37868C3.31607 5.94129 3 6.70435 3 7.5V7.8015L12 12.648L21 7.803V7.5C21 6.70435 20.6839 5.94129 20.1213 5.37868C19.5587 4.81607 18.7956 4.5 18 4.5H6ZM21 9.5055L12.3555 14.16C12.2462 14.2188 12.1241 14.2496 12 14.2496C11.8759 14.2496 11.7538 14.2188 11.6445 14.16L3 9.5055V16.5C3 17.2956 3.31607 18.0587 3.87868 18.6213C4.44129 19.1839 5.20435 19.5 6 19.5H18C18.7956 19.5 19.5587 19.1839 20.1213 18.6213C20.6839 18.0587 21 17.2956 21 16.5V9.5055Z" fill="#1F57EC"/>
                </svg> 
                <p id="p_mail_adress">bazenesergeamos0@gmail.com</p>
            </div>

            <div class="attributs_patient" style = "margin-bottom:30px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_151_47)">
                    <path d="M4.929 16.3785C3.119 16.9215 2 17.6715 2 18.5C2 20.157 6.477 21.5 12 21.5C17.523 21.5 22 20.157 22 18.5C22 17.6715 20.8805 16.9215 19.071 16.3785" stroke="#1F57EC" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 17.5C12 17.5 18.5 13.252 18.5 8.341C18.5 4.839 15.59 2 12 2C8.41 2 5.5 4.839 5.5 8.341C5.5 13.252 12 17.5 12 17.5Z" stroke="#1F57EC" stroke-width="4" stroke-linejoin="round"/>
                    <path d="M12 11C12.663 11 13.2989 10.7366 13.7678 10.2678C14.2366 9.79893 14.5 9.16304 14.5 8.5C14.5 7.83696 14.2366 7.20107 13.7678 6.73223C13.2989 6.26339 12.663 6 12 6C11.337 6 10.7011 6.26339 10.2322 6.73223C9.76339 7.20107 9.5 7.83696 9.5 8.5C9.5 9.16304 9.76339 9.79893 10.2322 10.2678C10.7011 10.7366 11.337 11 12 11Z" stroke="#1F57EC" stroke-width="4" stroke-linejoin="round"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_151_47">
                    <rect width="24" height="24" fill="white"/>
                    </clipPath>
                    </defs>
                </svg>
                <p id="p_commune_quater">Commune : ; Quartier : </p>
            </div>

            <h1>Information sur le tuteur</h1> <hr style="color:#1F57EC; width:190px; margin-bottom:10px;">
            <div class="orther_info_patient">
                <p id="p_name_tuteur">Nom tuteur :</p>
                <p id="p_mail_tuteur">Mail :</p>
                <p id="p_contact_tuteur">Contact :</p>
                <p id="p_gender_tuteur">Genre :</p>
            </div>

            <div class="no_tuteur_classe">
                Aucun tuteur n'est associé à ce patient
            </div>
        </section>

        <div class="header_secton_vs">
            <h3>Signes vitaux</h3> 
            
            <div class="btn_see_vs">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.0001 6L8.59009 7.41L13.1701 12L8.59009 16.59L10.0001 18L16.0001 12L10.0001 6Z" fill="black"/>
                </svg>
            </div>
        </div> <hr>

        <section class="vitalSign_grid">
            <section class="view_vitalSign">
                <div style="margin-bottom: 20px;">
                    <div class="div_icone_vitalSign" style="background-color: #B987AD;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.13179 2.24997C6.32756 2.24997 4.79297 2.93847 3.71721 4.19397C2.65132 5.43597 2.11768 7.13697 2.11768 9.01947C2.11768 12.2895 3.68473 14.895 5.67532 16.9215C7.65744 18.939 10.1506 20.4735 12.2146 21.621C12.3654 21.705 12.5331 21.7492 12.7034 21.7497C12.8738 21.7503 13.0417 21.7071 13.193 21.624C15.2584 20.4885 17.7501 18.942 19.7337 16.914C21.7243 14.8815 23.2941 12.267 23.2941 9.01947C23.2941 7.12947 22.7577 5.42997 21.6904 4.18797C20.6132 2.93547 19.0786 2.24847 17.28 2.24847C15.761 2.24847 14.5045 2.84697 13.5487 3.97497C13.2222 4.36598 12.9394 4.79585 12.7059 5.25597C12.4724 4.79585 12.1896 4.36598 11.8631 3.97497C10.9073 2.84697 9.65085 2.24997 8.13179 2.24997Z" fill="#920200"/>
                            <path d="M2.66361 13.0887H7.1229C7.57504 13.0887 7.84633 12.9379 7.93633 12.6364L9.44319 7.44598L12.0858 19.3414C12.2062 19.8837 13.3213 19.8763 13.4619 19.3414L16.0235 10.3388L16.6158 12.576C16.7062 12.9231 16.9672 13.0887 17.4395 13.0887H21.3369C21.7389 13.0887 22.0603 12.855 22.0603 12.5615C22.0603 12.26 21.7488 12.0263 21.3369 12.0263H17.781L16.626 8.19169C16.4752 7.67194 15.4406 7.67194 15.27 8.21419L12.7488 16.6594L10.1173 4.65855C10.0068 4.13141 8.97176 4.1163 8.81104 4.65855L6.68147 12.0263H2.66361C2.26161 12.0263 1.94019 12.2674 1.94019 12.5612C1.94019 12.855 2.26161 13.0887 2.66361 13.0887Z" fill="white"/>
                        </svg>
                    </div>

                    <p><strong>Fréquence cardiaque</strong></p>
                </div>

                <div style="margin-bottom: 20px;">
                    <span id="span_heart_rate" style="font-size:25px; margin-right:10px;">0</span> BPM
                </div>

                <div class="state_health" style="margin-bottom: 20px;">
                    <p style="background-color: #B987AD; color:white;">...</p>
                </div>

                <div>
                    <svg viewBox="0 0 96 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="96" height="45" fill="white"/>
                        <path d="M0 24L4.5 19L12 15H20L27.5 19L33 24L35.5 27.5L40.5 24V13L43.5 5L52 0H63.5L71 2L77.5 5L83 10H88.5L96 7V45H0V24Z" fill="url(#paint0_linear_138_121)"/>
                        <path d="M2.5 40L4 34C5.5 29 19.3633 19.1893 27.5 31.5685C44.3298 57.1731 49 21 49 21L51.5 15.5L54.5 12L61 9.5L67 9.5L72.5 12L77 15.5L81 19L84 21H87L90.5 19L92.5 14.5" stroke="#BD8DB2"/>
                        <defs>
                        <linearGradient id="paint0_linear_138_121" x1="48" y1="0" x2="48" y2="45" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#B987AD"/>
                        <stop offset="1" stop-color="#B987AD" stop-opacity="0"/>
                        </linearGradient>
                        </defs>
                    </svg>
                </div>

            </section>

            <section class="view_vitalSign">
                <div style="margin-bottom: 20px;">
                    <div class="div_icone_vitalSign" style="background-color:#F8DEBD;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="24" height="24" fill="#F8DEBD"/>
                            <path d="M12 20C11.7167 20 11.4793 19.904 11.288 19.712C11.0967 19.52 11.0007 19.2827 11 19V15C11 14.7167 11.096 14.4793 11.288 14.288C11.48 14.0967 11.7173 14.0007 12 14H14.5C14.7833 14 15.021 14.096 15.213 14.288C15.405 14.48 15.5007 14.7173 15.5 15V19C15.5 19.2833 15.404 19.521 15.212 19.713C15.02 19.905 14.7827 20.0007 14.5 20H12ZM12.5 18.5H14V15.5H12.5V18.5ZM17 22V19.25C17 18.9667 17.096 18.7293 17.288 18.538C17.48 18.3467 17.7173 18.2507 18 18.25H20V17.5H17V16H20.5C20.7833 16 21.021 16.096 21.213 16.288C21.405 16.48 21.5007 16.7173 21.5 17V18.75C21.5 19.0333 21.404 19.271 21.212 19.463C21.02 19.655 20.7827 19.7507 20.5 19.75H18.5V20.5H21.5V22H17ZM9 21.95C6.95 21.7167 5.27067 20.8377 3.962 19.313C2.65333 17.7883 1.99933 15.9507 2 13.8C2 12.1333 2.66267 10.321 3.988 8.363C5.31333 6.405 7.31733 4.284 10 2C12.2 3.86667 13.946 5.63333 15.238 7.3C16.53 8.96667 17.3673 10.5333 17.75 12H11C10.45 12 9.97933 12.196 9.588 12.588C9.19667 12.98 9.00067 13.4507 9 14V21.95Z" fill="#C67915"/>
                        </svg>
                    </div>

                    <p><strong>SpO2</strong></p>
                </div>

                <div style="margin-bottom: 20px;">
                    <span id="span_spo2" style="font-size:25px; margin-right:10px;">0</span> %
                </div>

                <div class="state_health" style="margin-bottom: 20px;">
                    <p style="background-color:#F8DEBD;">...</p>
                </div>

                <div>
                   <svg viewBox="0 0 96 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 14L2.5 11L7.5 8H13L19.5 11L26 14L32.5 19L43 22L50 19H56.5H62L66.5 14V5.5L70 4H75.5H81.5L87 0.5H92L96 4V42H0V14Z" fill="url(#paint0_linear_138_98)"/>
                        <path d="M94 26L92 26L90.5 25.5L89.5 24.7946L89 23.5V21.5L92 11V10L91.5 9L88.5 7.5H87.5L86.5 8C86.5 8 82.5 14 80 10.5C77.5 7.00001 76 9.50001 76 9.50001C74.5 14.5 76.2266 13.5913 76.8633 14.8155C91 42 70 37.5001 70 37.5001L67 34L65 28.8368L62 26.2171L58.5 24.7946H55L48.5908 27.1947L45.8298 28.6442L42.6889 29.2965L39.6465 29.3277L36.5497 28.8368L33.3061 27.8089L30.521 26.2171L28.3437 23.9847L21.5 19.4316L16 15.9705L10 14.6568L5.5 16.0292L3 17.2805L2 20.5001" stroke="#F5B766"/>
                        <defs>
                        <linearGradient id="paint0_linear_138_98" x1="48" y1="0.5" x2="48" y2="42" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#F8DEBD"/>
                        <stop offset="1" stop-color="#F8DEBD" stop-opacity="0"/>
                        </linearGradient>
                        </defs>
                    </svg>
                </div>

            </section>

            <section class="view_vitalSign">
                <div style="margin-bottom: 20px;">
                    <div class="div_icone_vitalSign" style="background-color: #F9C4C3;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.5 3C19.8978 3 20.2794 3.15804 20.5607 3.43934C20.842 3.72064 21 4.10218 21 4.5C21 4.89782 20.842 5.27936 20.5607 5.56066C20.2794 5.84196 19.8978 6 19.5 6C19.1022 6 18.7206 5.84196 18.4393 5.56066C18.158 5.27936 18 4.89782 18 4.5C18 4.10218 18.158 3.72064 18.4393 3.43934C18.7206 3.15804 19.1022 3 19.5 3ZM19.5 9C20.6935 9 21.8381 8.52589 22.682 7.68198C23.5259 6.83807 24 5.69347 24 4.5C24 3.30653 23.5259 2.16193 22.682 1.31802C21.8381 0.474106 20.6935 0 19.5 0C18.3065 0 17.1619 0.474106 16.318 1.31802C15.4741 2.16193 15 3.30653 15 4.5C15 5.69347 15.4741 6.83807 16.318 7.68198C17.1619 8.52589 18.3065 9 19.5 9ZM4.5 5.25C4.5 4.00781 5.50781 3 6.75 3C7.99219 3 9 4.00781 9 5.25V12.9609C9 13.7719 9.33281 14.4562 9.71719 14.9531C10.2094 15.5906 10.5 16.3828 10.5 17.25C10.5 19.3219 8.82188 21 6.75 21C4.67812 21 3 19.3219 3 17.25C3 16.3828 3.29062 15.5906 3.78281 14.9578C4.16719 14.4563 4.5 13.7719 4.5 12.9609V5.25ZM6.75 0C3.84844 0 1.5 2.35313 1.5 5.25V12.9609C1.5 12.9656 1.49531 12.975 1.49062 12.9891C1.48125 13.0172 1.45313 13.0641 1.41094 13.1203C0.525 14.2594 0 15.6937 0 17.25C0 20.9766 3.02344 24 6.75 24C10.4766 24 13.5 20.9766 13.5 17.25C13.5 15.6937 12.975 14.2594 12.0891 13.1203C12.0469 13.0641 12.0188 13.0172 12.0094 12.9891C12.0047 12.975 12 12.9656 12 12.9609V5.25C12 2.35313 9.65156 0 6.75 0ZM6.75 19.5C7.99219 19.5 9 18.4922 9 17.25C9 16.2703 8.37188 15.4359 7.5 15.1266V5.25C7.5 4.8375 7.1625 4.5 6.75 4.5C6.3375 4.5 6 4.8375 6 5.25V15.1266C5.12812 15.4359 4.5 16.2703 4.5 17.25C4.5 18.4922 5.50781 19.5 6.75 19.5Z" fill="#FD8A88"/>
                        </svg>
                    </div>

                    <p><strong>Température</strong></p>
                </div>

                <div style="margin-bottom: 20px;">
                    <span id="span_temperature" style="font-size:25px; margin-right:10px;">0</span> °C
                </div>

                <div class="state_health" style="margin-bottom: 20px;">
                    <p style="background-color: #F9C4C3;">...</p>
                </div>

                <div>
                    <svg viewBox="0 0 96 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 23.5L2 20L4 17L10 11.5L15 8.5L20 7.5L25.5 8.5L30 10.5L33.5 14L35.5 17L37.5 18.5H40L42.5 17L44 12.5L45 9.5L48 6L50.5 4.5L54.5 3.5H58.5L63 4.5L66.5 6L69 8.5L72 12.5L74.5 16L77 20L79 21.5H81L83 20L85.5 14L88 7.5L90 0H96V38H0V29.5V23.5Z" fill="url(#paint0_linear_138_113)"/>
                        <path d="M93 4.99999L87 21.1947C85.5 26.1947 79.1367 32.5963 71 20.2171C54.1702 -5.38754 47 16 47 16L45 20.2171L42.5 24L39 26H35.5497L33 24L30.5 21.1946L28 18L25 14.5L20.5 13.4315L16.5 14.5L12.5 18L10 21.1946L7 26L2.5 33" stroke="#FD8A88"/>
                        <defs>
                        <linearGradient id="paint0_linear_138_113" x1="48" y1="0" x2="48" y2="38" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#F9C4C3"/>
                        <stop offset="1" stop-color="#F9C4C3" stop-opacity="0"/>
                        </linearGradient>
                        </defs>
                    </svg>
                </div>

            </section>
            
            <section class="view_vitalSign">
                <div style="margin-bottom: 20px;">
                    <div class="div_icone_vitalSign">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="24" height="24" fill="#8CC5CA"/>
                            <path d="M0 0H24V24H0V0Z" fill="#8CC5CA"/>
                            <rect x="5" y="6" width="13" height="18" fill="#26505C"/>
                            <rect x="10.5715" width="1.85714" height="8.21053" fill="#898E91"/>
                            <g clip-path="url(#clip0_86_22)">
                            <path d="M13.7452 2.16033C13.3795 1.6267 13.2179 1.17285 13.1253 0.902058C13.096 0.816746 12.9988 0.816746 12.9698 0.902058C12.8772 1.17285 12.7156 1.6267 12.35 2.16033C12.121 2.49467 11.8953 2.9841 11.8953 3.46627C11.8953 4.289 12.3941 4.84612 13.0476 4.84612C13.701 4.84612 14.1999 4.28865 14.1999 3.46627C14.1999 2.9651 13.9741 2.49467 13.7452 2.16033Z" fill="#E5322E"/>
                            <path d="M13.3661 3.38923C13.5503 2.972 13.5242 2.56374 13.6699 2.63731C13.8678 2.73782 14.0869 3.25419 14.0048 3.7222C13.9461 4.05585 13.7569 4.2579 13.5158 4.16154C13.3211 4.08382 13.2001 3.76502 13.3661 3.38923Z" fill="#FF6050"/>
                            </g>
                            <ellipse cx="14.5476" cy="20.9474" rx="1.54762" ry="0.947368" fill="#D9D9D9"/>
                            <rect x="11.1904" y="19.5789" width="0.619048" height="3.15789" fill="#D9D9D9"/>
                            <rect x="6.23804" y="9.47369" width="10.5238" height="8.8421" fill="#D9D9D9"/>
                            <rect x="6.85718" y="10.1053" width="9.28571" height="7.57895" fill="#898E91"/>
                            <ellipse cx="8.28102" cy="20.9474" rx="1.54762" ry="0.947368" fill="#D9D9D9"/>
                            <defs>
                            <clipPath id="clip0_86_22">
                            <rect width="3.71429" height="4.42105" fill="white" transform="translate(11.1904 0.631592)"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </div>

                    <p><strong>Glycémie</strong></p>
                </div>

                <div style="margin-bottom: 20px;">
                    <span id="span_glycemie" style="font-size:25px; margin-right:10px;">0</span> mg/dL
                </div>

                <div class="state_health" style="margin-bottom: 20px;">
                    <p>...</p>
                </div>

                <div>
                    <svg viewBox="0 0 98 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.984375 18H4.98438L9.48438 19.5L14.4844 23.5L17.9844 26.5L20.9844 27.5H22.9844L27.4844 26.5L30.9844 23.5L35.4844 19.5L38.9844 16.5L43.4844 13L46.4844 11L50.4844 9L54.9844 7.5H59.4844L63.9844 9L68.4844 11L72.4844 14.5L75.9844 16.5H78.9844L81.9844 14.5L84.9844 11L87.9844 7.5L94.9844 0V45H0.984375V18Z" fill="url(#paint0_linear_135_65)"/>
                        <path d="M1.48438 30.3972L3.98432 30.0859L5.00165 30.0859L7.32471 30.3972L9.94379 31.9077C9.94379 31.9077 11.5029 33.4243 12.5674 34.3164C13.4514 35.0573 14.8978 36.1248 14.8978 36.1248C14.8978 36.1248 16.4717 36.7533 17.5139 37.0365C18.8503 37.3997 19.6233 37.5465 20.999 37.6534C22.0167 37.7324 23.6106 37.6669 23.6106 37.6669L25.6384 37.0785L27.9844 36.1248L29.9844 35L32.4844 33L39.229 27.5682L46.9844 21L49.4844 19.1361L52.4844 18L55.4844 17.4927L58.6198 17.4927L61.9844 18L64.9844 19.1361L67.4844 21L72.9844 25.6886L74.9844 26.2694L77.5247 26.2694L81.0038 25.6886L85.0483 22.1166L87.6449 19.1361L91.1029 14.3638L94.8333 6.00006" stroke="#8CC5CA" stroke-opacity="0.5"/>
                        <defs>
                        <linearGradient id="paint0_linear_135_65" x1="47.9844" y1="0" x2="47.9844" y2="45" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#D0FBFF"/>
                        <stop offset="1" stop-color="#D0FBFF" stop-opacity="0.2"/>
                        </linearGradient>
                        </defs>
                    </svg>
                </div>
            </section>

            <section class="view_vitalSign">
                <div style="margin-bottom: 20px;">
                    <div class="div_icone_vitalSign" style="background-color:#F3DBDC;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M17.032 11.3915C17.0153 10.5333 17.0048 9.6749 17.0005 8.8165C16.5427 8.58746 16.1065 8.31736 15.6975 8.0095C14.926 7.423 14 6.4745 14 5.2245C14 4.1105 14.842 3 16.094 3C16.675 3 17.145 3.232 17.5 3.5785C17.8545 3.232 18.325 3 18.9065 3C20.158 3 21 4.1115 21 5.224C21 6.4355 20.0695 7.3855 19.3055 7.9755C18.8952 8.29022 18.4586 8.56908 18.0005 8.809C18.0035 9.681 18.0175 10.5135 18.0305 11.3015C18.0605 13.029 18.0855 14.5435 17.981 15.794C17.822 17.688 17.3525 19.208 15.9485 20.0305C14.568 20.839 12.528 21.143 10.8385 20.9375C9.9905 20.8345 9.181 20.5975 8.5685 20.1885C8.123 19.891 7.7695 19.4905 7.6035 18.9885C6.565 18.941 5.532 18.7515 4.715 18.4125C3.8325 18.0465 3 17.4125 3 16.42V6.561H3.0015C3.00051 6.54068 3.00001 6.52034 3 6.5C3 5.1195 5.2385 4 8 4C10.7615 4 13 5.1195 13 6.5C13 6.52 12.9995 6.541 12.9985 6.561H13V9.5355C13.833 9.65595 14.5947 10.0725 15.1455 10.7088C15.6964 11.3451 15.9996 12.1586 15.9995 13.0002C15.9994 13.8419 15.6962 14.6553 15.1452 15.2915C14.5942 15.9277 13.8325 16.3442 12.9995 16.4645C12.9765 17.472 12.171 18.1095 11.2825 18.4715C10.5475 18.7705 9.6425 18.9355 8.7175 18.9845C8.8175 19.1185 8.9525 19.2425 9.1245 19.357C9.5595 19.648 10.1995 19.8525 10.9595 19.945C12.485 20.1305 14.293 19.841 15.4435 19.1675C16.399 18.6075 16.831 17.54 16.9845 15.7105C17.085 14.5095 17.061 13.0795 17.032 11.3915ZM11.998 16.4645C11.976 16.8535 11.6615 17.237 10.905 17.545C10.1425 17.8555 9.089 18.0115 8.005 17.9995C7.85157 17.9977 7.6982 17.9925 7.545 17.984V8.99C7.695 8.9965 7.8465 9 7.9995 9C9.635 9 11.0875 8.6075 11.9995 8V9.535C11.1661 9.65484 10.4039 10.071 9.85248 10.7073C9.30106 11.3435 8.99744 12.1572 8.99726 12.9991C8.99707 13.841 9.30035 14.6548 9.85148 15.2913C10.4026 15.9278 11.1647 16.3443 11.998 16.4645ZM12 6.5C12 6.6075 11.887 6.974 11.0885 7.3735C10.3495 7.7425 9.259 8 8 8C6.741 8 5.65 7.7425 4.9115 7.3735C4.113 6.974 4 6.6075 4 6.5C4 6.3925 4.113 6.026 4.9115 5.6265C5.6505 5.2575 6.741 5 8 5C9.259 5 10.35 5.2575 11.0885 5.6265C11.887 6.026 12 6.3925 12 6.5ZM11.75 13.25L12.5 10.75L13.25 13.25L12.5 14.25L11.75 13.25Z" fill="#BC4748"/>
                        </svg>
                    </div>

                    <p><strong>Pression artérielle</strong></p>
                </div>

                <div style="margin-bottom: 20px;">
                    <span id="span_pression" style="font-size:25px; margin-right:10px;">0/0</span> mmHg
                </div>

                <div class="state_health" style="margin-bottom: 20px;">
                    <p style="background-color:#F3DBDC;">...</p>
                </div>

                <div>
                    <svg viewBox="0 0 96 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 24.5L3.5 22L7.5 20L12.5 19H18L22 20H27.5L33.5 19L36 17V13L37.5 9L40.5 6L45 3.5L49.5 2L54 1H58.5L62 3.5L65.5 7L69 10.5L71.5 13L74.5 14L77 13L78.5 9L82 7L87 6L96 0V38H0V24.5Z" fill="url(#paint0_linear_138_103)"/>
                        <path d="M95.5 21L95 19.985L94 18.5L92.5 16.5003L91.5 15.4318L90 14L88 12.0294L86.5 10.657L84 10L82 10.657L80.5 12.0294L79.5 14.5C79.5 14.5 79.5 13.8434 79.5 17.5002C79.5 21.157 76.5 22.2174 76.5 22.2174C75 27.2174 57.3323 4.64106 56 5.00022C17.0497 15.5003 66 21.5002 66 21.5002L67 23.8091L66 27L63.5 29L61 30.5H58H55L52 30L50 29L47.5 28L42.5 23L40 22.2174H37H35L33 23L31 23.8091L29.5 24.837L27 25.5H25H23L20.1939 24.837L18 23L16 22.2174H14.5H12L9 23L7 23.8091L5 24.837L2.5 26.5L1 28" stroke="#E3B2B3"/>
                        <defs>
                        <linearGradient id="paint0_linear_138_103" x1="48" y1="0" x2="48" y2="38" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#F3DBDC"/>
                        <stop offset="1" stop-color="#F3DBDC" stop-opacity="0"/>
                        </linearGradient>
                        </defs>
                    </svg>
                </div>

            </section>
        </section>

        <div class="header_secton_vs" style="margin-top:40px;">
                <h3>Visualisation en temps réel</h3> 

                <div>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.0001 6L8.59009 7.41L13.1701 12L8.59009 16.59L10.0001 18L16.0001 12L10.0001 6Z" fill="black"/>
                    </svg>
                </div>

            <!-- <form method="POST" action="../Controllers/c_graphique.php" enctype="multipart/form-data"> -->
            <form method="POST" action="" enctype="multipart/form-data">
                <select class="champ_select_filter">
                    <option>Filtre en fonction des dates</option>
                    <option>2024-04-1 au 2024-04-12</option>
                </select>

                <input class="btn_submit_filter" type="submit" value="valider">
            </form>
        </div> 
        <hr style="width: 200px;">

        <div id="chart_div" style="width: 100%; height: 500px;"></div>
    </section>
</body>
</html>