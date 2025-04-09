<?php require_once __DIR__ . '/Template/Header.php'; ?>

<link rel="stylesheet" href="View/css/view-client.css">

<div class="view-client-container">
    <div class="view-client-card">
        <h2>📋 Détail du client</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $user->getId() ?></td>
                    <td><?= $user->getNom() ?></td>
                    <td><?= $user->getPrenom() ?></td>
                    <td><?= $user->getEmail() ?></td>
                    <td><?= $user->getTelephone() ?></td>
                    <td><?= $user->getAdresse() ?></td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between">
            <a href="?action=utilisateur.edit&id=<?= $user->getId() ?>" class="btn btn-warning">✏️ Modifier</a>
        </div>
    </div>
</div>
<a href="?action=utilisateur.index" class="btn btn-secondary">⬅️ Retour</a>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
