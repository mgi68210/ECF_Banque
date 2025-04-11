<?php require_once __DIR__ . '/Template/Header.php'; ?>
<!-- Je commence par inclure le fichier d'en-tête, qui contient tout le haut de la page HTML (menu, titre du site, etc.) -->

<!-- Titre centré pour annoncer la liste des comptes -->
<h2 class="mb-4 text-center">💰 Liste des comptes</h2>

<!-- Je construis un tableau HTML stylisé avec Bootstrap -->
<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <!-- En-têtes du tableau : chaque colonne correspond à une information du compte -->
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
        <!-- Je parcours tous les comptes récupérés dans la variable $comptes -->
        <?php foreach ($comptes as $compte): ?>
            <tr>
                <!-- J’affiche les infos du compte en utilisant les getters -->
                <td><?= $compte->getIdCompte() ?></td>
                <td><?= $compte->getRib() ?></td>
                <td><?= $compte->getTypeCompte() ?></td>
                <td><?= number_format($compte->getSoldeInitial(), 2) ?> €</td>
                <td><?= $compte->client_nom . ' ' . $compte->client_prenom ?></td>

                <!-- Pour chaque compte, j’affiche les boutons d’action -->
                <td>
                    <!-- Lien pour voir les détails du compte -->
                    <a href="?action=compte.show&id=<?= $compte->getIdCompte() ?>" class="btn btn-info">
                        👁️ Voir
                    </a>

                    <!-- Lien pour modifier le compte -->
                    <a href="?action=compte.edit&id=<?= $compte->getIdCompte() ?>" class="btn btn-warning">
                        ✏️ Modifier
                    </a>

                    <!-- Lien pour supprimer le compte (avec confirmation) -->
                    <a href="?action=compte.delete&id=<?= $compte->getIdCompte() ?>"
                       class="btn btn-danger"
                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?')">
                       ❌ Supprimer
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        <!-- Fin de la boucle -->
    </tbody>
</table>

<!-- Bouton pour ajouter un nouveau compte -->
<a href="?action=compte.create" class="btn btn-success">➕ Ajouter un compte</a>

<!-- J’inclus le footer (bas de page commun) -->
<?php require_once __DIR__ . '/Template/Footer.php'; ?>
