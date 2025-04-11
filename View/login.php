<?php require_once __DIR__ . '/Template/Header.php'; ?>

<!-- Je relie la feuille de style spécifique à la page de login -->
<link rel="stylesheet" href="View/css/login.css">

<!-- Conteneur principal de la page de connexion -->
<div class="login-container">
    <div class="login-card">
        <!-- Titre affiché au-dessus du formulaire -->
        <h2 class="login-title">Connexion</h2>

        <!-- Si une erreur existe (ex: mauvais identifiants), je l'affiche -->
        <?php if (isset($error)): ?>
            <div class="error-message"><?= $error ?></div>
        <?php endif; ?>

        <!-- Formulaire de connexion : il envoie les données à auth.authenticate -->
        <form action="?action=auth.authenticate" method="POST" id="loginForm">
            
            <!-- Champ pour l'adresse email -->
            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="text" name="email" id="email" class="form-control-custom" />
                <!-- Zone pour afficher les erreurs de validation côté JS -->
                <div id="error-email" class="input-error"></div>
            </div>

            <!-- Champ pour le mot de passe -->
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control-custom" />
                <!-- Zone pour afficher les erreurs de validation côté JS -->
                <div id="error-password" class="input-error"></div>
            </div>

            <!-- Bouton pour envoyer le formulaire -->
            <button type="submit" class="btn-primary-custom">Se connecter</button>
        </form>
    </div>
</div>

<!-- Je relie un script JavaScript qui valide le formulaire avant envoi -->
<script src="js/login.js"></script>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
