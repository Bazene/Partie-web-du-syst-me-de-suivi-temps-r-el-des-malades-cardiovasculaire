function fetchDataVitalSign() {
    const xhr = new XMLHttpRequest();

    // Définir la fonction de rappel pour gérer la réponse
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) { // Vérifier si la requête est terminée et la réponse est prête
            if (xhr.status === 200) { // Vérifier si la requête s'est terminée avec succès
                const allVitalSigns  = JSON.parse(xhr.responseText); 
                
                const span_heart_rate = document.getElementById('span_heart_rate');
                const span_spo2 = document.getElementById('span_spo2');
                const span_temperature = document.getElementById('span_temperature');
                const span_glycemie = document.getElementById('span_glycemie');
                const span_pression = document.getElementById('span_pression');
                const state_hz = document.getElementById('state_hz');
                const state_spo2 = document.getElementById('state_spo2');
                const state_temp = document.getElementById('state_temp');
                const state_glycemie = document.getElementById('state_glycemie');
                const state_pression = document.getElementById('state_pression');

                const size_all = (allVitalSigns.length) - 1 ;
                var vitalSign = allVitalSigns[size_all];
                
                var heart_rate = vitalSign.heart_rate; 
                var spo2 = vitalSign.oxygen_level;
                var temp = vitalSign.temperature;
                var temperature = Math.round(temp* 10) / 10;
                var blood_glucose = vitalSign.blood_glucose;
                var systolic_blood = vitalSign.systolic_blood;
                var diastolic_blood = vitalSign.diastolic_blood;

                span_heart_rate.innerHTML = heart_rate;    
                span_spo2.innerHTML = spo2;
                span_temperature.innerHTML = temperature;   
                span_glycemie.innerHTML = blood_glucose;    
                span_pression.innerHTML = systolic_blood+"/"+diastolic_blood;  

                // state for heart rate
                if(heart_rate >= 50 && heart_rate <= 100) {
                    state_hz.innerHTML = "Normale";
                } else if (heart_rate < 50) {
                    state_hz.innerHTML = "Faible";
                } else {
                    state_hz.innerHTML = "Elevé";
                }

                // state for spo2
                if(spo2 >= 90 && spo2 <= 100 ) {
                    state_spo2.innerHTML = "Normale";
                } else if (spo2 < 90){
                    state_spo2.innerHTML = "Faible";
                }

                // for temperature
                if(temperature >= 36.0 && temperature <= 38.0) {
                    state_temp.innerHTML = "Normale";
                } else if (temperature < 36.0) {
                    state_temp.innerHTML = "Faible";
                } else if(temperature > 38) {
                    state_temp.innerHTML = "Elevé";
                }

                // for glycemie
                if(blood_glucose <= 110 && blood_glucose >= 70) {
                    state_glycemie.innerHTML = "Normale";
                } else if(blood_glucose > 110) {
                    state_glycemie.innerHTML = "Elevé";
                } else if(blood_glucose < 70) {
                    state_glycemie.innerHTML ="Faible";
                }

                // for pression
                if((systolic_blood <= 126 && systolic_blood >= 108) && (diastolic_blood <= 83 && diastolic_blood >= 75)) {
                    state_pression.innerHTML = "Normale" ;                   
                } else if(systolic_blood < 108 && diastolic_blood < 75) {
                    state_pression.innerHTML = "Faible";
                } else if(systolic_blood < 108 || diastolic_blood < 75) {
                    state_pression.innerHTML = "Faible";
                } else if(systolic_blood > 126 && diastolic_blood > 83) {
                    state_pression.innerHTML = "Elevé";
                } else if(systolic_blood > 126 || diastolic_blood > 83) {
                    state_pression.innerHTML = "Elevé";
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
    xhr.open('GET', '../Controllers/c_donneesPatientRealTimeForTuteur.php', true); // Ouvrir une connexion en spécifiant la méthode HTTP et l'URL du contrôleur
    xhr.send();
}

fetchDataVitalSign(); // Appeler fetchDataAndDisplay() initialement
setInterval(fetchDataVitalSign, 5000); // Actualiser les données toutes les 5 secondes (par exemple)