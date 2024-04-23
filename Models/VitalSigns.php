<?php

class VitalSigns {
    private $id_local;
    private $id_patient;
    private $temperature;
    private $heart_rate;
    private $oxygen_level;
    private $blood_glucose;
    private $systolic_blood;
    private $diastolic_blood;
    private $vital_hour;
    private $vital_date;
    private $sync_vitalSign;


    // CONSTRUCT
    public function __construct($id_local, $id_patient, $temperature, $heart_rate, $oxygen_level, $blood_glucose, $systolic_blood, $diastolic_blood, $vital_hour, $vital_date, $sync_vitalSign) {
        $this->id_local = $id_local;
        $this->id_patient = $id_patient;
        $this->temperature = $temperature;
        $this->heart_rate = $heart_rate;
        $this->oxygen_level = $oxygen_level;
        $this->blood_glucose = $blood_glucose;
        $this->systolic_blood = $systolic_blood;
        $this->diastolic_blood = $diastolic_blood;
        $this->vital_hour = $vital_hour;
        $this->vital_date = $vital_date;    
        $this->sync_vitalSign = $sync_vitalSign;
    }

    // FUNCTION CREATE A VITAL SIGN
    public function createVitalSign() {
        global $db;

        $query = 'INSERT INTO vitalsigns(id_local, id_patient, temperature, heart_rate, oxygen_level, blood_glucose, systolic_blood, diastolic_blood, vital_hour, vital_date, sync_vitalSign) VALUES (:id_local, :id_patient, :temperature, :heart_rate, :oxygen_level, :blood_glucose, :systolic_blood, :diastolic_blood, :vital_hour, :vital_date, :sync_vitalSign)';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id_local' => $this->id_local,
            ':id_patient' => $this->id_patient,
            ':temperature' => $this->temperature, 
            ':heart_rate' => $this->heart_rate, 
            ':oxygen_level' => $this->oxygen_level, 
            ':blood_glucose' => $this->blood_glucose,
            ':systolic_blood' => $this->systolic_blood, 
            ':diastolic_blood' => $this->diastolic_blood,
            ':vital_hour' => $this->vital_hour,
            ':vital_date' => $this->vital_date,
            ':sync_vitalSign' => $this->sync_vitalSign
        ]);

        return $execution ? true : false;
    }

    public function isInTable() {
        global $db;

        $query = 'SELECT * FROM vitalsigns WHERE id_local=:id_local';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id_local' => $this->id_local
        ]);

        if($execution) {
            return ($prepareQuery->fetch()) ? true : false;
        } else return false;
    }

    public function updateVitalSign() {
        global $db;
        
        $query = 'UPDATE vitalsigns SET temperature=:temperature, heart_rate=:heart_rate, oxygen_level=:oxygen_level, blood_glucose=:blood_glucose, systolic_blood=:systolic_blood, diastolic_blood=:diastolic_blood, vital_hour=:vital_hour, vital_date=:vital_date WHERE id_local = :id_local';
        
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id_local'=> $this->id_local,
            ':temperature' => $this->temperature,
            ':heart_rate' => $this->heart_rate,
            ':oxygen_level' => $this->oxygen_level,
            ':blood_glucose' => $this->blood_glucose,
            ':systolic_blood' => $this->systolic_blood,
            ':diastolic_blood' => $this->diastolic_blood,
            ':vital_hour' => $this->vital_hour,
            ':vital_date' => $this->vital_date

        ]);

        return $execution ? true : false;
    }

    // FUNCTION GET THE LAST VITALSIGNS
    public function getLastVitalSign() {
        global $db;

        $query = "SELECT * FROM vitalsigns ORDER BY id DESC LIMIT 1";
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([]);
        
        if($execution) {
            $data = $prepareQuery->fetch();
            $vitalSign = new VitalSigns($data['id_local'], $data['id_patient'] ,$data['temperature'], $data['heart_rate'], $data['oxygen_level'],$data['blood_glucose'], $data['systolic_blood'], $data['diastolic_blood'], $data['vital_hour'], $data['vital_date'], $data['sync_vitalSign']);                

            return $vitalSign;
        } else return null;
    }

    static function getAllVitalSigns() {
        global $db;

        $query = "SELECT * FROM vitalsigns ORDER BY id";
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([]);
        
        $allVitalSigns = [];
        if($execution) {
            while($data = $prepareQuery->fetch()) {
                $vitalSinInTable = new VitalSigns($data['id_local'], $data['id_patient'] ,$data['temperature'], $data['heart_rate'], $data['oxygen_level'],$data['blood_glucose'], $data['systolic_blood'], $data['diastolic_blood'], $data['vital_hour'], $data['vital_date'], $data['sync_vitalSign']);                
                array_push($allVitalSigns, $vitalSinInTable);
            } 
            return $allVitalSigns;
        } else return null;
    }

    static function getAllVitalSignsForPatient($id_patient) {
        global $db;

        $query = "SELECT * FROM vitalsigns WHERE id_patient = :id_patient ORDER BY id DESC LIMIT 5";
 
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id_patient' => $id_patient
        ]);
        
        $allVitalSigns = [];
        $allVitalSignsReturned = [];
        if($execution) {
            while($data = $prepareQuery->fetch()) {
                $vitalSinInTable = new VitalSigns($data['id_local'], $data['id_patient'] ,$data['temperature'], $data['heart_rate'], $data['oxygen_level'],$data['blood_glucose'], $data['systolic_blood'], $data['diastolic_blood'], $data['vital_hour'], $data['vital_date'], $data['sync_vitalSign']);                
                array_push($allVitalSigns, $vitalSinInTable);
            }

            for ($i = count($allVitalSigns) - 1; $i >= 0; $i--) {
                $allVitalSignsReturned[] = $allVitalSigns[$i];
            }
            return $allVitalSignsReturned;
        } else return null;   
    }

    public function objectToJson() {
        $jsonArray = array(
            'id_local' => $this->id_local,
            'id_patient' => $this->id_patient,
            'temperature' => $this->temperature,
            'heart_rate' => $this->heart_rate,
            'oxygen_level' => $this->oxygen_level,
            'blood_glucose' => $this->blood_glucose,
            'systolic_blood' => $this->systolic_blood,
            'diastolic_blood' => $this->diastolic_blood,
            'vital_hour' => $this->vital_hour,
            'vital_date' => $this->vital_date,
            'sync_vitalSign' => $this->sync_vitalSign
        );

        return $jsonArray;
    }

    // FUNCTION GET ALL DATE AVAILABLE
    static function getAllDatesAvailable() {
        global $db;

        $query = 'SELECT * FROM vitalsigns WHERE 1';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([]);

        $datesVitalSigns = [];
        if($execution) {
            while($data = $prepareQuery->fetch()) {
                array_push($datesVitalSigns, $data['vital_date']);
            }
            return $datesVitalSigns;
        } else return [];
    }

    static function getAllVitalSignsFilterByDate($date1, $date2, $id_patient) {
        global $db;
        $query = "SELECT * FROM vitalsigns WHERE id_patient = :id_patient";
 
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id_patient' => $id_patient
        ]);
        
        $allVitalSigns = [];
        if($execution) {
            while($data = $prepareQuery->fetch()) {
                $dateVital = $data['vital_date'];
                
                if($dateVital >= $date1 && $dateVital <= $date2) {
                    $vitalSinInTable = new VitalSigns($data['id_local'], $data['id_patient'] ,$data['temperature'], $data['heart_rate'], $data['oxygen_level'],$data['blood_glucose'], $data['systolic_blood'], $data['diastolic_blood'], $data['vital_hour'], $data['vital_date'], $data['sync_vitalSign']);                
                    array_push($allVitalSigns, $vitalSinInTable);
                }
            }
            return $allVitalSigns;
        } else return null;   
    }

    // GETTERS
    public function getIdLocal() { return $this->id_local; }
    public function getIdPatient() { return $this->id_patient; }
    public function getTemperature() { return $this->temperature; }
    public function getHeartRate() { return $this->heart_rate; }
    public function getOxygenLevel() { return $this->oxygen_level; }
    public function getBloodGlucose() { return $this->blood_glucose; }
    public function getSystolicBlood() { return $this->systolic_blood; }
    public function getDistolicBlood() { return $this->diastolic_blood; }
    public function getVitalDate() { return $this->vital_date; }
}

?>