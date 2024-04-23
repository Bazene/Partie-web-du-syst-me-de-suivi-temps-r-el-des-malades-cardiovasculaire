function fetchDatesVitalSign() {
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Parse la réponse JSON pour obtenir les dates disponibles
                var datesAvailables = JSON.parse(xhr.responseText);

                // Configuration du datepicker avec les dates disponibles
                $('.date_filtre1').datepicker({
                    dateFormat: 'yy-mm-dd',
                    beforeShowDay: function(date) {
                        var stringDate = $.datepicker.formatDate('yy-mm-dd', date);
                        return [datesAvailables.includes(stringDate)];
                    }
                });

                $('.date_filtre2').datepicker({
                    dateFormat: 'yy-mm-dd',
                    beforeShowDay: function(date) {
                        var stringDate = $.datepicker.formatDate('yy-mm-dd', date);
                        return [datesAvailables.includes(stringDate)];
                    }
                });

            } else {
                console.error('Erreur lors de la récupération des dates disponibles:', xhr.status);
            }
        }
    };

    xhr.onerror = () => {
        alert('Erreur lors du chargement des dates disponibles');
    };

    // Envoyer la requête au serveur pour récupérer les dates disponibles
    xhr.open('GET', '../Controllers/c_getAllDatesVitalSigns.php', true);
    xhr.send();
}

fetchDatesVitalSign(); // Appeler fetchDataAndDisplay() initialement

setInterval(fetchDatesVitalSign, 5000); // Actualiser les données toutes les 5 secondes