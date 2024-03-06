<?php

class VitalSign {
    private $id_patient;
    private $temperature;
    private $heart_rate;
    private $oxygen_level;
    private $blood_glucose;
    private $systolic_blood;
    private $diastolic_blood;
    private $vital_date;

    // CONSTRUCT
    public function __construct($id_patient, $temperature, $heart_rate, $oxygen_level, $blood_glucose, $systolic_blood, $diastolic_blood, $vital_date) {
        $this->id_patient = $id_patient;
        $this->temperature = $temperature;
        $this->heart_rate = $heart_rate;
        $this->oxygen_level = $oxygen_level;
        $this->blood_glucose = $blood_glucose;
        $this->systolic_blood = $systolic_blood;
        $this->diastolic_blood = $diastolic_blood;
        $this->vital_date = $vital_date;    
    }

    // FUNCTION CREATE A VITAL SIGN
    public function createVitalSign() {
        global $db;

        $query = 'INSERT INTO vialsigns(id_patient, temperature, heart_rate, oxygen_level, blood_glucose, systolic_blood, diastolic_blood, vital_date) VALUES (:id_patient, :temperature, :heart_rate, :oxygen_level, :blood_glucose, :systolic_blood, :diastolic_blood, :vital_date)';
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([
            ':id_patient' => $this->id_patient,
            ':temperature' => $this->temperature, 
            ':heart_rate' => $this->heart_rate, 
            ':oxygen_level' => $this->oxygen_level, 
            ':blood_glucose' => $this->blood_glucose,
            ':systolic_blood' => $this->systolic_blood, 
            ':diastolic_blood' => $this->diastolic_blood,
            ':vital_date' => $this->vital_date
        ]);

        return $execution ? true : false;
    }

    // FUNCTION GET THE LAST VITALSIGNS
    public function getLastVitalSign() {
        global $db;

        $query = "SELECT * FROM vialsigns ORDER BY vital_hour DESC, vital_date DESC LIMIT 1";
        $prepareQuery = $db->prepare($query);
        $execution = $prepareQuery->execute([]);
        
        if($execution) {
            $data = $prepareQuery->fetch();
            $vitalSign = new VitalSign($data['id_patient'] ,$data['temperature'], $data['heart_rate'], $data['oxygen_level'],$data['blood_glucose'], $data['systolic_blood'], $data['diastolic_blood'], $data['vital_date']);                

            return $vitalSign;
        } else return null;
    }

    // GETTERS
    public function getIdPatient() { return $this->id_patient; }
    public function getTemperature() { return $this->temperature; }
    public function getHeartRate() { return $this->heart_rate; }
    public function getOxygenLevel() { return $this->oxygen_level; }
    public function getBloodGlucose() { return $this->blood_glucose; }
    public function getSystolicBlood() { return $this->systolic_blood; }
    public function getDistolicBlood() { return $this->diastolic_blood; }
    public function getVitalDate() { return $this->vital_date; }

    // SETTERS
}

?>