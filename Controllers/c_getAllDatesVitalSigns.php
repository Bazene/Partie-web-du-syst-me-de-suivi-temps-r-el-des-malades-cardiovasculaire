<?php
    include_once "../Configuration/config.php";
    include_once "../Models/VitalSigns.php";
    header('Content-Type: application/json');

    $allDates = VitalSigns :: getAllDatesAvailable();
    
    echo json_encode($allDates);
?>