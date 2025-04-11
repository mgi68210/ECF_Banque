<?php require_once __DIR__ . '/Template/Header.php'; ?>

<!-- J’inclus ici le fichier CSS dédié à la mise en forme du formulaire de création de client -->
<link rel="stylesheet" href="View/css/create-client.css">

<!-- Titre centré -->
<h2 class="text-center mb-4">Créer un nouveau client</h2>

<!-- Conteneur du formulaire -->
<div class="container create-client-container">

    <!-- Début du formulaire -->
    <form id="createClientForm" action="?action=utilisateur.store" method="POST" class="container">
        
        <!-- Champ pour le nom -->
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>

            <!-- L’utilisateur saisit ici le nom du client -->
            <input type="text" class="form-control" id="nom" name="nom">

            <!-- Zone d’affichage d’une erreur liée au nom -->
            <div id="error-nom"></div>
        </div>

        <!-- Champ pour le prénom -->
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom">
            <div id="error-prenom"></div>
        </div>

        <!-- Champ pour l’email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>

            <!-- Je saisis l’adresse email du client ici -->
            <input type="text" class="form-control" id="email" name="email">
            <div id="error-email"></div>
        </div>

        <!-- Champ pour le téléphone -->
        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone">
            <div id="error-telephone"></div>
        </div>

        <!-- Champ pour l’adresse postale -->
        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse">
        </div>

        <!-- Bouton pour soumettre le formulaire -->
        <button type="submit" class="btn btn-success">Créer</button>
    </form>
</div>

<!-- Script JavaScript chargé à la fin pour valider les champs avant soumission -->
<script src="js/create-client.js"></script>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
