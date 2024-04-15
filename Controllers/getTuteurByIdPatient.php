<?php
    include_once "../Configuration/config.php";
    include_once "../Models/tuteur.php";

    function getTuteurByIdPatient($id_patient) {
        return Tuteur :: getTuteurByIdPatient($id_patient);
    }