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

        $query = 'INSERT INTO tuteur(id_patient, tuteur_name, tuteur_postname, tuteur_surname, tuteur_gender, tuteur_mail, tuteur_phone_number, tuteur_password, tuteur_date_created, tuteur_speciality, tuteur_hospital, tuteur_role, relationship_type) VALUES(:id_patient, :tuteur_name, :tuteur_postname, :tuteur_surname, :tuteur_gender, :tuteur_mail, :tuteur_phone_number, :tuteur_password, :tuteur_date_created, :tuteur_speciality, :tuteur_hospital, :tuteur_role, :relationship_type)';
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
            return $preparequery->fetch() ? true : false;
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