<?php include_once "../includes/redurection_to_log_in.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>

    <?php include_once "../includes/links.php" ;?>

    <link rel="stylesheet" href="../Styles/homeAdmin_style.css">
</head>

<body>
    <?php include_once "../Controllers/getPatientsInformationForAdmin.php" ;?>
    <?php include_once "../includes/nav_bar.php"; ?>

    <section class="right_part">
        <section class="dashboards_section">
            <h2 style="margin-bottom: 10px; width: 86px; font-size:16px; color:#1F57EC; padding:10px; background-color: #D7E5FF;">Dashboard</h2>

            <div class="stats_dashbord" style="display: flex; flex-direction: row;">
                <div class="patient_follow">
                    <a href="../Views/patients.php" style="text-decoration: none; color:black;">
                        <div style="display: flex; flex-direction: row; justify-content: flex-start; align-items: center; margin-bottom: 20px;">
                            <div style="border-radius: 100%;  padding:10px ; width:20px; height: 20px; background-color: white; display: block; position: center;">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5.5C12.9283 5.5 13.8185 5.86875 14.4749 6.52513C15.1313 7.1815 15.5 8.07174 15.5 9C15.5 9.92826 15.1313 10.8185 14.4749 11.4749C13.8185 12.1313 12.9283 12.5 12 12.5C11.0717 12.5 10.1815 12.1313 9.52513 11.4749C8.86875 10.8185 8.5 9.92826 8.5 9C8.5 8.07174 8.86875 7.1815 9.52513 6.52513C10.1815 5.86875 11.0717 5.5 12 5.5ZM5 8C5.56 8 6.08 8.15 6.53 8.42C6.38 9.85 6.8 11.27 7.66 12.38C7.16 13.34 6.16 14 5 14C4.20435 14 3.44129 13.6839 2.87868 13.1213C2.31607 12.5587 2 11.7956 2 11C2 10.2044 2.31607 9.44129 2.87868 8.87868C3.44129 8.31607 4.20435 8 5 8ZM19 8C19.7956 8 20.5587 8.31607 21.1213 8.87868C21.6839 9.44129 22 10.2044 22 11C22 11.7956 21.6839 12.5587 21.1213 13.1213C20.5587 13.6839 19.7956 14 19 14C17.84 14 16.84 13.34 16.34 12.38C17.2119 11.2544 17.6166 9.8362 17.47 8.42C17.92 8.15 18.44 8 19 8ZM5.5 18.25C5.5 16.18 8.41 14.5 12 14.5C15.59 14.5 18.5 16.18 18.5 18.25V20H5.5V18.25ZM0 20V18.5C0 17.11 1.89 15.94 4.45 15.6C3.86 16.28 3.5 17.22 3.5 18.25V20H0ZM24 20H20.5V18.25C20.5 17.22 20.14 16.28 19.55 15.6C22.11 15.94 24 17.11 24 18.5V20Z" fill="black"/>
                                </svg>
                            </div>

                            <div>
                                <h3 style="margin-left: 10px; font-size: 16px; color:black;">Total patients</h3>
                                <span style="margin-left: 10px; font-size: 16px; color:black;">dans le système</span>
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: row; justify-content: flex-start; align-items: center;">
                            <strong> <span style="font-size:20px; margin-right:5px; margin-left: 5px; color:black;">
                                <?php  
                                    echo countAllPatients();
                                ?>
                            </span> </strong> <br> 
                        </div>
                    </a>
                </div>
            
                <div class="patient_follow" style="margin-left: 20px; background:linear-gradient(to right, #1FED8D, #1FED8D, #1FED8D);">
                        <div style="display: flex; flex-direction: row; justify-content: flex-start; align-items: center; margin-bottom: 20px;">
                            <div style="border-radius: 100%;  padding:10px ; width:20px; height: 20px; background-color: white; display: block; position: center;">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5.5C12.9283 5.5 13.8185 5.86875 14.4749 6.52513C15.1313 7.1815 15.5 8.07174 15.5 9C15.5 9.92826 15.1313 10.8185 14.4749 11.4749C13.8185 12.1313 12.9283 12.5 12 12.5C11.0717 12.5 10.1815 12.1313 9.52513 11.4749C8.86875 10.8185 8.5 9.92826 8.5 9C8.5 8.07174 8.86875 7.1815 9.52513 6.52513C10.1815 5.86875 11.0717 5.5 12 5.5ZM5 8C5.56 8 6.08 8.15 6.53 8.42C6.38 9.85 6.8 11.27 7.66 12.38C7.16 13.34 6.16 14 5 14C4.20435 14 3.44129 13.6839 2.87868 13.1213C2.31607 12.5587 2 11.7956 2 11C2 10.2044 2.31607 9.44129 2.87868 8.87868C3.44129 8.31607 4.20435 8 5 8ZM19 8C19.7956 8 20.5587 8.31607 21.1213 8.87868C21.6839 9.44129 22 10.2044 22 11C22 11.7956 21.6839 12.5587 21.1213 13.1213C20.5587 13.6839 19.7956 14 19 14C17.84 14 16.84 13.34 16.34 12.38C17.2119 11.2544 17.6166 9.8362 17.47 8.42C17.92 8.15 18.44 8 19 8ZM5.5 18.25C5.5 16.18 8.41 14.5 12 14.5C15.59 14.5 18.5 16.18 18.5 18.25V20H5.5V18.25ZM0 20V18.5C0 17.11 1.89 15.94 4.45 15.6C3.86 16.28 3.5 17.22 3.5 18.25V20H0ZM24 20H20.5V18.25C20.5 17.22 20.14 16.28 19.55 15.6C22.11 15.94 24 17.11 24 18.5V20Z" fill="black"/>
                                </svg>
                            </div>

                            <div>
                                <h3 style="margin-left: 10px; font-size: 16px; color:black;">Total patients</h3>
                                <span style="margin-left: 10px; font-size: 16px; color:black;">en cours de suivi</span>
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: row; justify-content: flex-start; align-items: center;">
                            <strong> <span style="font-size:20px; margin-right:5px; margin-left: 5px; color:black;">
                                <?php    
                                    echo countAllPatientsFollow();
                                ?>
                            </span> </strong> <br>
                        </div>
                </div>
            
                <div class="patient_follow" style="margin-left:20px; background:linear-gradient(to right, #DF1FED, #DF1FED, #DF1FED);">
                    <a href="../Views/tuteur.php" style="text-decoration: none; color:black;">
                        <div style="display: flex; flex-direction: row; justify-content: flex-start; align-items: center; margin-bottom: 20px;">
                            <div style="border-radius: 100%;  padding:10px ; width:20px; height: 20px; background-color: white; display: block; position: center;">
                                <svg viewBox="0 0 60 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.8571 17.5C12.8571 22.1413 14.6633 26.5925 17.8782 29.8744C21.0931 33.1563 25.4534 35 30 35C34.5466 35 38.9069 33.1563 42.1218 29.8744C45.3367 26.5925 47.1429 22.1413 47.1429 17.5C47.1429 12.8587 45.3367 8.40752 42.1218 5.12563C38.9069 1.84374 34.5466 0 30 0C25.4534 0 21.0931 1.84374 17.8782 5.12563C14.6633 8.40752 12.8571 12.8587 12.8571 17.5ZM25.5134 44.8711L28.0045 49.1094L23.5446 66.0488L18.7232 45.9648C18.4554 44.8574 17.4107 44.1328 16.3259 44.4199C6.95089 46.8125 0 55.4805 0 65.8027C0 68.127 1.84821 70 4.11161 70H55.8884C58.1652 70 60 68.1133 60 65.8027C60 55.4805 53.0491 46.8125 43.6741 44.4199C42.5893 44.1465 41.5446 44.8711 41.2768 45.9648L36.4554 66.0488L31.9955 49.1094L34.4866 44.8711C35.3438 43.4082 34.3125 41.5625 32.6518 41.5625H27.3616C25.7009 41.5625 24.6696 43.4219 25.5268 44.8711H25.5134Z" fill="black"/>
                                </svg>
                            </div>

                            <div>
                                <h3 style="margin-left: 10px; font-size: 16px; color:black;">Total tuteurs</h3>
                                <span style="margin-left: 10px; font-size: 16px; color:black;">dans le système</span>
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: row; justify-content: flex-start; align-items: center;">
                            <strong> <span style="font-size:20px; margin-right:5px; margin-left: 5px; color:black;">
                                <?php
                                    echo countAllTuteurs();
                                ?>
                            </span> </strong> <br>
                        </div>
                    </a>
                </div>
                
                <div class="patient_follow" style="margin-left:20px; background:linear-gradient(to right, #2E53DD, #2E53DD, #2E53DD) ;">
                    <a href="../Views/doctor.php" style="text-decoration: none; color:white;">
                        <div style="display: flex; flex-direction: row; justify-content: flex-start; align-items: center; margin-bottom: 20px;">
                            <div style="border-radius: 100%;  padding:10px ; width:20px; height: 20px; background-color: white; display: block; position: center;">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_116_28)">
                                    <path d="M12 12C15.7875 12 18.8571 9.31406 18.8571 6C18.8571 2.68594 15.7875 0 12 0C8.2125 0 5.14286 2.68594 5.14286 6C5.14286 9.31406 8.2125 12 12 12ZM5.57143 19.875C5.57143 20.4984 6.14464 21 6.85714 21C7.56964 21 8.14286 20.4984 8.14286 19.875C8.14286 19.2516 7.56964 18.75 6.85714 18.75C6.14464 18.75 5.57143 19.2516 5.57143 19.875ZM17.1429 13.5281V15.825C19.0982 16.1719 20.5714 17.6906 20.5714 19.5V21.4547C20.5714 21.8109 20.2821 22.1203 19.8804 22.1906L18.1554 22.4906C17.925 22.5328 17.7 22.4016 17.6518 22.1953L17.4857 21.4594C17.4375 21.2578 17.5875 21.0562 17.8232 21.0187L18.8571 20.8359V19.5C18.8571 16.5563 13.7143 16.4484 13.7143 19.5891V20.8406L14.7482 21.0234C14.9786 21.0656 15.1286 21.2625 15.0857 21.4641L14.9196 22.2C14.8714 22.4016 14.6464 22.5328 14.4161 22.4953L12.7446 22.2984C12.3214 22.2469 12.0054 21.9328 12.0054 21.5531V19.5C12.0054 17.6906 13.4786 16.1766 15.4339 15.825V13.7062C15.3161 13.7391 15.1982 13.7578 15.0804 13.7953C14.1161 14.0906 13.0821 14.2547 12.0054 14.2547C10.9286 14.2547 9.89464 14.0906 8.93036 13.7953C8.53393 13.6734 8.13214 13.5984 7.71964 13.5516V17.3766C8.95714 17.7 9.8625 18.6938 9.8625 19.8797C9.8625 21.3281 8.51786 22.5047 6.8625 22.5047C5.20714 22.5047 3.8625 21.3281 3.8625 19.8797C3.8625 18.6938 4.76786 17.7 6.00536 17.3766V13.6078C2.59821 14.1094 0 16.6781 0 19.8V21.9C0 23.0578 1.07679 24 2.4 24H21.6C22.9232 24 24 23.0578 24 21.9V19.8C24 16.425 20.9571 13.6922 17.1429 13.5281Z" fill="black"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_116_28">
                                    <rect width="24" height="24" fill="white"/>
                                    </clipPath>
                                    </defs>
                                </svg>
                            </div>

                            <div>
                                <h3 style="margin-left: 10px; font-size: 18px;">Total médecin</h3>
                                <span style="margin-left: 10px; font-size: 16px;">dans le système</span>
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: row; justify-content: flex-start; align-items: center;">
                            <span style="font-size:16px; margin-right:5px; margin-left: 5px;">
                                <?php 
                                    echo countgetAllDoctors();
                                ?>
                            </span> <br>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <section class="header_patient_follow_section">
            <h2 style="margin-bottom: 10px; font-size:20px; color:black; padding:10px;">Patients en cours de suivi</h2>

            <!-- <form>
                <input type="text" class="searching_input" placeholder="Rechercher un patient encours de suivi">
                <input type="submit" class="btn_search" value="recherche">
            </form> -->
        </section> <hr style ="width : 150px">

        <section class="display_users_section">

            <?php 
                if(($_SESSION['connected']) == "admin") {
                    $patientsFollowing = getAllPatientsFollowingByAllDoctors();

                    if(!empty($patientsFollowing)) {
                        foreach($patientsFollowing as $patient) {
                            if($patient->getPatientPicture() == "") $patientPicture = '../images/default_image.png'; 
                            else  $patientPicture = $patient->getPatientPicture();

                            echo 
                            '<section class="my_patients">
                                <div class="stroke_section">
                                    <div class="image">
                                        <img src="'.$patientPicture.'"/>
                                    </div>
                
                                    <div class="info">
                                        <div style="text-align:center; color:black;">
                                            <strong style="font-size:16px; margin-bottom:5px;">'.$patient->getPatientName().' '.$patient->getPatientPostName().'</strong> <br>
                                            <span style="font-size:14px; color:gray;">'.$patient->getPatientPhoneNumber().'</span>
                                        </div> 
                                        
                                        <div class="btn_follow_patient" style = "background:gray; cursor:no-drop;">
                                            suivre
                                        </div>
                                    </div>
                                </div>
                            </section>';

                        }

                    } else {
                        echo 
                            '<div class="no_result_classe">
                                Aucun patient n\'est suivi par vous
                            </div>
                            <div style="margin-bottom:20px;"> </div>
                            ';
                    }
                }
            ?>

        </section>
    </section>
</body>

</html>