CREATE TABLE limitesvitalsignspatient (
    id_patient INT PRIMARY KEY,           -- Patient ID, assuming it's unique per patient
    min_temp DECIMAL(4, 2),               -- Minimum temperature with 2 decimal places
    max_temp DECIMAL(4, 2),               -- Maximum temperature with 2 decimal places
    min_spo2 TINYINT UNSIGNED,            -- Minimum SpO2 level (0-255 if unsigned)
    max_spo2 TINYINT UNSIGNED,            -- Maximum SpO2 level (0-255 if unsigned)
    min_heartRate TINYINT UNSIGNED,       -- Minimum heart rate (0-255 if unsigned)
    max_heartRate TINYINT UNSIGNED,       -- Maximum heart rate (0-255 if unsigned)
    min_pression DECIMAL(5, 2),           -- Minimum blood pressure with 2 decimal places
    max_pression DECIMAL(5, 2),           -- Maximum blood pressure with 2 decimal places
    min_glucose DECIMAL(5, 2),            -- Minimum glucose level with 2 decimal places
    max_glucose DECIMAL(5, 2)             -- Maximum glucose level with 2 decimal places
);

CREATE TABLE admin_user (
    id INT NOT NULL AUTO_INCREMENT,
    admin_name VARCHAR(100) NOT NULL, 
    admin_postname VARCHAR(100) NOT NULL, 
    admin_surname VARCHAR(100) NOT NULL, 
    admin_gender VARCHAR(30) NOT NULL,
    admin_mail VARCHAR(150) NOT NULL,
    admin_phone_number VARCHAR(20) NOT NULL,
    admin_password VARCHAR(200) NOT NULL,
    admin_picture VARCHAR(500),
    admin_role VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE patient (
    id INT NOT NULL AUTO_INCREMENT,
    id_doctor INT,
    id_doctor_archived INT,
    patient_name VARCHAR(100) NOT NULL, 
    patient_postname VARCHAR(100) NOT NULL, 
    patient_surname VARCHAR(100) NOT NULL, 
    patient_gender VARCHAR(30) NOT NULL,
    patient_mail VARCHAR(150) NOT NULL,
    patient_phone_number VARCHAR(20) NOT NULL,
    patient_password VARCHAR(200) NOT NULL,
    patient_picture VARCHAR(500), 
    patient_commune VARCHAR(100), 
    patient_quater VARCHAR(100), 
    patient_date_created DATETIME NOT NULL,
    patient_age INT NOT NULL, 
    patient_size FLOAT,
    patient_weight FLOAT,
    patient_role VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE vialsigns (
    id INT NOT NULL AUTO_INCREMENT,
    id_patient INT NOT NULL,
    temperature FLOAT,
    heart_rate INT,
    oxygen_level INT,
    blood_glucose INT,
    systolic_blodd INT,
    distolic_blood INT,
    vital_date DATETIME NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (id_patient) REFERENCES patient(id)
);

CREATE TABLE notifications (
    id INT NOT NULL AUTO_INCREMENT,
    id_patient INT NOT NULL,
    notification_content VARCHAR(300),
    notification_date DATETIME NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (id_patient) REFERENCES patient(id)
);

CREATE TABLE doctor (
    id INT NOT NULL AUTO_INCREMENT,
    doctor_name VARCHAR(100) NOT NULL, 
    doctor_postname VARCHAR(100) NOT NULL, 
    doctor_surname VARCHAR(100) NOT NULL, 
    doctor_gender VARCHAR(30) NOT NULL,
    doctor_mail VARCHAR(150) NOT NULL,
    doctor_phone_number VARCHAR(20) NOT NULL,
    doctor_password VARCHAR(200) NOT NULL,
    doctor_picture VARCHAR(500), 
    doctor_date_created DATETIME NOT NULL,
    doctor_speciality VARCHAR(150) NOT NULL,
    doctor_hospital VARCHAR(150) NOT NULL,
    doctor_role VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE tuteur (
    id INT NOT NULL AUTO_INCREMENT,
    id_patient INT NOT NULL,
    tuteur_name VARCHAR(100) NOT NULL, 
    tuteur_postname VARCHAR(100) NOT NULL, 
    tuteur_surname VARCHAR(100) NOT NULL, 
    tuteur_gender VARCHAR(30) NOT NULL,
    tuteur_mail VARCHAR(150) NOT NULL,
    tuteur_phone_number VARCHAR(20) NOT NULL,
    tuteur_password VARCHAR(200) NOT NULL,
    tuteur_picture VARCHAR(500), 
    tuteur_date_created DATETIME NOT NULL, 
    tuteur_role VARCHAR(50) NOT NULL,
    relontionship_type VARCHAR(50) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_patient) REFERENCES patient(id)
);
