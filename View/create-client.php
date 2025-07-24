<?php require_once __DIR__ . '/Template/Header.php'; ?>

<link rel="stylesheet" href="View/css/create-client.css">

<h2 class="text-center mb-4">Créer un nouveau client</h2>

<div class="container create-client-container">

    <form id="createClientForm" action="?action=utilisateur.store" method="POST" class="container">
        
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>

            <input type="text" class="form-control" id="nom" name="nom">

            <div id="error-nom"></div>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom">
            <div id="error-prenom"></div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>

            <input type="text" class="form-control" id="email" name="email">
            <div id="error-email"></div>
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone">
            <div id="error-telephone"></div>
        </div>

        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse">
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
    </form>
</div>

<!-- Script JavaScript chargé à la fin pour valider les champs avant soumission -->
<script src="js/create-client.js"></script>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
