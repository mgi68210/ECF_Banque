// Je lance mon script quand toute la page est bien chargée
document.addEventListener('DOMContentLoaded', function () {

    // Je récupère le formulaire de connexion grâce à son ID
    const form = document.getElementById('loginForm');

    // Si je ne trouve pas le formulaire, je ne fais rien (sécurité)
    if (!form) return;

    // Quand on soumet le formulaire
    form.addEventListener('submit', function (e) {
        e.preventDefault(); // J'empêche l'envoi automatique du formulaire
        if (validateLogin()) {
            // Si tout est valide, je peux envoyer le formulaire
            form.submit();
        }
    });

    // Fonction de validation principale
    function validateLogin() {
        // Je récupère les valeurs saisies par l'utilisateur
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();

        // Je nettoie les anciens messages d'erreur
        clearErrors();

        let isValid = true; // Je suppose que tout est bon

        // Pour la validation de l'email
        if (email === "") {
            showError("error-email", "L'adresse e-mail est obligatoire.");
            isValid = false;
        } else if (!email.includes("@")) {
            showError("error-email", "L'adresse e-mail doit contenir un '@'.");
            // Je ne mets pas isValid à false ici pour laisser passer les erreurs classiques
        }

        // Pour la validation du mot de passe
        if (password === "") {
            showError("error-password", "Le mot de passe est obligatoire.");
            isValid = false;
        }

        return isValid; // Je retourne vrai ou faux selon les erreurs
    }

    // Fonction pour afficher un message d'erreur sous un champ
    function showError(id, message) {
        const element = document.getElementById(id);
        if (element) {
            element.textContent = message;
            element.style.color = "#DB2727";       // Couleur rouge pour l'erreur
            element.style.fontSize = "0.9rem";     // Taille un peu plus petite
        }
    }

    // Fonction pour nettoyer toutes les erreurs affichées précédemment
    function clearErrors() {
        ['error-email', 'error-password'].forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.textContent = ""; // Je vide le message d’erreur
            }
        });
    }
});
