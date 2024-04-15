<?php
    include_once "../Configuration/config.php";
    include_once "../Models/doctor.php";
    include_once "../Models/tuteur.php";

    if(isset($_POST)) {
        $user_picture = $_FILES['user_picture'];
        $id_user = $_POST['id_user'];
        $user_concerned = $_POST['user_concerned'];

         // we verify the size of the picture
        if($user_picture['size']<=10000000) {
            $allowdExtentions = array('jpg', 'png', 'jpeg', 'JPG', 'PNG', 'JPEG');
            $fileInfo = pathinfo($user_picture['name']);
            $extension = $fileInfo['extension'];

            // we verify if the extension is allowed
            if(in_array($extension, $allowdExtentions)) {
                $tempFolder = $user_picture['tmp_name'];
                $fileName = basename($user_picture['name']);
                $destinationFolder = '../images/'.$fileName;
                $fileNameDb = '../images/'.$fileName;
                
                // we verify if the picture is moved in the destination file
                if(move_uploaded_file($tempFolder, $destinationFolder)) {
                    if($user_concerned === "tuteur") {
                        if(Tuteur :: updateTuteurPicture($id_user, $fileNameDb)) {
                            header("Location:../Views/parametres.php");
                            unset($_SESSION['image']);
                        }
                    } 
                    elseif ($user_concerned === "doctor") {
                        if(Doctor :: updateDoctorPicture($id_user, $fileNameDb)) {
                            header("Location:../Views/parametres.php");
                            unset($_SESSION['image']);
                        }
                    }

                } else {
                    header("Location:../Views/parametres.php");
                    $_SESSION['image'] = "l'image n'est pas téléchargée";
                }

            } else {
                header("Location:../Views/parametres.php");
                $_SESSION['image'] = "le type de l'image n'est pas prise en charge";
            }

        } else {
            header("Location:../Views/parametres.php");
            $_SESSION['image'] = "le fichier est trop large";
        }

    }