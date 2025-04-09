<?php require_once __DIR__ . '/Template/Header.php'; ?>
<link rel="stylesheet" href="View/css/client-list.css">

<div class="client-list-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="client-list-title mb-0">👥 Liste des utilisateurs</h2>
        <a href="?action=utilisateur.create" class="btn btn-success">➕ Ajouter un client</a>
    </div>

    <table class="table client-table">
        <thead>
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
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->getId() ?></td>
                <td><?= $user->getNom() ?></td>
                <td><?= $user->getPrenom() ?></td>
                <td><?= $user->getEmail() ?></td>
                <td><?= $user->getTelephone() ?></td>
                <td><?= $user->getAdresse() ?></td>
                <td>
                    <a href="?action=utilisateur.show&id=<?= $user->getId() ?>" class="btn btn-info btn-sm">👁️</a>
                    <a href="?action=utilisateur.edit&id=<?= $user->getId() ?>" class="btn btn-warning btn-sm">✏️</a>
                    <a href="?action=utilisateur.delete&id=<?= $user->getId() ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">❌</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
