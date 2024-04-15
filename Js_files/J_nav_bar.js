// Récupération du chemin de l'URL actuelle
const currentPath = window.location.pathname;
const notification_link_formuler = document.querySelector('.notification_link_formuler');

// Vérifier si currentPath est défini avant d'accéder à ses propriétés
const name_page = currentPath ? currentPath.substring(currentPath.lastIndexOf('/') + 1) : null; // on récupère seulement le nom de la page

if(name_page !== null) {
  // Récupération des liens de navigation

  const links = document.querySelectorAll('.nav_bar a');

  // Parcours des liens pour trouver le lien correspondant à la page actuelle
  links.forEach(link => {
    const linkPath = link.getAttribute('href');
    const parts = linkPath.split('/'); // Séparation du chemin en un tableau en utilisant le délimiteur '/'
    const name_page_html = parts[parts.length - 1]; // Récupération du dernier élément (le nom du fichier)

    if (name_page_html === name_page) {
      link.classList.add('current_page'); // Ajout de la classe pour mettre en évidence le lien
    }

    if(name_page === "notifications.php") {
      notification_link_formuler.classList.add('current_page');
    }
  });
}


notification_link_formuler.addEventListener('click', function(event) {
  
  var submitButton = div_notification.querySelector('input[type="submit"]');
  if(submitButton) {
    submitButton.click(); // Simuler un clic sur le bouton de soumission du formulaire
  }
});