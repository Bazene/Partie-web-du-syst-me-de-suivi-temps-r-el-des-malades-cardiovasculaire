<?php

    include_once "../Configuration/config.php";
    include_once "../Models/doctor.php";
    include_once "../Models/tuteur.php";

    if(isset($_POST)) {
        $user_name = $_POST['user_name'];
        $user_postname = $_POST['user_postname'];
        $user_surname = $_POST['user_surname'];
        $user_phone_number = $_POST['user_phone_number'];
        $id_user = $_POST['id_user'];
        $user_concerned = $_POST['user_concerned'];

        if($user_concerned === "tuteur") {
            if(Tuteur :: updateTuteur($id_user, $user_name, $user_postname, $user_surname, $user_phone_number)) {
                header("Location:../Views/parametres.php");
            }

        } elseif($user_concerned === "doctor") {
            if(Doctor :: updateDoctor($id_user, $user_name, $user_postname, $user_surname, $user_phone_number)) {
                header("Location:../Views/parametres.php");
            }
        } else {
            header("Location:../Views/parametres.php");
        }

    } else {
        header("Location:../Views/parametres.php");
    }