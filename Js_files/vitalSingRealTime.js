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

                    if(allVitalSigns.length !== 0) {
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
        xhr.open('GET', '../Controllers/c_graphique.php', true); // Ouvrir une connexion en spécifiant la méthode HTTP et l'URL du contrôleur
        xhr.send();
    }

    fetchDataVitalSign(); // Appeler fetchDataAndDisplay() initialement
    setInterval(fetchDataVitalSign, 5000); // Actualiser les données toutes les 5 secondes (par exemple)