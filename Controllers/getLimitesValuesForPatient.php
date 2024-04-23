<?php
    include_once "../Configuration/config.php";
    include_once "../Models/limitesvitalsignspatient.php";
    
    function getLimitesValuesForPatient($id_patient) {
        $limitesVital = Limitesvitalsignspatient::getLimitesForPatient($id_patient);
        return $limitesVital;
    }