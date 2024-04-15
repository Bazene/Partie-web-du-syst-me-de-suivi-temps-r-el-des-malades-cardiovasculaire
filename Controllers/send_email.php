<?php
    include_once "../Configuration/config.php";
    include_once "../Models/notifications.php";
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

    // Récupérer les données JSON envoyées depuis le client
    $data = json_decode(file_get_contents('php://input'), true);

    $id_patient = $data['id_patient'];
    $name_vital_sign = $data['name_vital_sign'];
    $value_vital_sign = $data['value_vital_sign'];
    $date = $data['not_date'];
    $hour = $data['not_hour'];

    $to = 'bazenesergeamos0@gmail.com';
    $from = 'bazeneserge2@gmail.com';
    $name = 'Moyo Safi';
    $subject = 'Health-information';
    $error = "";

    // $msg = 'Etat de santé : '.$name_vital_sign.' : '.$value_vital_sign.'. à '.$hour.'. Le :'.$date;
    $msg = 'Etat de santé : ';

    $mail = new PHPMailer(true);
    try {
        //Server SMTP settings  
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = 'joqbuzxvxypdsfyl'; //joqbuzxvxypdsfyl
        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $mail->Port = 465;
        
        // Recipients
        $mail->setFrom($from, $name);
        $mail->addAddress($to);   
        
        // content
        $mail->isHTML(true); 
        $mail->Subject = $subject;
        $mail->Body = $msg;
        
        if($mail->send()) {
            $error = "Thank you !! your email is sent.";
        } else {
            $error = "Please try later, Error Occured while processing...";
        }
    
    } catch (Exception $e) {
        "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        $error = $mail->ErrorInfo;
    }

    if($error === "Thank you !! your email is sent.") {
        // Répondre avec un statut de succès (code 200)
        http_response_code(200);
        echo json_encode(['message' => 'E-mail envoyé avec succès.']);

    } elseif($error === "Please try later, Error Occured while processing...") {
        // En cas d'erreur d'envoi du mail
        http_response_code(500);
        echo json_encode(['error' => 'Erreur lors de l\'envoi de l\'e-mail.']);
    } else {
        // En cas d'erreur non comprise
        http_response_code(500);
        echo json_encode(['error' => $error]);   
    }
?>