<?php require_once __DIR__ . '/Template/Header.php'; ?>
<!-- J'inclus l'en-tête du site pour garder une structure cohérente avec le reste du site -->

<link rel="stylesheet" href="View/css/error.css">
<!-- J'ajoute une feuille de style dédiée aux erreurs pour que la page soit bien présentée -->

<div class="error-container animate-zoom">
    <!-- Bloc principal contenant le message d’erreur avec une animation à l'affichage -->

    <img src="https://cdn-icons-png.flaticon.com/512/564/564619.png" alt="403 Error" style="width: 100px; margin-bottom: 20px;">
    <!-- Image représentative de l'erreur 403 pour un affichage plus explicite -->

    <h1> Erreur 403</h1>
    <!-- Titre principal indiquant qu'il s'agit d'une erreur d'accès interdit -->

    <p>Vous n'êtes pas inscrit et vous n'avez pas les droits nécessaires pour accéder à cette page.</p>
    <!-- Message informatif expliquant que l’utilisateur n’a pas l’autorisation d’accéder à cette page -->

    <a href="?action=auth.logout" class="btn btn-outline-danger">
        Retour à l'accueil
    </a>
    <!-- Bouton pour revenir à la page d'accueil, utile pour éviter que l'utilisateur reste bloqué -->
</div>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
<!-- J'inclus le pied de page du site -->
