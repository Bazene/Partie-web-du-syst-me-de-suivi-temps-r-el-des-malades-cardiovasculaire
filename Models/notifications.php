<?php

class Notifications {
    private $id_patient;
    private $notification_content;
    private $notification_date;
    private $notification_hour;
    private $active;

    // CONSTRUCT
    public function __construct($id_patient, $notification_content, $notification_date, $notification_hour, $active){
        $this->id_patient = $id_patient;
        $this->notification_content = $notification_content;
        $this->notification_date = $notification_date;
        $this->notification_hour = $notification_hour;
        $this->active = $active;
    }

    public function createNotification() {
        global $db;

        $query = 'INSERT INTO notifications(id_patient, notification_content, notification_date, notification_hour, active) VALUES(:id_patient, :notification_content, :notification_date, :notification_hour, :active)';
        $prepare_query = $db->prepare($query);
        $execution = $prepare_query->execute([
            ':id_patient' => $this->id_patient,
            ':notification_content' => $this->notification_content,
            ':notification_date' => $this->notification_date,
            ':notification_hour' => $this->notification_hour,
            ':active' => $this->active
        ]);

        return $execution ? true : false;
    }

    // notification read function
    public function getNoticationsRead() {
        global $db;

        $query = 'SELECT * FROM notifications WHERE active = 0 ORDER BY notification_date DESC, notification_hour DESC';
        $prepare_query = $db->prepare($query);
        $execution = $prepare_query->execute([]);

        $notificationsRead = [];
        if($execution) {
            while($data = $prepare_query->fetch()) {
                $notificationRead = new Notifications($data['id_patient'], $data['notification_content'], $data['notification_date'], $data['notification_hour'], $data['active']);
                array_push($notificationsRead, $notificationRead);
            }

            return $notificationsRead;

        } else return $notificationsRead;
    }

    // notification unread function
    public function getNoticationsUnRead() {
        global $db;

        $query = 'SELECT * FROM notifications WHERE active = 1 ORDER BY notification_date DESC, notification_hour DESC';
        $prepare_query = $db->prepare($query);
        $execution = $prepare_query->execute([]);

        $notificationsUnRead = [];
        if($execution) {
            while($data = $prepare_query->fetch()) {
                $notificationUnRead = new Notifications($data['id_patient'], $data['notification_content'], $data['notification_date'], $data['notification_hour'], $data['active']);
                array_push($notificationsUnRead, $notificationUnRead);
            }

            return $notificationsUnRead;

        } else return $notificationsUnRead;
    }

    static function getAllNotifications() {
        global $db;

        $query = 'SELECT * FROM notifications ORDER BY notification_date DESC, notification_hour DESC';
        $prepare_query = $db->prepare($query);
        $execution = $prepare_query->execute([]);

        $notifications = [];
        if($execution) {
            while($data = $prepare_query->fetch()) {
                $notification = new Notifications($data['id_patient'], $data['notification_content'], $data['notification_date'], $data['notification_hour'], $data['active']);
                array_push($notifications, $notification);
            }

            return $notifications;

        } else return $notifications;
    }

    public function objectToJson() {
        $JsonArray = array(
            'id_patient' => $this->id_patient,
            'notification_content' => $this->notification_content,
            'notification_date' => $this->notification_date,
            'notification_hour' => $this->notification_hour,
            'active' => $this->active
        );

        return $JsonArray;
    }

    public function isANotificationForDocto($ID_DOCTOR) {
        global $db;

        $query = 'SELECT id_doctor, id_doctor_archived FROM patient JOIN notifications ON notifications.id_patient = :id';
        $prepare_query = $db->prepare($query);
        $execution = $prepare_query->execute([
            ':id' => $this->id_patient
        ]);

        if($execution) {
            if($data = $prepare_query->fetch()) {
                if(($data['id_doctor'] == $ID_DOCTOR) && ($data['id_doctor'] !== $data['id_doctor_archived'])) {
                    return true;
                } else return false;
            } else return false;
        } else return false;
    }

    static function getNotificationsForTuteur($ID_PATIENT) {
        global $db;

        $query = 'SELECT * FROM notifications WHERE id_patient = :id_patient';
        $prepare_query = $db->prepare($query);
        $execution = $prepare_query->execute([
            ':id_patient' => $ID_PATIENT
        ]);

        $notifications = [];
        if($execution) {
            while($data = $prepare_query->fetch()) {
                $notification = new Notifications($data['id_patient'], $data['notification_content'], $data['notification_date'], $data['notification_hour'], $data['active']);
                array_push($notifications, $notification);
            }

            return $notifications;

        } else return $notifications;
    }

    // Get names of patients
    public function getNamesPatient() {
        global $db;

        $query = 'SELECT patient_name, patient_postname, patient_surname FROM patient JOIN notifications ON notifications.id_patient = :id';
        $prepare_query = $db->prepare($query);
        $execution = $prepare_query->execute([
            ':id' => $this->id_patient
        ]);

        if($execution) {
            if($data = $prepare_query->fetch()) {
                $names = strtoupper($data['patient_name'])." ".strtoupper($data['patient_postname'])." ".$data['patient_surname'];
                return $names;
            } else return null;
        } else return null;

    }

    static function deleteNotification($ID_NOTIFICATION) {
        global $db;

        $query = 'DELETE FROM notifications WHERE id=:id';
        $prepare_query = $db->prepare($query);
        $execution = $prepare_query->execute([
            ':id' => $ID_NOTIFICATION
        ]);

        return $execution ? true : false;
    }

    public function getIdNotification($NOTIFICATION) {
        global $db;

        // get all patient
        $query = 'SELECT * FROM notifications WHERE 1';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([]);

        $notifications = [];
        if($execution) {
            while($data = $prepareQuery->fetch()) {
                $notification = new Notifications($data['id_patient'], $data['notification_content'], $data['notification_date'], $data['notification_hour'], $data['active']);
        
                $notifications[$data['id']]= $notification;
            } 
        }

        $idNotification = NULL;
        foreach($notifications as $notification) {
            if($notification == $NOTIFICATION) {
                $idNotification = array_search($notification, $notifications);
            }
        }

        return $idNotification;
    }

    public function updateActiveState($new_active, $id_patient) {
        global $db;

        $query = 'UPDATE notifications SET active = :active WHERE id_patient = :id_patient';
        $prepare_query = $db->prepare($query);
        $execution = $prepare_query->execute([
            ':active' => $new_active,
            ':id_patient' => $id_patient
        ]);

        return $execution ? true : false;
    }

    // Getters and setters
    public function getId_patient() { return $this->id_patient;}
    public function getNotification_content() { return $this->notification_content;}
    public function getNotification_date() { return $this->notification_date ;}
    public function getNotification_hour() { return $this->notification_hour;}
    public function getActive() { return $this->active;}
    public function setActive($new_active) { $this->active = $new_active;}
}
?>