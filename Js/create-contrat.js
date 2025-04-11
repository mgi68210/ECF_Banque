// Je lance le code une fois que la page est complètement chargée
document.addEventListener('DOMContentLoaded', function () {
    // Je récupère le formulaire de création de contrat
    const form = document.getElementById('createContratForm');

    // Quand on tente d’envoyer le formulaire...
    form.addEventListener('submit', function (e) {
        e.preventDefault();     // J’empêche l’envoi automatique du formulaire
        validationForm();       // Je lance la fonction pour vérifier les champs
    });

    // C’est ma fonction de validation
    function validationForm() {
        // Je récupère les valeurs saisies dans les champs
        let type = document.getElementById('type_contrat').value.trim();
        let montant = document.getElementById('montant').value.trim();
        let duree = document.getElementById('duree').value.trim();
        let client = document.getElementById('id_utilisateur').value;

        // Je récupère les endroits où je vais afficher les erreurs
        let errorType = document.getElementById('error-type-contrat');
        let errorMontant = document.getElementById('error-montant');
        let errorDuree = document.getElementById('error-duree');
        let errorClient = document.getElementById('error-client');

        // J’imagine au début que tout est bon
        let isValid = true;

        // Je nettoie les anciens messages d’erreur s’ils existent
        [errorType, errorMontant, errorDuree, errorClient].forEach(el => el.textContent = "");

        // Je vérifie si un type de contrat est sélectionné
        if (type === "") {
            showError(errorType, "Le type de contrat est obligatoire.");
            isValid = false;
        }

        // Je vérifie que le montant est bien un nombre positif
        if (montant === "" || isNaN(montant) || parseFloat(montant) < 0) {
            showError(errorMontant, "Veuillez saisir un montant valide (≥ 0).");
            isValid = false;
        }

        // Je vérifie que la durée est un entier supérieur ou égal à 1
        if (duree === "" || isNaN(duree) || parseInt(duree) < 1) {
            showError(errorDuree, "Veuillez saisir une durée en mois (≥ 1).");
            isValid = false;
        }

        // Je vérifie qu’un client est bien sélectionné
        if (client === "") {
            showError(errorClient, "Veuillez sélectionner un client.");
            isValid = false;
        }

        // Si tout est OK, j’envoie le formulaire
        if (isValid) {
            alert("Formulaire de contrat envoyé avec succès !");
            form.submit();
        }
    }

    // Fonction pour afficher un message d’erreur
    function showError(element, message) {
        element.textContent = message;             // J’écris le message dans l’élément
        element.classList.add("input-error");      // Je lui ajoute une classe CSS pour le style
    }
});
