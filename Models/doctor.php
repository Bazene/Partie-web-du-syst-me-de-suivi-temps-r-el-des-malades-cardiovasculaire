<?php

class Doctor {
    private $doctor_name;
    private $doctor_postname;
    private $doctor_surname;
    private $doctor_gender;
    private $doctor_mail;
    private $doctor_phone_number;
    private $doctor_password;
    private $doctor_picture;
    private $doctor_date_created;
    private $doctor_speciality;
    private $doctor_hospital;
    private $doctor_role;

    // CONSTRUCT
    public function __construct($doctor_name, $doctor_postname, $doctor_surname, $doctor_gender, $doctor_mail, $doctor_phone_number, $doctor_password, $doctor_picture, $doctor_date_created, $doctor_speciality, $doctor_hospital, $doctor_role) {
        $this->doctor_name = $doctor_name;
        $this->doctor_postname = $doctor_postname;
        $this->doctor_surname = $doctor_surname;
        $this->doctor_gender = $doctor_gender;
        $this->doctor_mail = $doctor_mail;
        $this->doctor_phone_number = $doctor_phone_number;
        $this->doctor_password = $doctor_password;
        $this->doctor_picture = $doctor_picture;
        $this->doctor_date_created = $doctor_date_created;
        $this->doctor_speciality = $doctor_speciality;
        $this->doctor_hospital = $doctor_hospital;
        $this->doctor_role = $doctor_role;
    }

    // INSERT DOCTOR
    public function createDoctor() {
        global $db;

        $query = 'INSERT INTO doctor(doctor_name, doctor_postname, doctor_surname, doctor_gender, doctor_mail, doctor_phone_number, doctor_password, doctor_picture, doctor_date_created, doctor_speciality, doctor_hospital, doctor_role) VALUES(:doctor_name, :doctor_postname, :doctor_surname, :doctor_gender, :doctor_mail, :doctor_phone_number, :doctor_password, :doctor_picture, :doctor_date_created, :doctor_speciality, :doctor_hospital, :doctor_role)';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':doctor_name' => $this->doctor_name, 
            ':doctor_postname' => $this->doctor_postname, 
            ':doctor_surname' => $this->doctor_surname, 
            ':doctor_gender' => $this->doctor_gender, 
            ':doctor_mail' => $this->doctor_mail, 
            ':doctor_phone_number' => $this->doctor_phone_number, 
            ':doctor_picture' => $this->doctor_picture,
            ':doctor_password' => $this->doctor_password, 
            ':doctor_date_created' => $this->doctor_date_created, 
            ':doctor_speciality' => $this->doctor_speciality, 
            ':doctor_hospital' => $this->doctor_hospital,
            ':doctor_role' => $this->doctor_role    
        ]);

        return $execution ? true : false;
    }

     // AUTHENTIFICATION FONCTION FOR A DONCTER
    static function authentification($DOCTOR_NAME, $DOCTOR_PASSWORD) {
        global $db;

        $query = 'SELECT * FROM doctor WHERE doctor_name = :doctor_name AND doctor_password = :doctor_password';
        $preparequery = $db->prepare($query);
        $execution = $preparequery->execute([
            ':doctor_name' => $DOCTOR_NAME,
            ':doctor_password' => $DOCTOR_PASSWORD
        ]);

        if($execution) {
            if($data = $preparequery->fetch()) {
                return $data['id'];
            } else return null;
        } else return null;
    }

    // GET DOCTOR BY ID
    static function getDoctorById($ID_DOCTOR) {
        global $db;

        $query = 'SELECT * FROM doctor WHERE id = :id';
        $preparequery = $db->prepare($query);
        $execution = $preparequery->execute([
            ':id' => $ID_DOCTOR
        ]);

        if($execution) {
            if($data = $preparequery->fetch()) {
                $doctor = new Doctor($data['doctor_name'], $data['doctor_postname'], $data['doctor_surname'], 
                $data['doctor_gender'], $data['doctor_mail'], $data['doctor_phone_number'], $data['doctor_password'], 
                $data['doctor_picture'], $data['doctor_date_created'], $data['doctor_speciality'], $data['doctor_hospital'], $data['doctor_role']);

                return $doctor;
            } else return null;
        } else return null;   
    }

    // FUNCTION UPDATE DOCTOR
    static function updateDoctor($id_user, $user_name, $user_postname, $user_surname, $user_phone_number) {
        global $db;

        $query = 'UPDATE doctor SET doctor_name = :doctor_name, doctor_postname = :doctor_postname, doctor_surname = :doctor_surname, doctor_phone_number = :doctor_phone_number WHERE id = :id';        
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id' => $id_user,
            ':doctor_name' => $user_name,
            ':doctor_postname' => $user_postname,
            ':doctor_surname' => $user_surname,
            ':doctor_phone_number' => $user_phone_number
        ]);

        return $execution ? true : false;
    }

     // FUNCTION THAT UPDATE THE TUTEUR PICTURE
    static function updateDoctorPicture($id_user, $user_picture ) {
        global $db;

        $query = 'UPDATE doctor SET doctor_picture = :doctor_picture WHERE id = :id';        
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id' => $id_user,
            ':doctor_picture' => $user_picture
        ]);

        return $execution ? true : false;
    }

    // FUNCTION UPDATE PASSWORD
    static function update_password($MAIL_ADDRESS, $NEW_PASSWORD_KEY) {
        global $db;

        $query = 'UPDATE doctor SET doctor_password = :doctor_password WHERE doctor_mail = :doctor_mail';
        $preparequery = $db->prepare($query);
        $execution = $preparequery->execute([
            ':doctor_mail' => $MAIL_ADDRESS,
            ':doctor_password' => $NEW_PASSWORD_KEY
        ]);
        
        return $execution ? true : false;
    }

    // FUNCTION GET ALL DOCTORS
    static function getAllDoctors() {
        global $db;

        $query = 'SELECT * FROM doctor WHERE 1';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([]);

        $doctors = [];
        if($execution) {
            while($data = $prepareQuery->fetch()) {
                $doctor = new Doctor($data['doctor_name'], $data['doctor_postname'], $data['doctor_surname'], 
                $data['doctor_gender'], $data['doctor_mail'], $data['doctor_phone_number'], $data['doctor_password'], 
                $data['doctor_picture'], $data['doctor_date_created'], $data['doctor_speciality'], $data['doctor_hospital'], $data['doctor_role']);

                array_push($doctors, $doctor);
            } 
            return $doctors;

        } else return [];
        
    }

    // SEARCH DOCTOR BY USER NAME
    static function doctor_search($DOCTOR_NAME) {
        global $db;

        $query = 'SELECT * FROM doctor WHERE doctor_name = :doctor_name';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':doctor_name'=>$DOCTOR_NAME
        ]);

        $doctors = [];
        if($execution) {
            while($data = $prepareQuery->fetch()) {
                $doctor = new Doctor($data['doctor_name'], $data['doctor_postname'], $data['doctor_surname'], 
                $data['doctor_gender'], $data['doctor_mail'], $data['doctor_phone_number'], $data['doctor_password'],
                $data['doctor_picture'], $data['doctor_date_created'], $data['doctor_speciality'], $data['doctor_hospital'], $data['doctor_role']);
                array_push($doctors, $doctor) ;
            }

            if(count($doctors) > 0) return $doctors;
            else return "no_doctor_founded";
        } else return [];
    }

    static function getIdDoctorCenter() {
        global $db;

        $query = 'SELECT * FROM doctor WHERE doctor_role = :doctor_role';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':doctor_role' => 'doctorCenter'
        ]);

        if($execution) {
            if($data = $prepareQuery->fetch()) {
                return $data['id'];
            } else return null;
        } else return null;
    }

    public function getIdDoctor($DOCTOR) {
        global $db;

        $query = 'SELECT * FROM doctor WHERE 1';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery -> execute([]);

        $doctors = [];
        if($execution) {
            while($data = $prepareQuery->fetch()) {
                $doctor = new Doctor($data['doctor_name'], $data['doctor_postname'], $data['doctor_surname'], 
                $data['doctor_gender'], $data['doctor_mail'], $data['doctor_phone_number'], $data['doctor_password'],
                $data['doctor_picture'], $data['doctor_date_created'], $data['doctor_speciality'], $data['doctor_hospital'], $data['doctor_role']);
                
                $doctors[$data['id']] = $doctor;
            }

            $idDoctor = NULL;
            foreach($doctors as $doctor) {
                if($doctor == $DOCTOR) {
                    $idDoctor = array_search($doctor, $doctors);
                }
            }
        }

        return $idDoctor;
    }

    static function deleteDoctor($ID_DOCTOR) {
        global $db;

        $query = 'DELETE FROM doctor WHERE id = :id';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id' => $ID_DOCTOR
        ]);

        return $execution ? true : false;
    }

    // GETTERS
    public function getDoctorName() { return $this->doctor_name; }
    public function getDoctorPostName() { return $this->doctor_postname; }
    public function getDoctorSurName() { return $this->doctor_surname; }
    public function getDoctorGender() { return $this->doctor_gender; }
    public function getDoctorMail() { return $this->doctor_mail;}
    public function getDoctorPhoneNumber() { return $this->doctor_phone_number;}
    public function getDoctorPassword() { return $this->doctor_password; }
    public function getDoctorPicture() { return $this->doctor_picture; }
    public function getDoctorDateCreated() { return $this->doctor_date_created; }
    public function getDoctorSpeciality() { return $this->doctor_speciality; }
    public function getDoctorHospital() { return $this->doctor_hospital; }
    public function getDoctorRole() { return $this->doctor_role; }
}

?>