function fetchDataPatient() {
    const xhr = new XMLHttpRequest();

    // Définir la fonction de rappel pour gérer la réponse
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) { // Vérifier si la requête est terminée et la réponse est prête
            if (xhr.status === 200) { // Vérifier si la requête s'est terminée avec succès
                var dataReceived  = JSON.parse(xhr.responseText); 
                var patient = dataReceived.patientJ;
                var tuteur = dataReceived.tuteurJ;

                const div_name_age = document.getElementById('div_name_age');
                const div_gender_contact = document.getElementById('div_gender_contact');
                const div_weight_size = document.getElementById('div_weight_size');
                const p_mail_adress = document.getElementById('p_mail_adress');
                const p_commune_quater = document.getElementById('p_commune_quater');
                const t_name = document.getElementById('p_name_tuteur');
                const t_mail = document.getElementById('p_mail_tuteur');
                const t_phone_number = document.getElementById('p_contact_tuteur');
                const t_gender = document.getElementById('p_gender_tuteur');
                const orther_info_patient = document.querySelector('.orther_info_patient');
                const no_tuteur_classe = document.querySelector('.no_tuteur_classe');
                const btn_add_tuteur = document.querySelector('.btn_add_tuteur');
            
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

                // tuteur information
                if(!(tuteur == "no tuteur added")) {
                    var tuteur_name = tuteur.tuteur_name;
                    var tuteur_mail = tuteur.tuteur_mail;
                    var tuteur_phone_number = tuteur.tuteur_phone_number;
                    var tuteur_gender = tuteur.tuteur_gender;

                    t_name.innerHTML = "Name : "+tuteur_name;
                    t_mail.innerHTML = "Mail : "+tuteur_mail;
                    t_phone_number.innerHTML = "Contact : "+tuteur_phone_number;
                    t_gender.innerHTML = "Genre : "+tuteur_gender;

                    btn_add_tuteur.style.display='none';

                } else {
                    no_tuteur_classe.style.display='block';
                    orther_info_patient.style.display='none';
                    btn_add_tuteur.style.display='block';
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
    xhr.open('GET', '../Controllers/c_patientInformation.php', true); // Ouvrir une connexion en spécifiant la méthode HTTP et l'URL du contrôleur
    xhr.send();
}

fetchDataPatient(); // Appeler fetchDataAndDisplay() initialement
setInterval(fetchDataPatient, 5000); // Actualiser les données toutes les 5 secondes