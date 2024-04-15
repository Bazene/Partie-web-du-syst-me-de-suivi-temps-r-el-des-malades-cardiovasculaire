<?php

    include_once "../Configuration/config.php";
    include_once "../Models/doctor.php";

    function getAllDoctors() {
        return Doctor ::getAllDoctors();
    }

    function getDoctorById($id_doctor) {
        return Doctor :: getDoctorById($id_doctor);
    }