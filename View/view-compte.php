<?php require_once __DIR__ . '/Template/Header.php'; ?>

<h2 class="mb-4 text-center">📋 Détail du compte</h2>

<?php if (isset($comptes) && !empty($comptes)): ?>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>RIB</th>
                <th>Type de compte</th>
                <th>Solde initial</th>
                <th>ID Utilisateur</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comptes as $compte): ?>
                <tr>
                    <td><?= $compte->getIdCompte() ?></td>
                    <td><?= $compte->getRib() ?></td>
                    <td><?= $compte->getTypeCompte() ?></td>
                    <td><?= $compte->getSoldeInitial() ?> €</td>
                    <td><?= $compte->getIdUtilisateur() ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Aucun compte trouvé pour cet utilisateur.</p>
<?php endif; ?>

<div class="mt-4">
    <a href="?action=compte.edit&id=<?= $compte->getIdCompte() ?>" class="btn btn-warning">✏️ Modifier</a>
    <a href="?action=compte.index" class="btn btn-secondary">⬅️ Retour à la liste</a>
</div>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>