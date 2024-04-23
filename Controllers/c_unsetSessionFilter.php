
<?php
    session_start();

    $inputJSON = file_get_contents('php://input'); // Récupérer le contenu du corps de la requête

    $inputData = json_decode($inputJSON, true); // Décoder les données JSON en tableau associatif

    if ($inputData !== null) { // Vérifier si les données ont été correctement décodées
        $yesValue = $inputData['yes']; // Accéder aux données envoyées depuis JavaScript
        
        unset($_SESSION['jsonArray1']); 
        echo json_encode(['success' => true]); // Répondre avec un message JSON de succès
    } else {
        // Répondre avec un message d'erreur si les données JSON sont invalides
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Données JSON invalides']);
    }
?>
