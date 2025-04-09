<?php require_once __DIR__ . '/Template/Header.php'; ?>

<h2 class="mb-4 text-center">Liste des utilisateurs et des comptes</h2>

<h3>Clients :</h3>
<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Adresse</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clients as $user): ?>
        <tr>
            <td><?= $user->getId() ?></td>
            <td><?= $user->getNom() ?></td>
            <td><?= $user->getPrenom() ?></td>
            <td><?= $user->getEmail() ?></td>
            <td><?= $user->getTelephone() ?></td>
            <td><?= $user->getAdresse() ?></td>
            <td>
                <a href="?action=utilisateur.show&id=<?= $user->getId() ?>" class="btn btn-info">👁️ Voir</a>
                <a href="?action=utilisateur.edit&id=<?= $user->getId() ?>" class="btn btn-warning">✏️ Modifier</a>
                <a href="?action=utilisateur.delete&id=<?= $user->getId() ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">❌ Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h3>Comptes :</h3>
<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID Compte</th>
            <th>RIB</th>
            <th>Type de compte</th>
            <th>Solde initial</th>
            <th>ID Utilisateur</th>
            <th>Actions</th>
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
            <td>
                <a href="?action=compte.show&id=<?= $compte->getIdCompte() ?>" class="btn btn-info">👁️ Voir</a>
                <a href="?action=compte.edit&id=<?= $compte->getIdCompte() ?>" class="btn btn-warning">✏️ Modifier</a>
                <a href="?action=compte.delete&id=<?= $compte->getIdCompte() ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?')">❌ Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>