<?php require_once __DIR__ . '/Template/Header.php'; ?>
<link rel="stylesheet" href="View/css/dashboard.css">

<div class="dashboard-container">
    <h2>📊 Tableau de bord</h2>

    <!-- Cartes résumé -->
    <div class="dashboard-cards">
        <div class="dashboard-card card-client">
            <h4>👥 Clients enregistrés</h4>
            <div class="count"><?= $nombreClients ?></div>
            <a href="?action=utilisateur.index">Voir les clients</a>
        </div>

        <div class="dashboard-card card-compte">
            <h4>💰 Comptes ouverts</h4>
            <div class="count"><?= $nombreComptes ?></div>
            <a href="?action=compte.index">Voir les comptes</a>
        </div>

        <div class="dashboard-card card-contrat">
            <h4>📄 Contrats souscrits</h4>
            <div class="count"><?= $nombreContrats ?></div>
            <span class="text-muted">Fonctionnalité à venir</span>
        </div>
    </div>

    <!-- Détails comptes par client -->
    <h3 class="text-center mb-3">🔍 Détail des comptes par client</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>Client</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>RIB</th>
                    <th>Type</th>
                    <th>Solde</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client): ?>
                    <?php $clientComptes = array_filter($comptes, fn($c) => $c->getIdUtilisateur() == $client->getId()); ?>
                    <?php if (empty($clientComptes)): ?>
                        <tr>
                            <td><?= $client->getNom() . ' ' . $client->getPrenom() ?></td>
                            <td><?= $client->getEmail() ?></td>
                            <td><?= $client->getTelephone() ?></td>
                            <td colspan="3" class="text-muted">Aucun compte</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($clientComptes as $compte): ?>
                            <tr>
                                <td><?= $client->getNom() . ' ' . $client->getPrenom() ?></td>
                                <td><?= $client->getEmail() ?></td>
                                <td><?= $client->getTelephone() ?></td>
                                <td><?= $compte->getRib() ?></td>
                                <td><?= $compte->getTypeCompte() ?></td>
                                <td><?= number_format($compte->getSoldeInitial(), 2) ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
