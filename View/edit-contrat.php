<?php require_once __DIR__ . '/Template/Header.php'; ?>

<!-- Je relie la feuille de style CSS dédiée à l’édition de contrat -->
<link rel="stylesheet" href="View/css/edit-contrat.css">

<!-- Conteneur principal du formulaire -->
<div class="edit-contrat-container">

    <!-- Je crée le formulaire de modification du contrat -->
    <form action="?action=contrat.update" method="POST" class="edit-contrat-form" id="editContratForm">

        <!-- Titre explicite pour l'utilisateur -->
        <h2>✏️ Modifier un contrat</h2>

        <!-- Je passe l’ID du contrat de manière cachée pour qu’il soit traité côté serveur -->
        <input type="hidden" name="id_contrat" value="<?= $contrat->getIdContrat(); ?>">

        <!-- Type de contrat : affiché en lecture seule (non modifiable) -->
        <div class="mb-3">
            <label class="form-label">Type de contrat :</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($contrat->getTypeContrat()); ?>" disabled>
        </div>

        <!-- Champ modifiable : Montant du contrat -->
        <div class="mb-3">
            <label for="montant" class="form-label">Montant souscrit (€) :</label>
            <input type="number" step="0.01" class="form-control" id="montant" name="montant"
                   value="<?= htmlspecialchars($contrat->getMontant()); ?>" min="0">
            <!-- Zone d'affichage d'erreur JS -->
            <div id="error-montant" class="form-text text-danger"></div>
        </div>

        <!-- Champ modifiable : Durée en mois -->
        <div class="mb-3">
            <label for="duree" class="form-label">Durée (en mois) :</label>
            <input type="number" class="form-control" id="duree" name="duree"
                   value="<?= htmlspecialchars($contrat->getDuree()); ?>" min="1">
            <div id="error-duree" class="form-text text-danger"></div>
        </div>

        <!-- Informations du client (affichage + champ caché) -->
        <div class="mb-3">
            <label class="form-label">Client associé :</label>
            <input type="text" class="form-control"
                   value="<?= $client ? $client->getId() . ' - ' . $client->getNom() . ' ' . $client->getPrenom() : 'Client introuvable'; ?>"
                   disabled>
            <input type="hidden" name="id_utilisateur" value="<?= $contrat->getIdUtilisateur(); ?>">
        </div>

        <!-- Bouton pour enregistrer la modification -->
        <button type="submit" class="btn btn-primary">💾 Enregistrer les modifications</button>
    </form>
</div>

<!-- Lien pour retourner à la liste des contrats -->
<a href="?action=contrat.index" class="btn btn-secondary mt-3 w-100">⬅️ Retour</a>

<!-- Script de validation JavaScript -->
<script src="js/edit-contrat.js"></script>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
