<?php

class Tuteur {
    private $id_patient;
    private $tuteur_name;
    private $tuteur_postname;
    private $tuteur_surname;
    private $tuteur_gender;
    private $tuteur_mail;
    private $tuteur_phone_number;
    private $tuteur_password;
    private $tuteur_picture;
    private $tuteur_date_created;
    private $tuteur_role;
    private $relationship_type;

    // CONSTRUCT
    public function __construct($id_patient, $tuteur_name, $tuteur_postname, $tuteur_surname, $tuteur_gender, $tuteur_mail, $tuteur_phone_number, $tuteur_password, $tuteur_date_created, $tuteur_role, $relationship_type) {
        $this->id_patient = $id_patient;
        $this->tuteur_name = $tuteur_name;
        $this->tuteur_postname = $tuteur_postname;
        $this->tuteur_surname = $tuteur_surname;
        $this->tuteur_gender = $tuteur_gender;
        $this->tuteur_mail = $tuteur_mail;
        $this->tuteur_phone_number = $tuteur_phone_number;
        $this->tuteur_password = $tuteur_password;
        $this->tuteur_date_created = $tuteur_date_created;
        $this->tuteur_role = $tuteur_role;
        $this->relationship_type = $relationship_type;
    }

    // INSERT tuteur
    public function createtuteur() {
        global $db;

        $query = 'INSERT INTO tuteur(id_patient, tuteur_name, tuteur_postname, tuteur_surname, tuteur_gender, tuteur_mail, tuteur_phone_number, tuteur_password, tuteur_date_created, tuteur_role, relationship_type) VALUES(:id_patient, :tuteur_name, :tuteur_postname, :tuteur_surname, :tuteur_gender, :tuteur_mail, :tuteur_phone_number, :tuteur_password, :tuteur_date_created, :tuteur_role, :relationship_type)';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id_patient' => $this->id_patient,
            ':tuteur_name' => $this->tuteur_name, 
            ':tuteur_postname' => $this->tuteur_postname, 
            ':tuteur_surname' => $this->tuteur_surname, 
            ':tuteur_gender' => $this->tuteur_gender, 
            ':tuteur_mail' => $this->tuteur_mail, 
            ':tuteur_phone_number' => $this->tuteur_phone_number, 
            ':tuteur_password' => $this->tuteur_password, 
            ':tuteur_date_created' => $this->tuteur_date_created,
            ':tuteur_role' => $this->tuteur_role,
            ':relationship_type' => $this->relationship_type
        ]);

        return $execution ? true : false;
    }

    static function getTuteurByPatient($ID_PATIENT) {
        global $db;

        $query = 'SELECT * FROM tuteur where id_patient = :id_patient';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id_patient' => $ID_PATIENT
        ]);

        if($execution) {
            if($data = $prepareQuery->fetch()) {
                
                $jsonArray = array(
                    'id_patient' => $data['id_patient'],
                    'tuteur_name' => $data['tuteur_name'],
                    'tuteur_postname' => $data['tuteur_postname'],
                    'tuteur_surname' => $data['tuteur_surname'],
                    'tuteur_gender' => $data['tuteur_gender'],
                    'tuteur_mail' => $data['tuteur_mail'],
                    'tuteur_phone_number' => $data['tuteur_phone_number'],
                    'relationship_type' => $data['relationship_type']
                );

                return $jsonArray;
            } else return [];
        }
    }

    static function getAllTuteurs() {
        global $db;

        $query = 'SELECT * FROM tuteur WHERE 1';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([]);

        $tuteurs = [];
        if($execution) {
            while($data = $prepareQuery->fetch()) {
                $tuteur = new Tuteur($data['id_patient'], $data['tuteur_name'], $data['tuteur_postname'], $data['tuteur_surname'], $data['tuteur_gender'], $data['tuteur_mail'], $data['tuteur_phone_number'], $data['tuteur_password'], $data['tuteur_date_created'], $data['tuteur_role'], $data['relationship_type']);
                array_push($tuteurs, $tuteur);
            } 

            return $tuteurs;

        } else return [];
    }

    // AUTHENTIFICATION FONCTION FOR ADMIN
    static function authentification($TUTEUR_NAME, $TUTEUR_PASSWORD) {
        global $db;

        $query = 'SELECT * FROM tuteur WHERE tuteur_name = :tuteur_name AND tuteur_password = :tuteur_password';
        $preparequery = $db->prepare($query);
        $execution = $preparequery->execute([
            ':tuteur_name' => $TUTEUR_NAME,
            ':tuteur_password' => $TUTEUR_PASSWORD
        ]);

        if($execution) {
            if($data = $preparequery->fetch()) {
                return $data['id_patient'];
            }
            return null;
        }
    }

     // FUNCTION UPDATE PASSWORD
     static function update_password($MAIL_ADDRESS, $NEW_PASSWORD_KEY) {
        global $db;

        $query = 'UPDATE tuteur SET tuteur_password = :tuteur_password WHERE tuteur_mail = :tuteur_mail';
        $preparequery = $db->prepare($query);
        $execution = $preparequery->execute([
            ':tuteur_mail' => $MAIL_ADDRESS,
            ':tuteur_password' => $NEW_PASSWORD_KEY
        ]);
        
        return $execution ? true : false;
    }

    // FUNCTION GET TUTEUR BY ID_PATIENT
    static function getTuteurByIdPatient($ID_PATIENT) {
        global $db;
        
        $query = 'SELECT * FROM tuteur WHERE id_patient = :id_patient';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id_patient' => $ID_PATIENT
        ]);

        if($execution) {
            if($data = $prepareQuery->fetch()) {
                $tuteur = new Tuteur($data['id_patient'], $data['tuteur_name'], $data['tuteur_postname'], $data['tuteur_surname'], $data['tuteur_gender'], $data['tuteur_mail'], $data['tuteur_phone_number'], $data['tuteur_password'], $data['tuteur_date_created'], $data['tuteur_role'], $data['relationship_type']);
                return $tuteur;
            } else return null;
            
        } else return null;
    }

    // FUNCTION THAT UPDATE TUTEUR INFORMATION
    static function updateTuteur($id_user, $user_name, $user_postname, $user_surname, $user_phone_number) {
        global $db;

        $query = 'UPDATE tuteur SET tuteur_name = :tuteur_name, tuteur_postname = :tuteur_postname, tuteur_surname = :tuteur_surname, tuteur_phone_number = :tuteur_phone_number WHERE id_patient = :id_patient';        
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id_patient' => $id_user,
            ':tuteur_name' => $user_name,
            ':tuteur_postname' => $user_postname,
            ':tuteur_surname' => $user_surname,
            ':tuteur_phone_number' => $user_phone_number
        ]);

        return $execution ? true : false;
    }

    // FUNCTION THAT UPDATE THE TUTEUR PICTURE
    static function updateTuteurPicture($id_user, $user_picture ) {
        global $db;

        $query = 'UPDATE tuteur SET tuteur_picture = :tuteur_picture WHERE id_patient = :id_patient';        
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id_patient' => $id_user,
            ':tuteur_picture' => $user_picture
        ]);

        return $execution ? true : false;
    }

    // FUNCTION THAT HELPS US TO SEARCH TUTEUR
    static function tuteur_search($tuteur_search) {
        global $db;

        $query = 'SELECT * FROM tuteur WHERE tuteur_name = :tuteur_name';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':tuteur_name'=> $tuteur_search
        ]);

        $tuteurs = [];
        if($execution) {
            while($data = $prepareQuery->fetch()) {
                $tuteur = new Tuteur($data['id_patient'], $data['tuteur_name'], $data['tuteur_postname'], $data['tuteur_surname'], $data['tuteur_gender'], $data['tuteur_mail'], $data['tuteur_phone_number'], $data['tuteur_password'], $data['tuteur_date_created'], $data['tuteur_role'], $data['relationship_type']);
                array_push($tuteurs, $tuteur);
            } 

            if(count($tuteurs) > 0) {
                return $tuteurs;
            } else return "no_patients_founded";
            return $tuteurs;

        } else return [];
    }

    static function deleteTuteur($ID_PATIENT) {
        global $db;

        $query = 'DELETE FROM tuteur WHERE id_patient = :id_patient';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id_patient' => $ID_PATIENT
        ]);

        return $execution ? true : false;
    }

    // GETTERS
    public function getIdPatien() { return $this->id_patient; }
    public function getTuteurName() { return $this->tuteur_name; }
    public function getTuteurPostName() { return $this->tuteur_postname; }
    public function getTuteurSurName() { return $this->tuteur_surname; }
    public function getTuteurGender() { return $this->tuteur_gender; }
    public function getTuteurMail() { return $this->tuteur_mail;}
    public function getTuteurPhoneNumber() { return $this->tuteur_phone_number;}
    public function getTuteurPassword() { return $this->tuteur_password; }
    public function getTuteurPicture() { return $this->tuteur_picture; }
    public function getTuteurDateCreated() { return $this->tuteur_date_created; }
    public function getTuteurRole() { return $this->tuteur_role; }
    public function getRelationshipType() { return $this->relationship_type; }
}

?>