<?php
session_start();

include_once "../Configuration/config.php";
include_once "../Models/admin.php";
include_once "../Models/doctor.php";
include_once "../Models/tuteur.php";

$user_name = $_POST['user_name'];
$password_key = $_POST['password_key'];

$authentification_result_admin = Admin :: authentification($user_name, $password_key);
$authentification_result_doctor = Doctor :: authentification($user_name, $password_key);
$authentification_result_tuteur = Tuteur :: authentification($user_name, $password_key);


if($authentification_result_admin) {
    unset($_SESSION['erreurs_aut']);
    $_SESSION['connected'] = "admin";
    header("Location:../Views/home.php");
} 

elseif($authentification_result_doctor) {
    unset($_SESSION['erreurs_aut']);
    $_SESSION['connected'] = "doctor";
    header("Location:../Views/home.php");

} 

elseif($authentification_result_tuteur) {
    unset($_SESSION['erreurs_aut']);
    $_SESSION['connected'] = "tuteur";
    header("Location:../Views/home.php");
}

else {
    $_SESSION['erreurs_aut'] ="Mot de passe ou nom d'utilisateur incorrect";
    header("Location:../Views/authentification.php");
}