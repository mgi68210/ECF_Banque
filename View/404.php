<?php require_once __DIR__ . '/Template/Header.php'; ?>
<!-- J'inclus l'en-tête général du site (barre de navigation, etc.) -->

<link rel="stylesheet" href="View/css/error.css">
<!-- J'ajoute une feuille de style spécifique pour les pages d'erreur -->

<div class="error-container animate-zoom">
    <!-- Conteneur principal de l'erreur, avec une animation visuelle à l'affichage -->

    <img src="https://cdn-icons-png.flaticon.com/512/580/580185.png" alt="404 Error" style="width: 100px; margin-bottom: 20px;">
    <!-- Image illustrative pour signaler l’erreur 404 -->

    <h1>🚫 Erreur 404</h1>
    <!-- Titre de la page indiquant clairement qu’il s’agit d’une erreur 404 (page non trouvée) -->

    <p>La page que vous recherchez est introuvable.</p>
    <!-- Message informatif expliquant que l’URL ne correspond à aucune page -->

    <a href="?action=dashboard" class="btn btn-outline-primary">
        Retour au tableau de bord
    </a>
    <!-- Lien permettant de revenir sur une page sûre : le tableau de bord -->
</div>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
<!-- J'inclus le pied de page du site -->
