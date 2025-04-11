// Je m'assure que le DOM est bien chargé avant de commencer à manipuler les éléments
document.addEventListener('DOMContentLoaded', function () {

    // Je récupère le formulaire via son ID
    const form = document.getElementById('editContratForm');

    // Si le formulaire n’existe pas sur la page, je quitte la fonction
    if (!form) return;

    // J'écoute l'envoi du formulaire
    form.addEventListener('submit', function (e) {
        e.preventDefault(); // J'empêche l'envoi automatique (et donc le rechargement)
        validationForm();   // Je lance ma propre fonction de validation
    });

    // Fonction principale de validation
    function validationForm() {
        // Je récupère les valeurs des champs à vérifier
        const montant = document.getElementById('montant').value.trim();
        const duree = document.getElementById('duree').value.trim();

        // Je récupère les éléments qui vont afficher les messages d'erreur
        const errorMontant = document.getElementById('error-montant');
        const errorDuree = document.getElementById('error-duree');

        // Je suppose que tout est valide au départ
        let isValid = true;

        // Je nettoie les anciens messages d'erreur
        errorMontant.textContent = '';
        errorDuree.textContent = '';

        // Je vérifie le montant
        // Le montant doit être rempli, un nombre, et supérieur à 0
        if (montant === '' || isNaN(montant) || parseFloat(montant) <= 0) {
            errorMontant.textContent = "Le montant doit être un nombre positif.";
            errorMontant.style.color = "#DB2727";
            errorMontant.style.fontSize = "0.9rem";
            isValid = false;
        }

        // Je vérifie la durée
        // Elle doit être un entier strictement supérieur à 0
        if (duree === '' || isNaN(duree) || parseInt(duree) <= 0) {
            errorDuree.textContent = "La durée doit être un nombre entier supérieur à 0.";
            errorDuree.style.color = "#DB2727";
            errorDuree.style.fontSize = "0.9rem";
            isValid = false;
        }

        // Si tout est bon, j'envoie le formulaire normalement
        if (isValid) {
            alert("Modification du contrat enregistrée avec succès !");
            form.submit();
        }
    }
});
