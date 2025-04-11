// Je lance ce code quand la page est totalement chargée
document.addEventListener('DOMContentLoaded', function () {
    // Je récupère le formulaire de création de compte
    const form = document.getElementById('createCompteForm');

    // Si jamais je ne trouve pas le formulaire, je ne fais rien
    if (!form) return;

    // Quand l'utilisateur soumet le formulaire...
    form.addEventListener('submit', function (e) {
        e.preventDefault();  // J'empêche l'envoi du formulaire par défaut
        validationForm();    // Je lance ma fonction pour vérifier les champs
    });

    function validationForm() {
        // Je récupère toutes les valeurs des champs
        let rib = document.getElementById('rib').value.trim();
        let typeCompte = document.getElementById('type_compte').value.trim();
        let solde = document.getElementById('solde_initial').value.trim();
        let utilisateur = document.getElementById('id_utilisateur').value;

        // Je récupère aussi les balises où je vais afficher les erreurs
        let errorRib = document.getElementById('error-rib');
        let errorType = document.getElementById('error-type-compte');
        let errorSolde = document.getElementById('error-solde');
        let errorClient = document.getElementById('error-client');

        // Je suppose que tout est valide au départ
        let isValid = true;

        // Je vide les erreurs précédentes si jamais il y en avait
        clearErrors();

        // Vérification du RIB
        if (rib === "") {
            showError(errorRib, "Le RIB est obligatoire !");
            isValid = false;
        }

        // Vérification du type de compte
        if (typeCompte === "") {
            showError(errorType, "Veuillez choisir un type de compte.");
            isValid = false;
        }

        // Vérification du solde
        if (solde === "" || isNaN(solde) || parseFloat(solde) < 0) {
            showError(errorSolde, "Le solde doit être un nombre positif.");
            isValid = false;
        }

        // Vérification du client sélectionné
        if (utilisateur === "") {
            showError(errorClient, "Veuillez sélectionner un client.");
            isValid = false;
        }

        // Si tout est OK, j'envoie le formulaire
        if (isValid) {
            alert("Formulaire de compte envoyé avec succès !");
            form.submit();
        }
    }

    // Cette fonction me permet d'afficher une erreur
    function showError(element, message) {
        element.textContent = message;
        element.style.color = "#DB2727";
        element.style.fontSize = "14px";
    }

    // Cette fonction vide toutes les erreurs affichées
    function clearErrors() {
        ['error-rib', 'error-type-compte', 'error-solde', 'error-client'].forEach(id => {
            const el = document.getElementById(id);
            if (el) el.textContent = "";
        });
    }
});
