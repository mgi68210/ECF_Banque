<?php require_once __DIR__ . '/Template/Header.php'; ?>
<link rel="stylesheet" href="View/css/view-contrat.css">

<div class="view-contrat-container">
    <div class="view-contrat-card">
        <!-- Titre principal -->
        <h2>📄 Détail du contrat</h2>

        <?php if (isset($contrat)): ?>
            <!-- Si la variable $contrat est définie, alors je peux afficher ses détails -->
            <table>
                <thead>
                    <tr>
                        <th>ID Contrat</th>
                        <th>Type de contrat</th>
                        <th>Montant souscrit (€)</th>
                        <th>Durée (mois)</th>
                        <th>Client</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!-- J'affiche les infos récupérées depuis l’objet Contrat -->
                        <td><?= $contrat->getIdContrat(); ?></td>
                        <td><?= htmlspecialchars($contrat->getTypeContrat()); ?></td>
                        <td><?= number_format($contrat->getMontant(), 2, ',', ' '); ?> €</td>
                        <td><?= $contrat->getDuree(); ?></td>
                        <td>
                            <!-- Je vérifie si l’objet $client est défini, sinon j’affiche un message d’erreur -->
                            <?= $client ? $client->getId() . ' - ' . $client->getNom() . ' ' . $client->getPrenom() : 'Client introuvable'; ?>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Liens vers les actions possibles -->
            <div class="d-flex justify-content-between mt-4">
                <!-- Lien de modification -->
                <a href="?action=contrat.edit&id=<?= $contrat->getIdContrat() ?>" class="btn btn-warning">✏️ Modifier</a>
                <!-- Lien retour vers liste -->
                <a href="?action=contrat.index" class="btn btn-secondary">⬅️ Retour à la liste</a>
            </div>
        <?php else: ?>
            <!-- Si aucun contrat trouvé, j'affiche un message -->
            <p class="text-muted text-center">Aucun contrat trouvé.</p>
            <a href="?action=contrat.index" class="btn btn-secondary mt-3">⬅️ Retour à la liste</a>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
