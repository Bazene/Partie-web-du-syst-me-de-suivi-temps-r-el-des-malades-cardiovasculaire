<?php 
    include_once "../Configuration/config.php";
    include_once "../Models/tuteur.php";

    if(isset($_POST)) {
        $id_patient = $_POST['id_patient'];
        $tuteur_name = $_POST['tuteur_name'];
        $tuteur_postname = $_POST['tuteur_postname'];
        $tuteur_surname = $_POST['tuteur_surname'];
        $tuteur_gender = $_POST['tuteur_gender'];
        $tuteur_mail = $_POST['tuteur_mail'];
        $tuteur_phone_number = $_POST['tuteur_phone_number'];
        $tuteur_password = "1234";
        $tuteur_date_created = date("d-m-y"); // actuel date
        $tuteur_role = "tuteur";
        $relationship_type = $_POST['relationship_type'];

        // we verify the size of the picture
        $tuteur = new Tuteur($id_patient, $tuteur_name, $tuteur_postname, $tuteur_surname, $tuteur_gender, $tuteur_mail, $tuteur_phone_number, $tuteur_password, $tuteur_date_created , $tuteur_role, $relationship_type);

        if($tuteur->createtuteur()) {
            header("Location:../views/suivi.php");
        }
    } 