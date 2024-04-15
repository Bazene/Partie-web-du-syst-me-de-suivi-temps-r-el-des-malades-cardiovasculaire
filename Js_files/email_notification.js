function fetchDataVitalSign() {
    const xhr = new XMLHttpRequest();

    // Définir la fonction de rappel pour gérer la réponse
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) { // Vérifier si la requête est terminée et la réponse est prête
            if (xhr.status === 200) { // Vérifier si la requête s'est terminée avec succès
                const allVitalSigns  = JSON.parse(xhr.responseText); 

                if(allVitalSigns.length != 0) {
                    const size_all = (allVitalSigns.length) - 1 ;
                    var vitalSign = allVitalSigns[size_all];
                    
                    // vital sign
                    var heart_rate = vitalSign.heart_rate; 
                    var spo2 = vitalSign.oxygen_level;
                    var temperature = vitalSign.temperature;
                    var blood_glucose = vitalSign.blood_glucose;
                    var systolic_blood = vitalSign.systolic_blood;
                    var diastolic_blood = vitalSign.diastolic_blood;

                    // notification information
                    var id_patient = vitalSign.id_patient;
                    var notification_date = vitalSign.vital_date;
                    var notification_hour = vitalSign.vital_hour;
                    
                    // Vérifier les conditions pour envoyer un e-mail à l'utilisateur et faire une insertion dans la base
                    if (temperature > 0) {
                        var message = "Temperature : "+temperature+" *C";

                        // insertNotificationIntoTable(id_patient, message, notification_date, notification_hour);
                        // sendEmailToUser(id_patient, "temperature", temperature, notification_date, notification_hour);
                    } 
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
    // xhr.open('GET', '../Controllers/c_graphique.php', true); // Ouvrir une connexion en spécifiant la méthode HTTP et l'URL du contrôleur
    xhr.send();
}

fetchDataVitalSign(); // Appeler fetchDataAndDisplay() initialement
setInterval(fetchDataVitalSign, 10000); // Actualiser les données toutes les 5 secondes (par exemple)


// Fonction pour insérer les données dans une table via AJAX
function insertNotificationIntoTable(ID_PATIENT, MESSAGE, NOTIFICATION_DATE, NOTIFICATION_HOUR) {
    const xhr = new XMLHttpRequest();

    // Préparer les données à envoyer au serveur (à adapter selon votre besoin)
    const postData = JSON.stringify({
        id_patient : ID_PATIENT,
        not_content : MESSAGE,
        not_date : NOTIFICATION_DATE,
        not_hour : NOTIFICATION_HOUR
    });

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log('Données insérées avec succès dans la table.');
            } else {
                console.error('Erreur lors de l\'insertion des données:', xhr.status);
            }
        }
    };

    xhr.onerror = () => {
        console.error('Erreur lors de la requête d\'insertion des données.');
    };

    // Envoyer les données à votre script PHP pour l'insertion dans la table
    xhr.open('POST', '../Controllers/insert_notification.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(postData);
}

// Fonction pour envoyer un e-mail à l'utilisateur via AJAX
function sendEmailToUser(ID_PATIENT, NAME_VITAL_SIGN, VITAL_SIGN_VALUE, NOTIFICATION_DATE, NOTIFICATION_HOUR) {
    const xhr = new XMLHttpRequest();

    const postData = JSON.stringify({
        id_patient : ID_PATIENT,
        name_vital_sign : NAME_VITAL_SIGN,
        value_vital_sign : VITAL_SIGN_VALUE,
        not_date : NOTIFICATION_DATE,
        not_hour : NOTIFICATION_HOUR
    });

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log('E-mail envoyé avec succès');
            } else {
                console.error('Erreur lors de l\'envoi de l\'e-mail:', xhr.status);
            }
        }
    };

    xhr.onerror = () => {
        console.error('Erreur lors de la requête d\'envoi d\'e-mail.');
    };

    // Envoyer les données à votre script PHP pour l'envoi de l'e-mail
    xhr.open('POST', '../Controllers/send_email.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(postData);
}