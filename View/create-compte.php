<?php require_once __DIR__ . '/Template/Header.php'; ?>

<!-- Je relie ici la feuille de style spécifique à cette page -->
<link rel="stylesheet" href="View/css/create-compte.css">

<!-- Conteneur principal pour le formulaire -->
<div class="container create-compte-container">

    <!-- Début du formulaire pour créer un compte bancaire -->
    <form action="?action=compte.store" method="POST" id="createCompteForm" class="create-compte-form">
        <h2>⊕ Créer un nouveau compte</h2>

        <!-- Champ RIB -->
        <div class="mb-3">
            <label for="rib" class="form-label">RIB :</label>

            <!-- L'utilisateur saisit ici le RIB du compte -->
            <input type="text" class="form-control" id="rib" name="rib">

            <!-- Zone pour afficher un message d'erreur si le champ est vide ou invalide -->
            <div id="error-rib" class="text-danger mt-1"></div>
        </div>

        <!-- Champ Type de compte -->
        <div class="mb-3">
            <label for="type_compte" class="form-label">Type de compte :</label>

            <!-- Menu déroulant pour choisir entre Compte courant et Compte épargne -->
            <select class="form-control" id="type_compte" name="type_compte">
                <option value="">-- Sélectionnez un type --</option>
                <option value="Compte courant">Compte courant</option>
                <option value="Compte épargne">Compte épargne</option>
            </select>

            <!-- Zone d'erreur associée -->
            <div id="error-type-compte" class="text-danger mt-1"></div>
        </div>

        <!-- Champ Solde initial -->
        <div class="mb-3">
            <label for="solde_initial" class="form-label">Solde initial :</label>

            <!-- L'utilisateur saisit ici le montant du solde à l'ouverture -->
            <input type="number" class="form-control" id="solde_initial" name="solde_initial" step="0.01">

            <!-- Zone d’erreur pour le solde -->
            <div id="error-solde" class="text-danger mt-1"></div>
        </div>

        <!-- Champ pour associer le compte à un utilisateur -->
        <div class="mb-3">
            <label for="id_utilisateur" class="form-label">Client :</label>

            <!-- Menu déroulant généré dynamiquement en PHP -->
            <select class="form-control" id="id_utilisateur" name="id_utilisateur">
                <option value="">-- Sélectionnez un client --</option>

                <!-- Je parcours tous les clients pour générer une option -->
                <?php foreach ($clients as $client): ?>
                    <option value="<?= $client->getId(); ?>">
                        ID <?= $client->getId(); ?> - <?= $client->getNom() . ' ' . $client->getPrenom(); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Message d’erreur s’il n’y a pas de client sélectionné -->
            <div id="error-client" class="text-danger mt-1"></div>
        </div>

        <!-- Bouton pour soumettre le formulaire -->
        <button type="submit" class="btn btn-primary">Créer le compte</button>
    </form>

</div>

<!-- Lien pour revenir à la liste des comptes -->
<a href="?action=compte.index" class="btn btn-secondary mt-3">Retour à la liste</a>

<!-- J'ajoute ici le script JS pour valider les champs côté client -->
<script src="Js/create-compte.js"></script>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
