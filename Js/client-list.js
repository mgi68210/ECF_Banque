// Quand toute la page HTML est chargée...
document.addEventListener("DOMContentLoaded", function () {

    // Je sélectionne tous les boutons de suppression des clients
    const boutonsSuppression = document.querySelectorAll(".btn-delete-client");

    // Je parcours chacun de ces boutons
    boutonsSuppression.forEach(function (bouton) {

        // J'écoute l'événement "clic" sur ce bouton
        bouton.addEventListener("click", function (event) {

            // Je remonte dans le DOM pour trouver la ligne <tr> contenant le bouton cliqué
            const ligneClient = bouton.closest("tr");

            // Je récupère l'ID du client depuis l'attribut personnalisé data-id
            const idClient = ligneClient.dataset.id;

            // Je regarde aussi si ce client possède des comptes/contrats (data-has-comptes = "1")
            const aDesComptes = ligneClient.dataset.hasComptes === "1";

            // Je prépare un message d’avertissement à afficher à l'utilisateur
            let message = "⚠️ Attention : La suppression de ce client entraînera également la suppression de tous ses comptes et contrats associés.";

            // Si le client a effectivement des comptes, j'ajoute une alerte plus explicite
            if (aDesComptes) {
                message += "\nCe client possède des comptes ou des contrats qui seront supprimés définitivement.";
            }

            // J’ajoute une question de confirmation à la fin du message
            message += "\n\nÊtes-vous sûr de vouloir continuer ?";

            // J'affiche le message avec une boîte de dialogue de confirmation
            const confirmation = confirm(message);

            // Si l'utilisateur clique sur "Annuler", j'empêche le lien de fonctionner
            if (!confirmation) {
                event.preventDefault(); // Empêche la redirection vers la suppression
            }

            // Sinon (si l'utilisateur confirme), la redirection se fera normalement
            // La suppression sera gérée par PHP côté serveur
        });
    });
});
