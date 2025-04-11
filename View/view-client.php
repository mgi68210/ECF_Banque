<?php require_once __DIR__ . '/Template/Header.php'; ?>

<!-- Je lie le fichier CSS qui stylise la page -->
<link rel="stylesheet" href="View/css/view-client.css">

<div class="view-client-container">
    <div class="view-client-card">
        <!-- Titre de la page -->
        <h2>📋 Détail du client</h2>

        <!-- Je construis un tableau HTML pour afficher les infos du client -->
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
                    <!-- Ici j’utilise les getters de l’objet $user pour afficher ses propriétés -->
                    <td><?= $user->getId() ?></td>
                    <td><?= $user->getNom() ?></td>
                    <td><?= $user->getPrenom() ?></td>
                    <td><?= $user->getEmail() ?></td>
                    <td><?= $user->getTelephone() ?></td>
                    <td><?= $user->getAdresse() ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Zone de boutons pour modifier ou revenir -->
        <div class="d-flex justify-content-between">
            <!-- Lien vers le formulaire de modification -->
            <a href="?action=utilisateur.edit&id=<?= $user->getId() ?>" class="btn btn-warning">✏️ Modifier</a>
        </div>
    </div>
</div>

<!-- Lien pour revenir à la liste des utilisateurs -->
<a href="?action=utilisateur.index" class="btn btn-secondary">⬅️ Retour</a>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
