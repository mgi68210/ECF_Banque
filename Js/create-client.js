console.log("JS client chargé"); // Vérification que le fichier est bien chargé

document.getElementById('createClientForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Empêche le rechargement
    validationForm();   // Lance la validation
});

function validationForm() {
    let userName = document.getElementById('nom').value.trim();
    let userPrenom = document.getElementById('prenom').value.trim();
    let userEmail = document.getElementById('email').value.trim();
    let userTelephone = document.getElementById('telephone').value.trim();

    let errorName = document.getElementById('error-nom');
    let errorPrenom = document.getElementById('error-prenom');
    let errorEmail = document.getElementById('error-email');
    let errorTelephone = document.getElementById('error-telephone');

    let isValid = true;

    // Nom
    if (userName === "") {
        displayError(errorName, "Le nom est obligatoire !");
        isValid = false;
    } else {
        errorName.innerHTML = "";
    }

    // Prénom
    if (userPrenom === "") {
        displayError(errorPrenom, "Le prénom est obligatoire !");
        isValid = false;
    } else {
        errorPrenom.innerHTML = "";
    }

    // Email
    if (userEmail === "") {
        displayError(errorEmail, "L'email est obligatoire !");
        isValid = false;
    } else if (!userEmail.includes("@")) {
        displayError(errorEmail, "L'email doit contenir un '@'.");
        isValid = false;
    } else {
        errorEmail.innerHTML = "";
    }

    // Téléphone
    if (userTelephone === "") {
        displayError(errorTelephone, "Le téléphone est obligatoire !");
        isValid = false;
    } else {
        errorTelephone.innerHTML = "";
    }

    if (isValid) {
        alert("Formulaire client envoyé avec succès !");
        document.getElementById('createClientForm').submit();
    }
}

function displayError(element, message) {
    element.innerHTML = message;
    element.style.color = "#DB2727";
    element.style.fontSize = "16px";
}
