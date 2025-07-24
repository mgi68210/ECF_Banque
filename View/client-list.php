<?php require_once __DIR__ . '/Template/Header.php'; ?> 

<link rel="stylesheet" href="View/css/client-list.css"> 

<div class="client-list-container">
    <h2 class="client-list-title"> Liste des clients</h2>

    <table class="client-table">

        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Actions</th> <!-- Colonne pour les boutons (voir, modifier, supprimer) -->
            </tr>
        </thead>

        <tbody>
            <!-- Corps du tableau, qui va afficher chaque utilisateur -->
            <?php foreach ($users as $user): ?>
                <!-- Je parcours tous les utilisateurs stockés dans la variable $users -->

                <tr 
                    data-id="<?= $user->getId() ?>" 
                    data-has-comptes="<?= $user->hasCompte ? '1' : '0' ?>"
                >
                    <!-- Je crée une ligne de tableau pour chaque utilisateur.
                         Les attributs "data-id" et "data-has-comptes" sont utilisés par JavaScript
                         pour vérifier s’il a des comptes (utile pour empêcher la suppression par exemple) -->

                    <td><?= $user->getId() ?></td>
                    <!-- J'affiche l'ID de l'utilisateur -->

                    <td><?= htmlspecialchars($user->getNom()) ?></td>
                    <!-- J'affiche le nom. htmlspecialchars() protège contre les failles XSS -->

                    <td><?= htmlspecialchars($user->getPrenom()) ?></td>
                    <!-- J'affiche le prénom -->

                    <td><?= htmlspecialchars($user->getEmail()) ?></td>
                    <!-- J'affiche l'e-mail -->

                    <td><?= htmlspecialchars($user->getTelephone()) ?></td>
                    <!-- J'affiche le numéro de téléphone -->

                    <td><?= htmlspecialchars($user->getAdresse()) ?></td>
                    <!-- J'affiche l'adresse -->

                    <td>
                        <!-- Boutons d’action -->
                        <a href="?action=utilisateur.show&id=<?= $user->getId() ?>" class="btn btn-info btn-sm mb-1">
                            Voir
                        </a>
                        <!-- Redirige vers la page de détail du client -->

                        <a href="?action=utilisateur.edit&id=<?= $user->getId() ?>" class="btn btn-warning btn-sm mb-1">
                            Modifier
                        </a>
                        <!-- Redirige vers le formulaire d’édition -->

                        <a href="?action=utilisateur.delete&id=<?= $user->getId() ?>"
                        class="btn btn-danger btn-sm mb-1"
                        onclick="return confirm('⚠️ Attention : La suppression de ce client entraînera également la suppression de tous ses comptes et contrats associés. Voulez-vous vraiment continuer ?');">
                        ❌ Supprimer
                        </a>
                        <!-- Supprime le client après confirmation. Le JavaScript peut bloquer cette action si l’utilisateur a des comptes -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-end mt-3">
        <!-- Bouton pour créer un nouvel utilisateur -->
        <a href="?action=utilisateur.create" class="btn btn-primary"> Ajouter un client</a>
    </div>
</div>

<script src="Js/client-list.js"></script>
<!-- J’inclus le script JavaScript qui gère la logique de confirmation avant suppression -->

<?php require_once __DIR__ . '/Template/Footer.php'; ?> 
