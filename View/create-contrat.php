<?php require_once __DIR__ . '/Template/Header.php'; ?>

<link rel="stylesheet" href="View/css/create-contrat.css">

<div class="create-contrat-container">

  <form action="?action=contrat.store" method="POST" class="create-contrat-form" id="createContratForm">
    <h2> Créer un nouveau contrat</h2>

    <div class="form-group">
      <label for="type_contrat">Type de contrat :</label>

      <select id="type_contrat" name="type_contrat">
        <option value="">-- Sélectionnez un type --</option>
        <option value="Assurance Vie">Assurance Vie</option>
        <option value="Assurance Habitation">Assurance Habitation</option>
        <option value="Crédit Immobilier">Crédit Immobilier</option>
        <option value="Crédit à la Consommation">Crédit à la Consommation</option>
        <option value="Compte Épargne Logement (CEL)">Compte Épargne Logement (CEL)</option>
      </select>

      <div id="error-type-contrat" class="error-text"></div>
    </div>

    <div class="form-group">
      <label for="montant">Montant souscrit (€) :</label>

      <input type="number" id="montant" name="montant" step="0.01" min="0">

      <div id="error-montant" class="error-text"></div>
    </div>

    <div class="form-group">
      <label for="duree">Durée (mois) :</label>

      <input type="number" id="duree" name="duree" min="1">

      <div id="error-duree" class="error-text"></div>
    </div>

    <div class="form-group">
      <label for="id_utilisateur">Client :</label>

      <select id="id_utilisateur" name="id_utilisateur">
        <option value="">-- Sélectionnez un client --</option>

        <!-- Je parcours la liste des clients pour créer chaque option -->
        <?php foreach ($clients as $client): ?>
          <option value="<?= $client->getId(); ?>">
            <?= $client->getId() . ' - ' . htmlspecialchars($client->getNom() . ' ' . $client->getPrenom()); ?>
          </option>
        <?php endforeach; ?>
      </select>

      <div id="error-client" class="error-text"></div>
    </div>

    <button type="submit" class="btn-submit"> Créer le contrat</button>

    <a href="?action=contrat.index" class="btn-secondary">⬅️ Retour à la liste</a>
  </form>
</div>

<!-- J’ajoute le fichier JavaScript pour gérer les validations du formulaire -->
<script src="js/create-contrat.js"></script>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
