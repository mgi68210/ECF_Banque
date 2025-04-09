
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('createCompteForm');

    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        validationForm();
    });

    function validationForm() {
        let rib = document.getElementById('rib').value.trim();
        let typeCompte = document.getElementById('type_compte').value.trim();
        let solde = document.getElementById('solde_initial').value.trim();
        let utilisateur = document.getElementById('id_utilisateur').value;

        let errorRib = document.getElementById('error-rib');
        let errorType = document.getElementById('error-type-compte');
        let errorSolde = document.getElementById('error-solde');
        let errorClient = document.getElementById('error-client');

        let isValid = true;

        // Nettoyer erreurs précédentes
        clearErrors();

        // RIB
        if (rib === "") {
            showError(errorRib, "Le RIB est obligatoire !");
            isValid = false;
        }

        // Type de compte
        if (typeCompte === "") {
            showError(errorType, "Veuillez choisir un type de compte.");
            isValid = false;
        }

        // Solde
        if (solde === "" || isNaN(solde) || parseFloat(solde) < 0) {
            showError(errorSolde, "Le solde doit être un nombre positif.");
            isValid = false;
        }

        // Client
        if (utilisateur === "") {
            showError(errorClient, "Veuillez sélectionner un client.");
            isValid = false;
        }

        if (isValid) {
            alert("Formulaire de compte envoyé avec succès !");
            form.submit();
        }
    }

    function showError(element, message) {
        element.textContent = message;
        element.style.color = "#DB2727";
        element.style.fontSize = "14px";
    }

    function clearErrors() {
        ['error-rib', 'error-type-compte', 'error-solde', 'error-client'].forEach(id => {
            const el = document.getElementById(id);
            if (el) el.textContent = "";
        });
    }
});
