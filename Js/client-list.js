document.addEventListener("DOMContentLoaded", function () {
    // Je récupère tous les boutons avec la classe .btn-delete-client
    const boutonsSuppression = document.querySelectorAll(".btn-delete-client");

    // Je parcours chaque bouton pour lui ajouter un écouteur de clic
    boutonsSuppression.forEach(function (bouton) {
        bouton.addEventListener("click", function (event) {
            // Je remonte jusqu'à la ligne <tr> du tableau où se trouve ce bouton
            const ligneClient = bouton.closest("tr");

            // Je récupère l'ID du client dans les attributs personnalisés de la ligne
            const idClient = ligneClient.dataset.id;

            // Je vérifie s'il a au moins un compte ou contrat (hasComptes vaut "1")
            const aDesComptes = ligneClient.dataset.hasComptes === "1";

            // Si le client a un compte ou contrat, je bloque la suppression
            if (aDesComptes) {
                alert("❌ Ce client ne peut pas être supprimé car il possède au moins un compte ou contrat.");
                event.preventDefault(); // J'empêche l'action du lien (la suppression)
            } else {
                // Sinon, je demande une confirmation à l'utilisateur
                const confirmation = confirm("⚠️ Supprimer le client ID " + idClient + " ?");
                
                // Si l'utilisateur clique sur "Annuler", je bloque aussi la suppression
                if (!confirmation) {
                    event.preventDefault();
                }
            }
        });
    });
});
