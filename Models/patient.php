<?php

class Patient {
    private $id_doctor;
    private $id_doctor_archived;
    private $patient_name;
    private $patient_postname;
    private $patient_surname;
    private $patient_gender;
    private $patient_mail;
    private $patient_phone_number;
    private $patient_password;
    private $patient_picture;
    private $patient_commune;
    private $patient_quater;
    private $patient_date_created;
    private $patient_age;
    private $patient_size;
    private $patient_weight;
    private $patient_role;

    // CONSTRUCT
    public function __construct($patient_name, $patient_postname, $patient_surname, $patient_gender, $patient_phone_number, $patient_mail, $patient_password, $patient_date_created, $patient_age, $patient_role) {
        $this->patient_name = $patient_name;
        $this->patient_postname = $patient_postname; 
        $this->patient_surname = $patient_surname; 
        $this->patient_gender = $patient_gender; 
        $this->patient_phone_number = $patient_phone_number; 
        $this->patient_mail = $patient_mail;
        $this->patient_password = $patient_password; 
        $this->patient_date_created = $patient_date_created; 
        $this->patient_age = $patient_age; 
        $this->patient_role = $patient_role;    
    }

    // FUNCTION CREATE A PATIENT
    public function createPatient() {
        global $db;

        $query = 'INSERT INTO patient(patient_name, patient_postname, patient_surname, patient_gender, patient_mail, patient_phone_number, patient_password, patient_date_created, patient_age, patient_role) VALUES (:patient_name, :patient_postname, :patient_surname, :patient_gender, :patient_mail, :patient_phone_number, :patient_password, :patient_date_created, :patient_age, :patient_role)';

        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':patient_name' => $this->patient_name,
            ':patient_postname'=> $this->patient_postname, 
            ':patient_surname' => $this->patient_surname,
            ':patient_gender' => $this->patient_gender,
            ':patient_mail' => $this->patient_mail,
            ':patient_phone_number' => $this->patient_phone_number,
            ':patient_password' => $this->patient_password, 
            ':patient_date_created' => $this->patient_date_created, 
            ':patient_age' => $this->patient_age, 
            ':patient_role' => $this->patient_role
        ]);

        return $execution ? true : false;
    }

    // FUNCTION GET ID PATIENTS
    public function getIdPatient($PATIENT) {
        global $db;

        // get all patient
        $query = 'SELECT * FROM patient WHERE 1';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([]);

        $patients = [];
        if($execution) {
            while($data = $prepareQuery->fetch()) {
                $patient = new Patient($data['patient_name'], $data['patient_postname'], $data['patient_surname'], 
                $data['patient_gender'], $data['patient_mail'], $data['patient_phone_number'], $data['patient_password'], 
                $data['patient_date_created'], $data['patient_age'], $data['patient_role']);
                
                $patients[$data['id']]= $patient;
                
            } 
        }

        $idPatient = NULL;
        foreach($patients as $patient) {
            if($patient == $PATIENT) {
                $idPatient = array_search($patient, $patients);
            }
        }

        return $idPatient;
    }

    // FUNCTION GET ALL PATIENTS
    static function getAllPatients() {
        global $db;

        $query = 'SELECT * FROM patient WHERE 1';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([]);

        $patients = [];
        if($execution) {
            while($data = $prepareQuery->fetch()) {
                $patient = new Patient($data['patient_name'], $data['patient_postname'], $data['patient_surname'], 
                $data['patient_gender'], $data['patient_mail'], $data['patient_phone_number'], $data['patient_password'], 
                $data['patient_date_created'], $data['patient_age'], $data['patient_role']);

                array_push($patients, $patient);
            } 

            return $patients;

        } else return [];
        
    }

    // FUNCTIONS GET THE LAST PATIENT 
    static function getTheLastPatient() {
        global $db;

        $query = 'SELECT * FROM patient ORDER BY patient_date_created DESC';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([]);

        if($patient = $prepareQuery->fetch(PDO::FETCH_ASSOC)) {
            return $patient;
        } else return [];
    }

    // AUTHENTIFICATION FONCTION FOR A PATIENT
    static function authentification($PATIENT_NAME, $PATIENT_PASSWORD) {
        global $db;

        $query = 'SELECT * FROM patient WHERE patient_name = :patient_name AND patient_password = :patient_password';
        $preparequery = $db->prepare($query);
        $execution = $preparequery->execute([
            ':patient_name' => $PATIENT_NAME,
            ':patient_password' => $PATIENT_PASSWORD
        ]);

        if($execution) {            
            if($preparequery->fetch()) {
                $data = $preparequery->fetch();
                return $data;
            } else return null;
        } else return null;
    }

    // FUNCTION UPDATE PASSWORD
    static function update_password($MAIL_ADDRESS, $NEW_PASSWORD_KEY) {
        global $db;

        $query = 'UPDATE patient SET patient_password = :patient_password WHERE patient_mail = :patient_mail';
        $preparequery = $db->prepare($query);
        $execution = $preparequery->execute([
            ':patient_mail' => $MAIL_ADDRESS,
            ':patient_password' => $NEW_PASSWORD_KEY
        ]);
        
        return $execution ? true : false;
    }

    // FUNCTION UPDATE TOKEN (ROLE)
    static function update_token($PATIENT_PASSWORD_HASHED, $TOKEN) {
        global $db;

        $query = 'UPDATE patient SET patient_role = :patient_role WHERE patient_password = :patient_password';
        $preparequery = $db->prepare($query);
        $execution = $preparequery->execute([
            ':patient_password' => $PATIENT_PASSWORD_HASHED,
            ':patient_role' => $TOKEN
        ]);
        
        return $execution ? true : false;
    }


    // PATIENTS FOLLOW TO ONE DOCTOR
    public function getPatientsFollow($id_doctor) {
        global $db;

        $query = 'SELECT * FROM patient WHERE id_doctor = :id_docter';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id_doctor' => $this->id_doctor
        ]);

        $patientsFollow = [];
        if($execution) {
            while($data = $prepareQuery->fetch()) {
                $patient = new Patient($data['patient_name'], $data['patient_postname'], $data['patient_surname'], 
                $data['patient_gender'], $data['patient_mail'], $data['patient_phone_number'], $data['patient_password'], 
                $data['patient_date_created'], $data['patient_age'], $data['patient_role']);
                array_push($patientsFollow, $patient);

            } 
            return $patientsFollow;

        } else return [];
    } 

    // PATIENTS ARCHIVED
    public function getPatientsArchived($id_doctor) {
        global $db;

        $query = 'SELECT * FROM patient WHERE id_doctor = :id_docter_archived';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id_docter_archived' => $this->id_doctor_archived
        ]);

        $patientsArchived = [];
        if($execution) {
            while($data = $prepareQuery->fetch()) {
                $patient = new Patient($data['patient_name'], $data['patient_postname'], $data['patient_surname'], 
                $data['patient_gender'], $data['patient_mail'], $data['patient_phone_number'], $data['patient_password'], 
                $data['patient_date_created'], $data['patient_age'], $data['patient_role']);
                array_push($patientsArchived, $patient);

            } 
            return $patientsArchived;

        } else return [];
    } 

    // GETTERS AND SETTERS
    public function getIdDoctor() { return $this->id_doctor; }
    public function setIdDoctor($id) { $this->id_doctor = $id;}
    public function getIdDoctorArchived() { return $this->id_doctor_archived; }
    public function setIdDoctorArchived($id) { $this->id_doctor_archived = $id; }
    public function getPatientName() { return $this->patient_name ;}
    public function getPatientPostName() { return $this->patient_postname; }
    public function getPatientSurName() { return $this->patient_surname; }
    public function getPaientGender() { return $this->patient_gender; }
    public function getPatientMail() { return $this->patient_mail; }
    public function getPatientPhoneNumber() { return $this->patient_phone_number; }
    public function getPatientPassword() { return $this->patient_password; }
    public function getPatientPicture() { return $this->patient_picture; }
    public function getPatientCommune() { return $this->patient_commune; }
    public function getPatientQuater() { return $this->patient_quater;}
    public function getPatientDateCreated() { return $this->patient_date_created; }
    public function getPatientAge() { return $this->patient_age; }
    public function getPatientSize() { return $this->patient_size; }
    public function setPatientSize($size) { $this->patient_size = $size; }
    public function getPatientWeight() { return $this->patient_weight; }
    public function setPatientWeight($weight) { $this->patient_weight = $weight;}
    public function getPatientRole() { return $this->patient_role; }
}

?>