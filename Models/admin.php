<?php

class Admin {
    private $admin_name;
    private $admin_postname;
    private $admin_surname;
    private $admin_gender;
    private $admin_mail;
    private $admin_phone_number;
    private $admin_password;
    private $admin_picture;
    private $admin_role;

    // CONSTRUCT
    public function __construct($admin_name, $admin_postname, $admin_surname, $admin_gender, $admin_mail, $admin_phone_number, $admin_password, $admin_role) {
        $this->admin_name = $admin_name;
        $this->admin_postname = $admin_postname;
        $this->admin_surname = $admin_surname;
        $this->admin_gender = $admin_gender;
        $this->admin_mail = $admin_mail;
        $this->admin_phone_number = $admin_phone_number;
        $this->admin_password = $admin_password;
        $this->admin_role = $admin_role;
    }

    // AUTHENTIFICATION FONCTION FOR ADMIN
    public static function authentification($ADMIN_NAME, $ADMIN_PASSWORD) {
        global $db;

        $query = 'SELECT * FROM admin_user WHERE admin_name = :admin_name AND admin_password = :admin_password';
        $preparequery = $db->prepare($query);
    
        $execution = $preparequery->execute([
            ':admin_name' => $ADMIN_NAME,
            ':admin_password' => $ADMIN_PASSWORD
        ]);

        if($execution) {
            return $preparequery->fetch() ? true : false;
        } else return false;
    }

    // GETTERS
    public function getAdminName() { return $this->admin_name; }
    public function getAdminPostName() { return $this->admin_postname; }
    public function getAdminSurName() { return $this->admin_surname; }
    public function getAdminGender() { return $this->admin_gender; }
    public function getAdminMail() { return $this->admin_mail;}
    public function getAdminPhoneNumber() { return $this->admin_phone_number;}
    public function getAdminPassword() { return $this->admin_password; }
    public function getAdminPicture() { return $this->admin_picture; }
    public function getAdminRole() { return $this->admin_role; }
}

?>