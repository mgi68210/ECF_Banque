console.log("JS client chargé"); // Je vérifie que le fichier JS est bien connecté à ma page

// Je récupère le formulaire et j'écoute l'événement "submit"
document.getElementById('createClientForm').addEventListener('submit', function(e) {
    e.preventDefault(); // J'empêche le formulaire de s'envoyer normalement
    validationForm();   // Je lance la fonction qui vérifie les champs
});

function validationForm() {
    // Je récupère les valeurs saisies dans les champs
    let userName = document.getElementById('nom').value.trim();
    let userPrenom = document.getElementById('prenom').value.trim();
    let userEmail = document.getElementById('email').value.trim();
    let userTelephone = document.getElementById('telephone').value.trim();

    // Je récupère les zones où afficher les messages d’erreur
    let errorName = document.getElementById('error-nom');
    let errorPrenom = document.getElementById('error-prenom');
    let errorEmail = document.getElementById('error-email');
    let errorTelephone = document.getElementById('error-telephone');

    // Je considère que tout est bon au départ
    let isValid = true;

    // ✅ Vérification du nom
    if (userName === "") {
        displayError(errorName, "Le nom est obligatoire !");
        isValid = false;
    } else {
        errorName.innerHTML = ""; // Je vide l’erreur s’il y a quelque chose
    }

    // ✅ Vérification du prénom
    if (userPrenom === "") {
        displayError(errorPrenom, "Le prénom est obligatoire !");
        isValid = false;
    } else {
        errorPrenom.innerHTML = "";
    }

    // ✅ Vérification de l’email
    if (userEmail === "") {
        displayError(errorEmail, "L'email est obligatoire !");
        isValid = false;
    } else if (!userEmail.includes("@")) {
        displayError(errorEmail, "L'email doit contenir un '@'.");
        isValid = false;
    } else {
        errorEmail.innerHTML = "";
    }

    // ✅ Vérification du téléphone
    if (userTelephone === "") {
        displayError(errorTelephone, "Le téléphone est obligatoire !");
        isValid = false;
    } else {
        errorTelephone.innerHTML = "";
    }

    // Si tout est bien rempli, j'envoie le formulaire
    if (isValid) {
        alert("Formulaire client envoyé avec succès !");
        document.getElementById('createClientForm').submit();
    }
}

// Cette fonction me permet d'afficher un message d'erreur rouge
function displayError(element, message) {
    element.innerHTML = message;
    element.style.color = "#DB2727";
    element.style.fontSize = "16px";
}
