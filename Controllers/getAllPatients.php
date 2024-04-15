<?php
    include_once "../Configuration/config.php";
    include_once "../Models/patient.php";
    include_once "../Models/doctor.php";

    function getAllPatients() {
        return Patient :: getAllPatients();
    }

    function getPatientsSearch() {
        if($_POST) {
            $patient_search = $_POST['patient_search'];
            $patient_search_result = Patient :: patient_search($patient_search);
            return $patient_search_result;
        } else {
            return false;
        }
    }

    function getIdDoctorCenter() {
        return Doctor :: getIdDoctorCenter();
    }