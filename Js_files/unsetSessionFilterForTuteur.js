const btn_realtime = document.querySelector('.btn_realtime');
const btn_submit_filter = document.querySelector('.btn_submit_filter');
const date_filtre1 = document.querySelector('.date_filtre1');
const date_filtre2 = document.querySelector('.date_filtre2');

btn_realtime.addEventListener('click', function() {
    // Exemple d'envoi des données avec fetch (AJAX)
    fetch('../Controllers/c_unsetSessionFilter.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            yes: 1
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Réponse du réseau incorrecte');
        } 
        return response.json(); // Renvoie une promesse pour le résultat JSON
    })
    .then(data => {
        // Gérer la réponse du serveur si nécessaire
        date_filtre1.value = "aaaa-mm-jj";
        date_filtre2.value = "aaaa-mm-jj";
        console.log('Réponse du serveur:', data);
    })
    .catch(error => {
        console.error('Erreur lors de l\'envoi des données:', error);
    });
});

btn_submit_filter.addEventListener('click', function() {
    var val1 = date_filtre1.value;
    var val2 = date_filtre2.value;
 
    console.log("Val1 :", val1);
    console.log("Val2 :", val2);
 
    
     // Vous pouvez également envoyer ces valeurs à un serveur via une requête AJAX
     // Exemple d'envoi des données avec fetch (AJAX)
     fetch('../Controllers/c_dataFilterForTuteur.php', {
         method: 'POST',
         headers: {
             'Content-Type': 'application/json'
         },
         body: JSON.stringify({
             date1: val1,
             date2: val2
         })
     })
     .then(response => {
         if (!response.ok) {
             throw new Error('Réponse du réseau incorrecte');
         }
         return response.json(); // Renvoie une promesse pour le résultat JSON
     })
     .then(data => {
         // Gérer la réponse du serveur si nécessaire
         console.log('Réponse du serveur:', data);
     })
     .catch(error => {
         console.error('Erreur lors de l\'envoi des données:', error);
     });
 });