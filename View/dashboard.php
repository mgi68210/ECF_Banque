<?php require_once __DIR__ . '/Template/Header.php'; ?>

<!-- J’inclus ici le fichier CSS dédié au tableau de bord -->
<link rel="stylesheet" href="View/css/dashboard.css">

<!-- Conteneur principal du tableau de bord -->
<div class="dashboard-container">
    <h2>📊 Tableau de bord</h2>

    <!-- Ici je présente un résumé rapide avec des cartes : nombre de clients, comptes et contrats -->
    <div class="dashboard-cards">
        <!-- Carte pour le nombre total de clients -->
        <div class="dashboard-card card-client">
            <h4>👥 Clients enregistrés</h4>
            <div class="count"><?= $nombreClients ?></div>
            <a href="?action=utilisateur.index">Voir les clients</a>
        </div>

        <!-- Carte pour le nombre de comptes bancaires -->
        <div class="dashboard-card card-compte">
            <h4>💰 Comptes ouverts</h4>
            <div class="count"><?= $nombreComptes ?></div>
            <a href="?action=compte.index">Voir les comptes</a>
        </div>

        <!-- Carte pour le nombre de contrats -->
        <div class="dashboard-card card-contrat">
            <h4>📄 Contrats souscrits</h4>
            <div class="count"><?= $nombreContrats ?></div>
            <a href="?action=contrat.index">Voir les contrats</a>
        </div>
    </div>

    <!-- Section détaillée des comptes et contrats pour chaque client -->
    <h3 class="text-center mb-3">🔍 Détail des comptes et contrats par client</h3>

    <!-- Table responsive pour un affichage fluide sur tous les écrans -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>Client</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Comptes</th>
                    <th>Contrats</th>
                </tr>
            </thead>
            <tbody>
                <!-- Je parcours chaque client -->
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <!-- Affichage des infos de base -->
                        <td><?= $client->getNom() . ' ' . $client->getPrenom() ?></td>
                        <td><?= $client->getEmail() ?></td>
                        <td><?= $client->getTelephone() ?></td>

                        <!-- Affichage des comptes bancaires du client -->
                        <td>
                            <?php 
                            // Je filtre les comptes qui appartiennent au client actuel
                            $clientComptes = array_filter($comptes, fn($c) => $c->getIdUtilisateur() == $client->getId()); 
                            ?>
                            <?php if (empty($clientComptes)): ?>
                                <em>Aucun compte</em>
                            <?php else: ?>
                                <!-- Liste des comptes du client -->
                                <ul class="list-unstyled mb-0">
                                    <?php foreach ($clientComptes as $compte): ?>
                                        <li>💳 <?= $compte->getRib() ?> - <?= $compte->getTypeCompte() ?> - <?= number_format($compte->getSoldeInitial(), 2) ?> €</li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </td>

                        <!-- Affichage des contrats du client -->
                        <td>
                            <?php 
                            // Je filtre les contrats liés à ce client
                            $clientContrats = array_filter($contrats, fn($con) => $con->getIdUtilisateur() == $client->getId()); 
                            ?>
                            <?php if (empty($clientContrats)): ?>
                                <em>Aucun contrat</em>
                            <?php else: ?>
                                <!-- Liste des contrats du client -->
                                <ul class="list-unstyled mb-0">
                                    <?php foreach ($clientContrats as $contrat): ?>
                                        <li>📄 <?= $contrat->getTypeContrat() ?> - <?= number_format($contrat->getMontant(), 2) ?> € - <?= $contrat->getDuree() ?> mois</li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
