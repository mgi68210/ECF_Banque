<?php require_once __DIR__ . '/Template/Header.php'; ?>

<h2 class="mb-4 text-center">💰 Liste des comptes</h2>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>RIB</th>
            <th>Type de compte</th>
            <th>Solde initial</th>
            <th>Nom du client</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($comptes as $compte): ?>
        <tr>
            <td><?= $compte->getIdCompte() ?></td>
            <td><?= $compte->getRib() ?></td>
            <td><?= $compte->getTypeCompte() ?></td>
            <td><?= number_format($compte->getSoldeInitial(), 2) ?> €</td>
            <td><?= $compte->client_nom . ' ' . $compte->client_prenom ?></td>
            <td>
                <a href="?action=compte.show&id=<?= $compte->getIdCompte() ?>" class="btn btn-info">👁️ Voir</a>
                <a href="?action=compte.edit&id=<?= $compte->getIdCompte() ?>" class="btn btn-warning">✏️ Modifier</a>
                <a href="?action=compte.delete&id=<?= $compte->getIdCompte() ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?')">❌ Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="?action=compte.create" class="btn btn-success">➕ Ajouter un compte</a>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
