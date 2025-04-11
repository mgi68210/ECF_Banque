// Je lance ce code une fois que toute la page est bien chargée
document.addEventListener('DOMContentLoaded', function () {

    // Je récupère le formulaire avec la classe .edit-client-form
    const form = document.querySelector('.edit-client-form');

    // Si le formulaire n'existe pas, je quitte
    if (!form) return;

    // J'écoute l'envoi du formulaire
    form.addEventListener('submit', function (e) {
        e.preventDefault(); // J’empêche que le formulaire parte tout de suite
        validateForm();     // Je lance ma fonction de validation
    });

    // Fonction pour valider les champs du formulaire
    function validateForm() {
        // Je récupère les valeurs saisies par l'utilisateur
        const nom = document.getElementById('nom').value.trim();
        const prenom = document.getElementById('prenom').value.trim();
        const email = document.getElementById('email').value.trim();
        const telephone = document.getElementById('telephone').value.trim();

        let isValid = true; // Je pars du principe que tout est bon

        clearErrors(); // Je nettoie les messages d'erreur précédents

        // Si le champ nom est vide
        if (nom === "") {
            showError("nom", "Le nom est obligatoire !");
            isValid = false;
        }

        // Si le champ prénom est vide
        if (prenom === "") {
            showError("prenom", "Le prénom est obligatoire !");
            isValid = false;
        }

        // Si l’email est vide ou ne contient pas @
        if (email === "") {
            showError("email", "L'email est obligatoire !");
            isValid = false;
        } else if (!email.includes("@")) {
            showError("email", "L'email doit contenir un '@'.");
            isValid = false;
        }

        // Si le champ téléphone est vide
        if (telephone === "") {
            showError("telephone", "Le téléphone est obligatoire !");
            isValid = false;
        }

        // Si tout est bon, je peux envoyer le formulaire
        if (isValid) {
            form.submit();
        }
    }

    // Fonction pour afficher une erreur sous un champ
    function showError(id, message) {
        const input = document.getElementById(id);        // Je récupère le champ concerné
        const error = document.createElement('div');      // Je crée une div pour afficher l'erreur
        error.classList.add('text-danger', 'mt-1');       // Je lui mets une classe d'erreur
        error.style.color = '#DB2727';                    // Je change la couleur pour le rouge
        error.style.fontSize = '0.9rem';                  // Je réduis la taille
        error.textContent = message;                      // Je mets le message dedans

        input.classList.add('is-invalid');                // J’ajoute une bordure rouge au champ
        input.parentElement.appendChild(error);           // J'affiche l'erreur sous le champ
    }

    // Je supprime tous les anciens messages d'erreurs
    function clearErrors() {
        const inputs = form.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.classList.remove('is-invalid');         // Je retire les bordures rouges
        });

        const errors = form.querySelectorAll('.text-danger');
        errors.forEach(err => err.remove());              // Je supprime les messages
    }
});
