
<?php
    session_start();

    include_once "../Configuration/config.php";
    include_once "../Models/VitalSigns.php";

    $inputJSON = file_get_contents('php://input'); // Récupérer le contenu du corps de la requête
    $inputData = json_decode($inputJSON, true); // Décoder les données JSON en tableau associatif

    $jsonArray1 = array();

    if($inputData !== null) { // Vérifier si les données ont été correctement décodées
        $date1 = $inputData['date1']; // Accéder aux données envoyées depuis JavaScript
        $date2 = $inputData['date2'];

        if($date1 != "aaaa-mm-jj" && $date2 !="aaaa-mm-jj") {
            
            $dateFormat1 = '';
            $dateFormat2 = '';

            if($date1 <= $date2) {$dateFormat2 = $date2; $dateFormat1 = $date1;}
            else if($date1 >= $date2) {$dateFormat2 = $date1; $dateFormat1 = $date2;}

            if(!empty($_SESSION['id_patient_for_vitalSign'])) {
                $id_patient = $_SESSION['id_patient_for_vitalSign'];

                $allVitalSingsFilter = VitalSigns :: getAllVitalSignsFilterByDate($dateFormat1, $dateFormat2, $id_patient);

                if(!empty($allVitalSingsFilter)) {
                    foreach ($allVitalSingsFilter as $vitalSign) {
                        $jsonArray1[] = $vitalSign->objectToJson();
                    }

                    $_SESSION['jsonArray1'] = $jsonArray1;
                }

                if(isset($_SESSION['jsonArray1'])) {
                    echo json_encode(['success' => true]); // Répondre avec un message JSON de succès
                } else {
                    http_response_code(400); // Bad Request
                    echo json_encode(['error' => 'Données JSON invalides']);
                }
            }
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Données JSON invalides']);
        }
    } else {
        // Répondre avec un message d'erreur si les données JSON sont invalides
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Données JSON invalides']);
    }        
?>