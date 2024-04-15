function fetchDataNotifications() {
    const xhr = new XMLHttpRequest();

    // Définir la fonction de rappel pour gérer la réponse
    xhr.onreadystatechange = function() {
        if(xhr.readyState === XMLHttpRequest.DONE) { // check if the request is done, and the ansewer is ready
            if(xhr.status === 200) { // check if the request is finishe with success
                var dataReceived = JSON.parse(xhr.responseText);

                const p_nbr_notification = document.getElementById('nbr_notification');
                const normal_icone = document.getElementById('normal_icone');
                const icone_show_notification = document.getElementById('icone_show_notification');

                var nbr_notifications = dataReceived.nbr_notifications;
                p_nbr_notification.innerHTML = nbr_notifications;

                if(nbr_notifications >= 1) {
                    p_nbr_notification.style.display = 'block';
                    icone_show_notification.style.display = 'inline-block'
                    normal_icone.style.display = 'none';
                } else {
                    p_nbr_notification.style.display = 'none';
                    icone_show_notification.style.display = 'none'
                    normal_icone.style.display = 'inline-block';
                }

            } else {
                console.error('Erreur lors de la récupération des données:', xhr.status);
            }
        }
    }

    // send request to server for taking data on JSON format
    xhr.open('GET', '../Controllers/c_notifications.php', true); // Open the connexion and spicify the HTTP method and a url of the controller
    xhr.send();
}

fetchDataNotifications(); // call the function for the first time
setInterval(fetchDataNotifications, 5000); // Loading data every 5 secondes