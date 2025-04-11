<?php require_once __DIR__ . '/Template/Header.php'; ?>

<!-- Titre centré en haut de la page -->
<h2 class="mb-4 text-center">✏️ Modifier un compte</h2>

<!-- Formulaire de mise à jour du compte bancaire -->
<form action="?action=compte.update" method="POST" id="editCompteForm">

    <!-- Je montre l’ID du compte (lecture seule) + je le passe en champ caché pour la mise à jour -->
    <div class="mb-3">
        <label class="form-label">ID Compte :</label>
        <input type="text" class="form-control" value="<?= $compte->getIdCompte(); ?>" disabled>
        <input type="hidden" name="id_compte" value="<?= $compte->getIdCompte(); ?>">
    </div>

    <!-- Le RIB est affiché mais non modifiable -->
    <div class="mb-3">
        <label class="form-label">RIB :</label>
        <input type="text" class="form-control" value="<?= htmlspecialchars($compte->getRib()); ?>" disabled>
    </div>

    <!-- Menu déroulant pour choisir le type de compte -->
    <div class="mb-3">
        <label for="type_compte" class="form-label">Type de compte :</label>
        <select class="form-control" id="type_compte" name="type_compte" required>
            <option value="Compte courant" <?= $compte->getTypeCompte() === 'Compte courant' ? 'selected' : '' ?>>Compte courant</option>
            <option value="Compte épargne" <?= $compte->getTypeCompte() === 'Compte épargne' ? 'selected' : '' ?>>Compte épargne</option>
        </select>
    </div>

    <!-- Champ modifiable pour le solde initial du compte -->
    <div class="mb-3">
        <label for="solde_initial" class="form-label">Solde initial (€) :</label>
        <input type="number" class="form-control" name="solde_initial" id="solde_initial"
               value="<?= htmlspecialchars($compte->getSoldeInitial()); ?>" step="0.01" min="0">
    </div>

    <!-- Affichage du client lié au compte (lecture seule + champ caché) -->
    <div class="mb-3">
        <label class="form-label">Client associé :</label>
        <?php
        // Je retrouve le client correspondant à l'ID du compte dans la liste des utilisateurs
        $client = null;
        foreach ($clients as $c) {
            if ($c->getId() == $compte->getIdUtilisateur()) {
                $client = $c;
                break;
            }
        }
        ?>
        <!-- Je montre les infos du client, mais je ne permets pas la modification ici -->
        <input type="text" class="form-control"
               value="<?= $client ? $client->getId() . ' - ' . $client->getNom() . ' ' . $client->getPrenom() : 'Client introuvable'; ?>"
               disabled>
        <!-- Champ caché pour transmettre l’ID du client lors de la soumission -->
        <input type="hidden" name="id_utilisateur" value="<?= $compte->getIdUtilisateur(); ?>">
    </div>

    <!-- Bouton pour enregistrer les modifications -->
    <button type="submit" class="btn btn-primary">💾 Enregistrer les modifications</button>

    <!-- Lien retour vers la liste des comptes -->
    <a href="?action=compte.index" class="btn btn-secondary mt-3 ms-2">⬅️ Retour à la liste</a>
</form>

<!-- Script JS de validation -->
<script src="js/edit-compte.js"></script>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
