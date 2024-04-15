<?php

    include_once "../Configuration/config.php";
    include_once "../Models/patient.php";

    function countAllPatients() {
        $patients = Patient :: getAllPatients();
        return (!empty($patients)) ? count($patients) : 0;
    }

    function countPatientsFollow($idDoctor) {
        $patients = Patient :: getAllPatientsFollowingByDoctor($idDoctor);
        return (!empty($patients)) ? count($patients) : 0;
    }

    function countPatientArchived($idDoctor) {
        $patients = Patient :: getAllPatientsArchivedByDoctor($idDoctor);
        return (!empty($patients)) ? count($patients) : 0;
    }

    function getAllPatientsFollowingByDoctor($idDoctor) {
        return Patient :: getAllPatientsFollowingByDoctor($idDoctor);
    }

    function getAllPatientsArchivedByDoctor($idDoctor) {
        return Patient :: getAllPatientsArchivedByDoctor($idDoctor);
    }