<?php require_once __DIR__ . '/Template/Header.php'; ?>

<link rel="stylesheet" href="View/css/create-compte.css">

<div class="container create-compte-container">

    <form action="?action=compte.store" method="POST" id="createCompteForm" class="create-compte-form">
        <h2> Créer un nouveau compte</h2>

        <div class="mb-3">
            <label for="rib" class="form-label">RIB :</label>

            <input type="text" class="form-control" id="rib" name="rib">

            <div id="error-rib" class="text-danger mt-1"></div>
        </div>

        <div class="mb-3">
            <label for="type_compte" class="form-label">Type de compte :</label>

            <!-- Menu déroulant pour choisir entre Compte courant et Compte épargne -->
            <select class="form-control" id="type_compte" name="type_compte">
                <option value="">-- Sélectionnez un type --</option>
                <option value="Compte courant">Compte courant</option>
                <option value="Compte épargne">Compte épargne</option>
            </select>

            <div id="error-type-compte" class="text-danger mt-1"></div>
        </div>

        <div class="mb-3">
            <label for="solde_initial" class="form-label">Solde initial :</label>

            <input type="number" class="form-control" id="solde_initial" name="solde_initial" step="0.01">

            <div id="error-solde" class="text-danger mt-1"></div>
        </div>

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

            <div id="error-client" class="text-danger mt-1"></div>
        </div>

        <button type="submit" class="btn btn-primary">Créer le compte</button>
    </form>

</div>

<a href="?action=compte.index" class="btn btn-secondary mt-3">Retour à la liste</a>

<!-- J'ajoute ici le script JS pour valider les champs côté client -->
<script src="Js/create-compte.js"></script>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
