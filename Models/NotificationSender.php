<?php
    // Include des dépendances et déclaration de l'espace de noms
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../PHPMailer/src/Exception.php';
    require '../../PHPMailer/src/PHPMailer.php';
    require '../../PHPMailer/src/SMTP.php';

    class NotificationSender {
        private $from;
        private $name;
        private $mail;
        private $subject;
    
        public function __construct() {
            $this->from = 'bazeneserge2@gmail.com';
            $this->name = 'Moyo Safi';
            $this->mail = new PHPMailer(true); // Création d'une nouvelle instance de PHPMailer
            $this->subject = 'Health-information';
    
            // Configuration des paramètres SMTP
            $this->mail->isSMTP();
            $this->mail->Host = 'smtp.gmail.com';
            $this->mail->SMTPAuth = true;
            $this->mail->Username = $this->from;
            $this->mail->Password = 'joqbuzxvxypdsfyl'; // Remplacez par votre mot de passe SMTP
            $this->mail->SMTPSecure = 'ssl';
            $this->mail->Port = 465;
        }    

        // function that send mail
        public function sendNotification($name_vital_sign, $value_vital_sign, $hour, $date, $to) {
            $error = false;

            // Construction du message de l'e-mail
            $msg = 'Etat de santé : '.$name_vital_sign.' : '.$value_vital_sign.'. à '.$hour.'. Le :'.$date;
            
            try {
                // Définition des destinataires et du contenu de l'e-mail
                $this->mail->setFrom($this->from, $this->name);
                $this->mail->addAddress($to);
                $this->mail->isHTML(true);
                $this->mail->Subject = $this->subject;
                $this->mail->Body = $msg;

                // Envoi de l'e-mail
                if ($this->mail->send()) {
                    $error = true;
                } else {
                    $error = false;
                }

            } catch (Exception $e) {
                $error = false;
            }

            return $error;
        }
    }
?>
