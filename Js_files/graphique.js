google.charts.load('current', {'packages':['corechart']}); //  charger des bibliothèques spécifiques de Google Charts
google.charts.setOnLoadCallback (drawChart); 

function drawChart() {
    function fetchDataAndDrawChart() {
        const xhr = new XMLHttpRequest();

        // Définir la fonction de rappel pour gérer la réponse
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) { // Vérifier si la requête est terminée et la réponse est prête
                if (xhr.status === 200) { // Vérifier si la requête s'est terminée avec succès
                    const allVitalSigns  = JSON.parse(xhr.responseText); 

                    var data = new google.visualization.DataTable();
                    // Ajouter des colonnes pour l'heure et la fréquence cardiaque
                    data.addColumn('string', 'Heure');
                    data.addColumn('number', 'Fréquence cardiaque');
                
                    // Boucler à travers les données et les ajouter à la DataTable
                    for (var i = 0; i < allVitalSigns.length; i++) {
                        var vitalSign = allVitalSigns[i];
                        var heure = vitalSign.vital_hour; // Supposant que l'heure est une chaîne de caractères
                        // var heure_display = heure.substring(0, 2);
                        var heartRate = parseFloat(vitalSign.heart_rate); // Supposant que la fréquence cardiaque est un nombre
                
                        // Ajouter une ligne à la DataTable avec l'heure et la fréquence cardiaque
                        data.addRow([heure, heartRate]);
                    }
                
                    var options = {
                        title: 'Fréquence cardiaque',
                        hAxis: {title: 'Heure',  titleTextStyle: {color: '#333'}},
                        vAxis: {minValue: 0}
                    };
                
                    var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
                    chart.draw(data, options);
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
    
    fetchDataAndDrawChart(); // Appeler fetchDataAndDrawChart() initialement

    setInterval(fetchDataAndDrawChart, 5000); // Actualiser les données toutes les 5 secondes (par exemple)
}