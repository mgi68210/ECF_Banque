<?php require_once __DIR__ . '/Template/Header.php'; ?>
<link rel="stylesheet" href="View/css/error.css">

<div class="error-container animate-zoom">
<img src="https://cdn-icons-png.flaticon.com/512/564/564619.png" alt="403 Error" style="width: 100px; margin-bottom: 20px;">

    <h1>⛔ Erreur 403</h1>
    <p>Vous n'avez pas les droits nécessaires pour accéder à cette page.</p>
    <a href="?action=auth.logout" class="btn btn-outline-danger">Retour à l'accueil</a>
</div>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
