<?php require_once __DIR__ . '/Template/Header.php'; ?>
<!-- J'inclus le header commun à toutes les pages -->

<!-- Titre centré pour présenter la page -->
<h2 class="mb-4 text-center">📄 Liste des contrats</h2>

<!-- Début du tableau affichant tous les contrats -->
<table class="table table-bordered table-hover text-center">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Type de contrat</th>
            <th>Montant (€)</th>
            <th>Durée (mois)</th>
            <th>Client</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <!-- Je vérifie s’il y a des contrats à afficher -->
        <?php if (!empty($contrats)): ?>
            <!-- Je parcours chaque contrat avec une boucle -->
            <?php foreach ($contrats as $contrat): ?>
                <tr>
                    <td><?= $contrat->getIdContrat(); ?></td>
                    <td><?= htmlspecialchars($contrat->getTypeContrat()); ?></td>
                    <td><?= number_format($contrat->getMontant(), 2, ',', ' '); ?> €</td>
                    <td><?= htmlspecialchars($contrat->getDuree()); ?></td>
                    <td><?= htmlspecialchars($contrat->client_nom . ' ' . $contrat->client_prenom); ?></td>

                    <!-- Actions disponibles pour chaque contrat -->
                    <td>
                        <!-- Voir le détail -->
                        <a href="?action=contrat.show&id=<?= $contrat->getIdContrat(); ?>" class="btn btn-info btn-sm mb-1">
                            👁️ Voir
                        </a>

                        <!-- Modifier le contrat -->
                        <a href="?action=contrat.edit&id=<?= $contrat->getIdContrat(); ?>" class="btn btn-warning btn-sm mb-1">
                            ✏️ Modifier
                        </a>

                        <!-- Supprimer le contrat avec confirmation -->
                        <a href="?action=contrat.delete&id=<?= $contrat->getIdContrat(); ?>"
                           class="btn btn-danger btn-sm mb-1"
                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contrat ?');">
                            ❌ Supprimer
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Si aucun contrat enregistré, j'affiche un message -->
            <tr>
                <td colspan="6" class="text-muted">Aucun contrat enregistré.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Bouton pour ajouter un nouveau contrat -->
<div class="d-flex justify-content-end mb-3">
    <a href="?action=contrat.create" class="btn btn-success">➕ Ajouter un contrat</a>
</div>

<!-- Inclusion du footer -->
<?php require_once __DIR__ . '/Template/Footer.php'; ?>
