// J'attends que toute la page soit complètement chargée
document.addEventListener('DOMContentLoaded', function () {

    // Je récupère le formulaire grâce à son ID
    const form = document.getElementById('editCompteForm');

    // Si jamais le formulaire n'existe pas (par exemple si l'ID est faux), je quitte la fonction
    if (!form) return;

    // J'écoute l'événement "submit" (clic sur le bouton de validation du formulaire)
    form.addEventListener('submit', function (e) {
        // J'empêche l'envoi automatique du formulaire (pour éviter que la page ne se recharge)
        e.preventDefault();

        // Je lance ma fonction de validation personnalisée
        validateForm();
    });

    // Fonction qui valide les champs du formulaire
    function validateForm() {
        // Je récupère les valeurs tapées dans les champs du formulaire
        let typeCompte = document.getElementById('type_compte').value.trim();
        let solde = document.getElementById('solde_initial').value.trim();

        // Je suppose que le formulaire est valide au début
        let isValid = true;

        // Je récupère les éléments pour afficher les erreurs (ou je les crée s’ils n’existent pas encore)
        let errorType = document.getElementById('error-type');
        let errorSolde = document.getElementById('error-solde');

        // Si le message d’erreur pour le type de compte n’existe pas, je le crée dynamiquement
        if (!errorType) {
            errorType = document.createElement('div');
            errorType.id = 'error-type';
            document.getElementById('type_compte').after(errorType); // Je l’ajoute juste après le champ
        }

        // Idem pour le solde
        if (!errorSolde) {
            errorSolde = document.createElement('div');
            errorSolde.id = 'error-solde';
            document.getElementById('solde_initial').after(errorSolde);
        }

        // Je vide les anciens messages d'erreur avant de refaire la validation
        errorType.innerHTML = '';
        errorSolde.innerHTML = '';

        // VALIDATION DU TYPE DE COMPTE
        if (typeCompte === "") {
            errorType.innerHTML = "Le type de compte est obligatoire.";
            errorType.style.color = "#DB2727";       // Je mets en rouge
            errorType.style.fontSize = "0.9rem";      // Un peu plus petit que le texte normal
            isValid = false;
        }

        //  VALIDATION DU SOLDE
        // Si le champ est vide, ou si ce n'est pas un nombre, ou si c’est négatif
        if (solde === "" || isNaN(solde) || parseFloat(solde) < 0) {
            errorSolde.innerHTML = "Le solde doit être un nombre positif.";
            errorSolde.style.color = "#DB2727";
            errorSolde.style.fontSize = "0.9rem";
            isValid = false;
        }

        // SI TOUT EST BON, je soumets le formulaire normalement
        if (isValid) {
            form.submit(); // Envoi du formulaire vers le serveur
        }
    }
});
