document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('loginForm');

    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        if (validateLogin()) {
            form.submit();
        }
    });

    function validateLogin() {
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();

        clearErrors();
        let isValid = true;

        if (email === "") {
            showError("error-email", "L'adresse e-mail est obligatoire.");
            isValid = false;
        } else if (!email.includes("@")) {
            showError("error-email", "L'adresse e-mail doit contenir un '@'.");
            isValid = false;
        }

        if (password === "") {
            showError("error-password", "Le mot de passe est obligatoire.");
            isValid = false;
        }

        return isValid;
    }

    function showError(id, message) {
        const element = document.getElementById(id);
        if (element) {
            element.textContent = message;
            element.style.color = "#DB2727";
            element.style.fontSize = "0.9rem";
        }
    }

    function clearErrors() {
        ['error-email', 'error-password'].forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.textContent = "";
            }
        });
    }
});
