<?php 
    include_once "../Configuration/config.php";
    include_once "../Models/doctor.php";

    if(isset($_POST)) {
        $doctor_name = $_POST['doctor_name'];
        $doctor_postname = $_POST['doctor_postname'];
        $doctor_surname = $_POST['doctor_surname'];
        $doctor_gender = $_POST['doctor_gender'];
        $doctor_mail = $_POST['doctor_mail'];
        $doctor_phone_number = $_POST['doctor_phone_number'];
        $doctor_speciality = $_POST['doctor_speciality'];
        $doctor_hospital = $_POST['service_hospital'];
        $doctor_password = "1234";

        $doctor_date_created = date("d-m-y"); // actuel date
        $doctor_role = "doctor";

        $doctor_picture = $_FILES['doctor_picture'];

        // we verify the size of the picture
        if($doctor_picture['size'] <= 5000000) {
            $allowdExtentions = array('jpg', 'png', 'jpeg', 'JPG', 'PNG', 'JPEG');
            $fileInfo = pathinfo($doctor_picture['name']);
            $extension = $fileInfo['extension'];

            // we verify if the extension is allowed
            if(in_array($extension, $allowdExtentions)) {
                $tempFolder = $doctor_picture['tmp_name'];
                $fileName = basename($doctor_picture['name']);
                $destinationFolder = '../images/'.$fileName;

                $fileNameDb = '../images/'.$fileName;
                
                // we verify if the picture is moved in the destination file
                if(move_uploaded_file($tempFolder, $destinationFolder)) {
                    $doctor = new Doctor($doctor_name, $doctor_postname, $doctor_surname, $doctor_gender, $doctor_mail, $doctor_phone_number, $doctor_password, $fileNameDb ,$doctor_date_created, $doctor_speciality, $doctor_hospital, $doctor_role);

                    if($doctor->createDoctor()) {
                        header("Location:../views/doctor.php");
                    }
                } else {
                    header("Location:../views/doctor.php");
                    $_SESSION['image'] = "l'image n'est pas téléchargée";
                    echo "l'image n'est pas téléchargée";
                }

            } else {
                header("Location:../views/doctor.php");
                $_SESSION['image'] = "le type de l'image n'est pas prise en charge";
                echo 'le type de l\'image n\'est pas prise en charge';
            }

        } else {
            header("Location:../views/doctor.php");
            $_SESSION['image'] = "le fichier est trop large";
            echo "le fichier est trop large";
        }
    }