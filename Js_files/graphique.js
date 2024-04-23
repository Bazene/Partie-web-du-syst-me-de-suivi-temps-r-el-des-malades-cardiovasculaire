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

                    var heartRateGraphData = new google.visualization.DataTable(); // for heart rate
                    var spo2GraphData = new google.visualization.DataTable(); // for spo2
                    var tempGraphData = new google.visualization.DataTable(); // for temperature

                    // 1 - FOR HEARTE RATE
                    // Ajouter des colonnes pour l'heure et la fréquence cardiaque
                    heartRateGraphData.addColumn('string', 'Heure');
                    heartRateGraphData.addColumn('number', 'Fréquence cardiaque');
                    heartRateGraphData.addColumn('number', 'Moyenne Fréquence cardiaque'); // Nouvelle série pour la moyenne

                    // Boucler à travers les données et les ajouter à la DataTable
                    var totalHeartRate = 0;
                    for (var i = 0; i < allVitalSigns.length; i++) {
                        var vitalSign = allVitalSigns[i];
                        var heure = vitalSign.vital_hour; // affichage juste en heure et munites
                        var heartRate = parseFloat(vitalSign.heart_rate); // Supposant que la fréquence cardiaque est un nombre
                        
                        // Ajouter une ligne à la DataTable avec l'heure et la fréquence cardiaque
                        heartRateGraphData.addRow([heure, heartRate, null]);
                        totalHeartRate += parseFloat(vitalSign.heart_rate); // pour le calcul ultérieur de la moyenne
                    }

                    // Calculer la moyenne globale du heartRate
                    var averageHeartRate = totalHeartRate / allVitalSigns.length;

                    // Mettre à jour la colonne de moyenne dans la DataTable avec la moyenne calculée
                    for (var i = 0; i < heartRateGraphData.getNumberOfRows(); i++) {
                        heartRateGraphData.setValue(i, 2, averageHeartRate); // Mettre à jour la colonne de moyenne
                    }

                    // Créer une DataTable pour la moyenne
                    var averageData = new google.visualization.DataTable();
                    averageData.addColumn('string', 'Heure');
                    averageData.addColumn('number', 'Moyenne Fréquence cardiaque');
                    averageData.addRow(['Moyenne', averageHeartRate]);

                    var options1 = {
                        title: 'Fréquence cardiaque',
                        hAxis: {title: 'Heure',  titleTextStyle: {color: '#333'}},
                        vAxis: {minValue: 0},
                        series: {
                            0: { type: 'area'}, // Série pour les données brutes
                            1: { type: 'line', color: '#B987AD', lineWidth: 2 } // Série pour la moyenne (ligne rouge)
                        }
                    };
                    
                    // 2 - FOR SPO2
                    // Ajouter des colonnes pour l'heure, la SpO2 et la moyenne
                    spo2GraphData.addColumn('string', 'Heure');
                    spo2GraphData.addColumn('number', 'SpO2');
                    spo2GraphData.addColumn('number', 'Moyenne SpO2'); // Nouvelle série pour la moyenne

                    var totalSpO2 = 0;
                    for (var i = 0; i < allVitalSigns.length; i++) {
                        var vitalSign = allVitalSigns[i];
                        var heure = vitalSign.vital_hour; // affichage juste en heure et munites
                        var SpO2 = parseFloat(vitalSign.oxygen_level);
                        
                        // Ajouter une ligne à la DataTable avec l'heure et la fréquence cardiaque
                        spo2GraphData.addRow([heure, SpO2, null]);
                        totalSpO2 += parseFloat(vitalSign.oxygen_level); 
                    }

                    // Calculer la moyenne globale du heartRate
                    var averageSpO2 = totalSpO2 / allVitalSigns.length;

                    // Mettre à jour la colonne de moyenne dans la DataTable avec la moyenne calculée
                    for (var i = 0; i < spo2GraphData.getNumberOfRows(); i++) {
                        spo2GraphData.setValue(i, 2, averageSpO2); // Mettre à jour la colonne de moyenne
                    }

                    // Créer une DataTable pour la moyenne
                    var averageDataSpo2 = new google.visualization.DataTable();
                    averageDataSpo2.addColumn('string', 'Heure');
                    averageDataSpo2.addColumn('number', 'Moyenne SpO2');
                    averageDataSpo2.addRow(['Moyenne', averageSpO2]);

                    var options2 = {
                        title: 'Saturation pulsée en Oxygène',
                        hAxis: {title: 'Heure',  titleTextStyle: {color: '#333'}},
                        vAxis: {minValue: 0},
                        series: {
                            0: { type: 'area', color:'#F8DEBD' }, // Série pour les données brutes
                            1: { type: 'line', color: '#C67915', lineWidth: 2 } // Série pour la moyenne (ligne rouge)
                        }
                    };

                    // 3 - FOR TEMPERATURE
                    // Ajouter des colonnes pour l'heure, la SpO2 et la moyenne
                    tempGraphData.addColumn('string', 'Heure');
                    tempGraphData.addColumn('number', 'Température');
                    tempGraphData.addColumn('number', 'Moyenne Température'); // Nouvelle série pour la moyenne

                    var totalTemp = 0;
                    for (var i = 0; i < allVitalSigns.length; i++) {
                        var vitalSign = allVitalSigns[i];
                        var heure = vitalSign.vital_hour; // affichage juste en heure et munites
                        var temp = parseFloat(vitalSign.temperature);
                        
                        // Ajouter une ligne à la DataTable avec l'heure et la fréquence cardiaque
                        tempGraphData.addRow([heure, temp, null]);
                        totalTemp += parseFloat(vitalSign.temperature);
                    }

                    // Calculer la moyenne globale du heartRate
                    var averageTemp = totalTemp / allVitalSigns.length;

                    // Mettre à jour la colonne de moyenne dans la DataTable avec la moyenne calculée
                    for (var i = 0; i < tempGraphData.getNumberOfRows(); i++) {
                        tempGraphData.setValue(i, 2, averageTemp); // Mettre à jour la colonne de moyenne
                    }

                    // Créer une DataTable pour la moyenne
                    var averageDataTemp = new google.visualization.DataTable();
                    averageDataTemp.addColumn('string', 'Heure');
                    averageDataTemp.addColumn('number', 'Moyenne Température');
                    averageDataTemp.addRow(['Moyenne', averageTemp]);

                    var options3 = {
                        title: 'Température',
                        hAxis: {title: 'Heure',  titleTextStyle: {color: '#333'}},
                        vAxis: {minValue: 0},
                        series: {
                            0: { type: 'area', color:'#F9C4C3' }, // Série pour les données brutes
                            1: { type: 'line', color: '#FD8A88', lineWidth: 2 } // Série pour la moyenne (ligne rouge)
                        }
                    };

                    // DRAW GRAPHS
                    var chartHB = new google.visualization.AreaChart(document.getElementById('chart_div'));
                    var chartSpo2 = new google.visualization.AreaChart(document.getElementById('chart_spo2'));
                    var chartTemp = new google.visualization.AreaChart(document.getElementById('chart_temp'));

                    chartHB.draw(heartRateGraphData, options1);
                    chartSpo2.draw(spo2GraphData, options2);
                    chartTemp.draw(tempGraphData, options3);
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