<?php require_once __DIR__ . '/Template/Header.php'; ?>

<!-- Je relie ici la feuille de style spécifique à la création d’un contrat -->
<link rel="stylesheet" href="View/css/create-contrat.css">

<!-- Conteneur principal du formulaire -->
<div class="create-contrat-container">

  <!-- Formulaire pour créer un contrat -->
  <form action="?action=contrat.store" method="POST" class="create-contrat-form" id="createContratForm">
    <h2>➕ Créer un nouveau contrat</h2>

    <!-- Champ : Type de contrat -->
    <div class="form-group">
      <label for="type_contrat">Type de contrat :</label>

      <!-- Liste déroulante avec les types disponibles -->
      <select id="type_contrat" name="type_contrat">
        <option value="">-- Sélectionnez un type --</option>
        <option value="Assurance Vie">Assurance Vie</option>
        <option value="Assurance Habitation">Assurance Habitation</option>
        <option value="Crédit Immobilier">Crédit Immobilier</option>
        <option value="Crédit à la Consommation">Crédit à la Consommation</option>
        <option value="Compte Épargne Logement (CEL)">Compte Épargne Logement (CEL)</option>
      </select>

      <!-- Message d’erreur affiché en cas de champ vide -->
      <div id="error-type-contrat" class="error-text"></div>
    </div>

    <!-- Champ : Montant du contrat -->
    <div class="form-group">
      <label for="montant">Montant souscrit (€) :</label>

      <!-- L’utilisateur entre ici le montant souscrit -->
      <input type="number" id="montant" name="montant" step="0.01" min="0">

      <!-- Message d’erreur pour le montant -->
      <div id="error-montant" class="error-text"></div>
    </div>

    <!-- Champ : Durée du contrat -->
    <div class="form-group">
      <label for="duree">Durée (mois) :</label>

      <!-- Durée en mois, entrée obligatoire -->
      <input type="number" id="duree" name="duree" min="1">

      <!-- Message d’erreur pour la durée -->
      <div id="error-duree" class="error-text"></div>
    </div>

    <!-- Champ : Client associé au contrat -->
    <div class="form-group">
      <label for="id_utilisateur">Client :</label>

      <!-- Liste déroulante des clients, alimentée dynamiquement via PHP -->
      <select id="id_utilisateur" name="id_utilisateur">
        <option value="">-- Sélectionnez un client --</option>

        <!-- Je parcours la liste des clients pour créer chaque option -->
        <?php foreach ($clients as $client): ?>
          <option value="<?= $client->getId(); ?>">
            <?= $client->getId() . ' - ' . htmlspecialchars($client->getNom() . ' ' . $client->getPrenom()); ?>
          </option>
        <?php endforeach; ?>
      </select>

      <!-- Message d’erreur si aucun client n’est sélectionné -->
      <div id="error-client" class="error-text"></div>
    </div>

    <!-- Bouton de validation du formulaire -->
    <button type="submit" class="btn-submit">✅ Créer le contrat</button>

    <!-- Lien pour revenir à la liste des contrats -->
    <a href="?action=contrat.index" class="btn-secondary">⬅️ Retour à la liste</a>
  </form>
</div>

<!-- J’ajoute le fichier JavaScript pour gérer les validations du formulaire -->
<script src="js/create-contrat.js"></script>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
