function fetchDataPatient() {
    const xhr = new XMLHttpRequest();

    // Définir la fonction de rappel pour gérer la réponse
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) { // Vérifier si la requête est terminée et la réponse est prête
            if (xhr.status === 200) { // Vérifier si la requête s'est terminée avec succès
                var dataReceived  = JSON.parse(xhr.responseText); 
                var patient = dataReceived.patientJ;
                var doctor = dataReceived.doctorJ;

                const div_name_age = document.getElementById('div_name_age');
                const div_gender_contact = document.getElementById('div_gender_contact');
                const div_weight_size = document.getElementById('div_weight_size');
                const p_mail_adress = document.getElementById('p_mail_adress');
                const p_commune_quater = document.getElementById('p_commune_quater');
                const d_name = document.getElementById('d_name_doctor');
                const d_mail = document.getElementById('d_mail_doctor');
                const d_phone_number = document.getElementById('d_contact_doctor');
                const orther_info_patient = document.querySelector('.orther_info_patient');
                const no_medecin_classe = document.querySelector('.no_medecin_classe');
            
                // patient information
                var patient_name = patient.patient_name; 
                var patient_postname = patient.patient_postname;
                var patient_surname = patient.patient_surname;
                var patient_age = patient.patient_age;
                var patient_gender = patient.patient_gender;
                var patient_phone_number = patient.patient_phone_number;
                var patient_weight = patient.patient_weight;
                var patient_size = patient.patient_size;
                var patient_mail = patient.patient_mail;
                var patient_commune = patient.patient_commune;
                var patient_quater = patient.patient_quater;

                div_name_age.innerHTML = "Names : "+patient_name+" "+patient_postname+" "+patient_surname+"<br> Age : "+patient_age;    
                div_gender_contact.innerHTML = "Genre : "+patient_gender+"<br> Contact : "+patient_phone_number;
                div_weight_size.innerHTML = "Poids : "+patient_weight+" kg <br> Taille : "+patient_size+" m"
                p_mail_adress.innerHTML = patient_mail;
                p_commune_quater.innerHTML ="Commune : "+patient_commune+"; Quater : "+patient_quater;

                // doctor information
                if(!(doctor == "no doctor found")) {
                    var doctor_name = doctor.doctor_name;
                    var doctor_mail = doctor.doctor_mail;
                    var doctor_phone_number = doctor.doctor_phone_number;

                    d_name.innerHTML = "Name : "+doctor_name;
                    d_mail.innerHTML = "Mail : "+doctor_mail;
                    d_phone_number.innerHTML = "Contact : "+doctor_phone_number;

                } else {
                    no_medecin_classe.style.display='block';
                    orther_info_patient.style.display='none';
                }

            } else {
                console.error('Erreur lors de la récupération des données:', xhr.status);
            }
        }
    };

    xhr.onerror = () => {
        alert('Erreur lors du chargement des signes vitaux');
    };

    // Envoyer la requête au serveur pour récupérer les données JSON
    xhr.open('GET', '../Controllers/c_patientInformationForTuteur.php', true); // Ouvrir une connexion en spécifiant la méthode HTTP et l'URL du contrôleur
    xhr.send();
}

fetchDataPatient(); // Appeler fetchDataAndDisplay() initialement

setInterval(fetchDataPatient, 5000); // Actualiser les données toutes les 5 secondes (par exemple)