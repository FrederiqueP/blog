// console.log("coucou");

const deleteButtons = document.querySelectorAll('.delete-article-button');

// console.log(deleteButtons);

//  for l'élément of le tableau ---
// On parcours les boutons...
for (const button of deleteButtons) {

    // ... et on installe un gestionnaire d'événement au click sur chaque bouton 
    button.addEventListener('click', function(event) {

        // Annulation du comportement par défaut du navigateur (envoyer l'internaute vers l'URL du lien)
        event.preventDefault();
        
       // console.log('On veut supprimer un article !');
        
        // Si l'internaute confirme la suppression
        if (window.confirm('Êtes-vous certain de vouloir supprimer cet article ?')) {
            
            // On récupère l'URL du lien dans l'attribut href de l'élément cliqué
            const url = event.currentTarget.href;

            // On redirige l'internaute vers cette URL
            window.location.assign(url);
        }
    });
}