<?php

    include_once "../Configuration/config.php";
    include_once "../Models/patient.php";
    include_once "../Models/doctor.php";
    include_once "../Models/tuteur.php";

    function countAllPatients() {
        $patients = Patient :: getAllPatients();
        return (!empty($patients)) ? count($patients) : 0;
    }

    function countAllPatientsFollow() {
        $idDoctorCenter = Doctor :: getIdDoctorCenter();
        $patients = Patient :: getAllPatientsFollow($idDoctorCenter);
        return (!empty($patients)) ? count($patients) : 0;
    }

    function getAllPatientsFollowingByAllDoctors() {
        $idDoctorCenter = Doctor :: getIdDoctorCenter();
        $patients = Patient :: getAllPatientsFollow($idDoctorCenter);
        return $patients;
    }

    function countAllTuteurs() {
        $tuteurs = Tuteur :: getAllTuteurs();
        return (!empty($tuteurs)) ? count($tuteurs) : 0;
    }

    function countgetAllDoctors() {
        $doctors = Doctor :: getAllDoctors();
        return (!empty($doctors)) ? count($doctors) : 0;
    }