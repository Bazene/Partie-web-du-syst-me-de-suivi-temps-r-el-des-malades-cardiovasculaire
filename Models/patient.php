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
    public function __construct($id_doctor, $id_doctor_archived, $patient_name, $patient_postname, $patient_surname, $patient_gender, $patient_phone_number, $patient_mail, $patient_password, $patient_picture, $patient_commune, $patient_quater, $patient_date_created, $patient_age,  $patient_size, $patient_weight, $patient_role) {
        $this->id_doctor = $id_doctor;
        $this->id_doctor_archived = $id_doctor_archived;
        $this->patient_name = $patient_name;
        $this->patient_postname = $patient_postname; 
        $this->patient_surname = $patient_surname; 
        $this->patient_gender = $patient_gender; 
        $this->patient_phone_number = $patient_phone_number; 
        $this->patient_mail = $patient_mail;
        $this->patient_password = $patient_password; 
        $this->patient_picture = $patient_picture;
        $this->patient_commune = $patient_commune;
        $this->patient_quater = $patient_quater;
        $this->patient_date_created = $patient_date_created; 
        $this->patient_age = $patient_age; 
        $this->patient_size = $patient_size;
        $this->patient_weight = $patient_weight;
        $this->patient_role = $patient_role;    
    }

    // FUNCTION CREATE A PATIENT
    public function createPatient() {
        global $db;

        $query = 'INSERT INTO patient(patient_name, patient_postname, patient_surname, patient_gender,  patient_phone_number, patient_mail, patient_password, patient_date_created, patient_age, patient_role) VALUES (:patient_name, :patient_postname, :patient_surname, :patient_gender,  :patient_phone_number, :patient_mail, :patient_password, :patient_date_created, :patient_age, :patient_role)';

        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':patient_name' => $this->patient_name,
            ':patient_postname'=> $this->patient_postname, 
            ':patient_surname' => $this->patient_surname,
            ':patient_gender' => $this->patient_gender,
            ':patient_phone_number' => $this->patient_phone_number,
            ':patient_mail' => $this->patient_mail,
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
                $patient = new Patient($data['id_doctor'], $data['id_doctor_archived'],$data['patient_name'], $data['patient_postname'], $data['patient_surname'], $data['patient_gender'], $data['patient_phone_number'], $data['patient_mail'], $data['patient_password'], $data['patient_picture'], $data['patient_commune'], $data['patient_quater'], $data['patient_date_created'], $data['patient_age'], $data['patient_size'],$data['patient_weight'],$data['patient_role']);                
        
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

    // FUNCTION GET ALL PATIENTS FOLLOWING
    static function getAllPatientsFollow($idDoctorCenter) {
        global $db;

        $query = 'SELECT * FROM patient WHERE 1';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([]);

        $patients = [];
        if($execution) {
            while($data = $prepareQuery->fetch()) {
                if(($data['id_doctor'] !== $idDoctorCenter) && ($data['id_doctor'] !== $data['id_doctor_archived'])) {
                    $patient = new Patient($data['id_doctor'], $data['id_doctor_archived'],$data['patient_name'], $data['patient_postname'], $data['patient_surname'], $data['patient_gender'], $data['patient_phone_number'], $data['patient_mail'], $data['patient_password'], $data['patient_picture'], $data['patient_commune'], $data['patient_quater'], $data['patient_date_created'], $data['patient_age'], $data['patient_size'],$data['patient_weight'],$data['patient_role']);                

                    array_push($patients, $patient);
                }
            } 

            return $patients;

        } else return [];
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
                $patient = new Patient($data['id_doctor'], $data['id_doctor_archived'],$data['patient_name'], $data['patient_postname'], $data['patient_surname'], $data['patient_gender'], $data['patient_phone_number'], $data['patient_mail'], $data['patient_password'], $data['patient_picture'], $data['patient_commune'], $data['patient_quater'], $data['patient_date_created'], $data['patient_age'], $data['patient_size'],$data['patient_weight'],$data['patient_role']);                

                array_push($patients, $patient);
            } 
            return $patients;
        } else return [];
    }

    static function getPatientById($id_patient) {
        global $db;

        $query = 'SELECT * FROM patient WHERE id = :id';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id'=>$id_patient
        ]);

        if($execution) {
            if($data = $prepareQuery->fetch()) {
                $patient = new Patient($data['id_doctor'], $data['id_doctor_archived'],$data['patient_name'], $data['patient_postname'], $data['patient_surname'], $data['patient_gender'], $data['patient_phone_number'], $data['patient_mail'], $data['patient_password'], $data['patient_picture'], $data['patient_commune'], $data['patient_quater'], $data['patient_date_created'], $data['patient_age'], $data['patient_size'],$data['patient_weight'],$data['patient_role']);                

                return $patient;
            } else return [];
        } else return [];   
    }

    // FUNCTION GET ALL PATIENTS FOLLOWING BY THE DOCTOR
    static function getAllPatientsFollowingByDoctor($idDoctor) {
        global $db;

        $query = 'SELECT * FROM patient WHERE id_doctor = :id_doctor';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id_doctor' => $idDoctor
        ]);

        $patients = [];
        if($execution) {
            while($data = $prepareQuery->fetch()) {
                if($data['id_doctor_archived'] !== $data['id_doctor']) {
                    $patient = new Patient($data['id_doctor'], $data['id_doctor_archived'],$data['patient_name'], $data['patient_postname'], $data['patient_surname'], $data['patient_gender'], $data['patient_phone_number'], $data['patient_mail'], $data['patient_password'], $data['patient_picture'], $data['patient_commune'], $data['patient_quater'], $data['patient_date_created'], $data['patient_age'], $data['patient_size'],$data['patient_weight'],$data['patient_role']);                

                    array_push($patients, $patient);
                }
            } 

            return $patients;

        } else return [];
    }

    static function getAllPatientsArchivedByDoctor($idDoctor) {
        global $db;

        $query = 'SELECT * FROM patient WHERE id_doctor_archived = :id_doctor_archived';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id_doctor_archived' => $idDoctor
        ]);

        $patients = [];
        if($execution) {
            while($data = $prepareQuery->fetch()) {
                $patient = new Patient($data['id_doctor'], $data['id_doctor_archived'],$data['patient_name'], $data['patient_postname'], $data['patient_surname'], $data['patient_gender'], $data['patient_phone_number'], $data['patient_mail'], $data['patient_password'], $data['patient_picture'], $data['patient_commune'], $data['patient_quater'], $data['patient_date_created'], $data['patient_age'], $data['patient_size'],$data['patient_weight'],$data['patient_role']);                

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

    // AUTHENTIFICATION FONCTION THAT THE USER ID
    static function getIdOnAuthentification($PATIENT_NAME, $PATIENT_PASSWORD) {
        global $db;

        $query = 'SELECT * FROM patient WHERE patient_name = :patient_name AND patient_password = :patient_password';
        $preparequery = $db->prepare($query);
        $execution = $preparequery->execute([
            ':patient_name' => $PATIENT_NAME,
            ':patient_password' => $PATIENT_PASSWORD
        ]);

        if($execution) {            
            if($data = $preparequery->fetch()) {
                return $data['id'];
            } ;
        } 
        return null;
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

    static function updatePatientProfile($token, $patient_name, $patient_phone_number, $patient_age, $patient_weight, $patient_size, $patient_commune, $patient_quater, $patient_gender) {
        global $db;

        $query = "UPDATE patient SET patient_name=:patient_name, patient_phone_number=:patient_phone_number, patient_age=:patient_age, patient_weight=:patient_weight, patient_size=:patient_size, patient_commune=:patient_commune, patient_quater=:patient_quater, patient_gender=:patient_gender WHERE patient_role=:patient_role";
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':patient_role' => $token,
            ':patient_name' => $patient_name,
            ':patient_phone_number' => $patient_phone_number,
            ':patient_age' => $patient_age,
            ':patient_weight' => $patient_weight,
            ':patient_size' => $patient_size,
            ':patient_commune' => $patient_commune,
            ':patient_quater' => $patient_quater,
            ':patient_gender' => $patient_gender
        ]);

        return $execution ? true : false;
    }

    static function updatePatientPicture($token, $patient_picture) {
        global $db;

        $query = "UPDATE patient SET patient_picture=:patient_picture WHERE patient_role=:patient_role";
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':patient_role' => $token,
            ':patient_picture' => $patient_picture
        ]);

        return $execution ? true : false;
    }

    static function deletePatientById($id_patient) {
        global $db;

        $query = 'DELETE FROM patient WHERE id = :id';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id' => $id_patient
        ]);

        return $execution ? true : false;
    }

    static function patient_search($patient_search) {
        global $db;

        $query = 'SELECT * FROM patient WHERE patient_name = :patient_name';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':patient_name'=>$patient_search
        ]);

        $patients = [];
        if($execution) {
            while($data = $prepareQuery->fetch()) {
                $patient = new Patient($data['id_doctor'], $data['id_doctor_archived'],$data['patient_name'], $data['patient_postname'], $data['patient_surname'], $data['patient_gender'], $data['patient_phone_number'], $data['patient_mail'], $data['patient_password'], $data['patient_picture'], $data['patient_commune'], $data['patient_quater'], $data['patient_date_created'], $data['patient_age'], $data['patient_size'],$data['patient_weight'],$data['patient_role']);                

                array_push($patients, $patient);
            } 

            if(count($patients) > 0) {
                return $patients;
            } else return "no_patients_founded";
        } else return [];
    }

    static function newPatientToFOllow($id_patient, $id_doctor, $id_doctor_archived) {
        global $db;

        $query = "UPDATE patient SET id_doctor = :id_doctor, id_doctor_archived = :id_doctor_archived WHERE id = :id";
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id' => $id_patient,
            ':id_doctor' => $id_doctor,
            ':id_doctor_archived' => $id_doctor_archived
        ]);

        return $execution ? true : false;
    }

    static function archive_patient($id_patient, $id_doctor_archived) {
        global $db;

        $query = "UPDATE patient SET id_doctor_archived = :id_doctor_archived WHERE id = :id";
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id' => $id_patient,
            ':id_doctor_archived' => $id_doctor_archived
        ]);

        return $execution ? true : false;
    }

    static function getDoctorWhoFollowPatient($ID_DOCTOR, $ID_PATIENT) {
        global $db; 
        
        $query = 'SELECT doctor.* FROM doctor JOIN patient ON patient.id_doctor = :id_doctor WHERE patient.id = :id_patient';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute(array(
            ':id_doctor' => $ID_DOCTOR,
            ':id_patient' => $ID_PATIENT
        ));
        if($execution)  {
            $doctorJsonArray = [];
            while($data = $prepareQuery->fetch()) {
               
                if($data['id'] == $ID_DOCTOR)  {
                    $doctorJsonArray = array (
                        "doctor_name" => $data['doctor_name'],
                        "doctor_mail" => $data['doctor_mail'],
                        "doctor_phone_number" => $data['doctor_phone_number']

                    );
                    
                    break;
                }
            }
            return $doctorJsonArray;
            
        } else return null;
    }

    public function objectToJson() {
        $jsonArray = array(

            'id_doctor' => $this->id_doctor,
            'id_doctor_archived' => $this->id_doctor_archived,
            'patient_name' => $this->patient_name,
            'patient_postname' => $this->patient_postname,
            'patient_surname' => $this->patient_surname,
            'patient_gender' => $this->patient_gender,
            'patient_phone_number' => $this->patient_phone_number,
            'patient_mail' => $this->patient_mail,
            'patient_password' => $this->patient_password,
            'patient_picture' => $this->patient_picture,
            'patient_commune' => $this->patient_commune,
            'patient_quater' => $this->patient_quater,
            'patient_date_created' => $this->patient_date_created,
            'patient_age' => $this->patient_age,
            'patient_size' => $this->patient_size,
            'patient_weight' => $this->patient_weight,
            'patient_role' => $this->patient_role,
        );

        return $jsonArray;
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