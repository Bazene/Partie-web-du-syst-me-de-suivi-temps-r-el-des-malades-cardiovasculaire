<?php
    include_once "../Configuration/config.php";
    include_once "../Models/doctor.php";

    function getDoctorsSearch() {
        if($_POST) {
            $doctor_search = $_POST['doctor_search'];
            $doctor_search_result = Doctor :: doctor_search($doctor_search);
            return $doctor_search_result;
        } else {
            return false;
        }
    }