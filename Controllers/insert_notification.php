<?php
    include_once "../Configuration/config.php";
    include_once "../Models/notifications.php";

    // Récupérer les données JSON envoyées depuis le client
    $data = json_decode(file_get_contents('php://input'), true);
    $active = 0;

    $new_notification = new Notifications($data['id_patient'], $data['not_content'], $data['not_date'], $data['not_hour'], $active);

    if($new_notification->createNotification()) {
        // Répondre avec un statut de succès (code 200)
        http_response_code(200);
        echo json_encode(['message' => 'Données insérées avec succès dans la table.']);

    } else {
        // En cas d'erreur de connexion ou d'insertion
        http_response_code(500);
        echo json_encode(['error' => 'Erreur lors de l\'insertion des données dans la table.']);
    }
?>