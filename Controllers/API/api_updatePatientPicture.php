<?php

include_once "../../Configuration/config.php";
include_once "../../Models/patient.php";

header("Content-Type: application/json");    

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données JSON envoyées dans la requête POST
    // $data = json_decode(file_get_contents('php://input'), true);

    // Traiter les données (insérer dans la base de données, etc.)
    try {
        // $token = $data['patient_role'];
        // $patient_picture = $data['patient_picture'];

        $token = $_POST['token']; // Récupérez le token
        $image = $_FILES['image']; // Récupérez les détails de l'image
        $imageBytes = file_get_contents($image['tmp_name']); // Récupérez les bytes de l'image
        
        $uploadDirectory = '../../images/'; // Définissez le dossier de destination pour les images
        $fileName = uniqid() . '.png'; // Générez un nom de fichier unique pour éviter les conflits
        
        $filePath = $uploadDirectory. $fileName; // Créez le chemin complet du fichier de destination

        if (file_put_contents($filePath, $imageBytes)) { // Écrivez les bytes de l'image dans le fichier
            // L'écriture des bytes de l'image dans le fichier a réussi        

            $imagePath = '../images/'.$fileName;
            if(Patient :: updatePatientPicture($token, $imagePath)) {
                $responseData = array(
                    'success' => true,
                    'patient_role' => $token,
                    'patient_picture' => base64_encode($imageBytes) // encoder les bytes en base64 pour faciliter le transfert
                );

                echo json_encode($responseData);
            }
            else {
                echo json_encode(["success" => false, "error" => "Echec du mise à jour"]);
            }
        } else {
            // L'écriture des bytes de l'image dans le fichier a échoué
            echo json_encode(["success" => false, "error" => "Failed to write image bytes to file"]);
        }
    } 
    catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }

} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}