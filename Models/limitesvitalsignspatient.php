<?php 

class Limitesvitalsignspatient {
    private $id_patient;
    private $min_temp;	
    private $max_temp;
    private $min_spo2;	
    private $max_spo2;	
    private $min_heartRate;	
    private $max_heartRate;	
    private $min_pression;	
    private $max_pression;	
    private $min_glucose;	
    private $max_glucose;

    public function __construct($id_patient, $min_temp, $max_temp, $min_spo2, $max_spo2, $min_heartRate, $max_heartRate, $min_pression, $max_pression, $min_glucose, $max_glucose) {
        $this->id_patient = $id_patient;
        $this->min_temp = $min_temp;
        $this->max_temp = $max_temp;
        $this->min_spo2 = $min_spo2;
        $this->max_spo2 = $max_spo2;
        $this->min_heartRate = $min_heartRate;
        $this->max_heartRate = $max_heartRate;
        $this->min_pression = $min_pression;
        $this->max_pression = $max_pression;
        $this->min_glucose = $min_glucose;
        $this->max_glucose = $max_glucose;
    }

    public function createLimitesVitalSign() {
        global $db;

        $query = 'INSERT INTO limitesvitalsignspatient(id_patient, min_temp, max_temp, min_spo2, max_spo2, min_heartRate, max_heartRate, min_pression, max_pression, min_glucose, max_glucose) VALUES(:id_patient, :min_temp, :max_temp, :min_spo2, :max_spo2, :min_heartRate, :max_heartRate, :min_pression, :max_pression, :min_glucose, :max_glucose)';
        $prepare_query = $db->prepare($query);
        $exection = $prepare_query->execute([
            ':id_patient' => $this->id_patient, 
            ':min_temp' => $this->min_temp, 
            ':max_temp' => $this->max_temp, 
            ':min_spo2' => $this->min_spo2, 
            ':max_spo2' => $this->max_spo2, 
            ':min_heartRate' => $this->min_heartRate, 
            ':max_heartRate' => $this->max_heartRate, 
            ':min_pression' => $this->min_pression, 
            ':max_pression' => $this->max_pression, 
            ':min_glucose' => $this->min_glucose, 
            ':max_glucose' => $this->max_glucose
        ]);

        return $exection ? true : false;
    }

    static function updateLimitesVitalSign($id_patient, $min_temp, $max_temp, $min_spo2, $max_spo2, $min_heartRate, $max_heartRate, $min_pression, $max_pression, $min_glucose, $max_glucose) {
        global $db;

        $query = 'UPDATE limitesvitalsignspatient SET min_temp=:min_temp, max_temp=:max_temp, min_spo2=:min_spo2, max_spo2=:max_spo2, min_heartRate=:min_heartRate, max_heartRate=:max_heartRate, min_pression=:min_pression, max_pression=:max_pression, min_glucose=:min_glucose, max_glucose=:max_glucose WHERE id_patient = :id_patient';
        $prepare_query = $db->prepare($query);
        $execution = $prepare_query->execute([
            ':id_patient' => $id_patient, 
            ':min_temp' => $min_temp, 
            ':max_temp' => $max_temp, 
            ':min_spo2' => $min_spo2, 
            ':max_spo2' => $max_spo2, 
            ':min_heartRate' => $min_heartRate, 
            ':max_heartRate' => $max_heartRate, 
            ':min_pression' => $min_pression, 
            ':max_pression' => $max_pression, 
            ':min_glucose' => $min_glucose, 
            ':max_glucose' => $max_glucose
        ]);

        return $execution ? true : false;
    }

    static function getLimitesForPatient($id_patient) {
        global $db;

        $query = 'SELECT * FROM limitesvitalsignspatient WHERE id_patient = :id_patient';
        $prepare_query = $db->prepare($query);
        $execution = $prepare_query->execute([
            ':id_patient' => $id_patient
        ]);

        if($execution) {
            if($data = $prepare_query->fetch()) {
                $limitesvitalsigns = new Limitesvitalsignspatient($data['id_patient'], $data['min_temp'], $data['max_temp'], $data['min_spo2'], $data['max_spo2'], $data['min_heartRate'], $data['max_heartRate'], $data['min_pression'], $data['max_pression'], $data['min_glucose'], $data['max_glucose']);
                return $limitesvitalsigns;
            } else return null;
        } else return null;
    }

    // GETTERS
    public function getId_patient() {return $this->id_patient;}
    public function getMin_temp() {return $this->min_temp;}
    public function getMax_temp() {return $this->max_temp;}
    public function getMin_spo2() {return $this->min_spo2;}
    public function getMax_spo2() {return $this->max_spo2;}
    public function getMin_heartRate() {return $this->min_heartRate;}
    public function getMax_heartRate() {return $this->max_heartRate;}
    public function getMin_pression() {return $this->min_pression;}
    public function getMax_pression() {return $this->max_pression;}
    public function getMin_glucose() {return $this->min_glucose;}
    public function getMax_glucose() {return $this->max_glucose;}
}
?>