<?php
// Je fais une vérification de sécurité pour m'assurer qu'un utilisateur est bien défini.
// Si ce n'est pas le cas, je redirige immédiatement vers la page interdite.
if (!isset($user)) {
    header('Location: ?action=forbidden');
    exit();
}
?>

<?php require_once __DIR__ . '/Template/Header.php'; ?>

<!-- Je relie la feuille CSS spécifique à cette page -->
<link rel="stylesheet" href="View/css/home-user.css">

<!-- Bloc principal de l'espace utilisateur -->
<div class="user-home animate-zoom">

    <!-- Image illustrative du profil -->
    <img src="https://cdn-icons-png.flaticon.com/512/1077/1077012.png" alt="User Home" style="width: 90px; margin-bottom: 20px;">

    <!-- Message de bienvenue personnalisé -->
    <h2>👋 Bienvenue <?= htmlspecialchars($user->getPrenom()) ?> <?= htmlspecialchars($user->getNom()) ?></h2>
    <p>Voici les informations de votre espace personnel.</p>

    <!-- Section des informations personnelles -->
    <div class="user-info">
        <h4>📇 Informations personnelles</h4>
        <ul>
            <li><strong>Nom :</strong> <?= htmlspecialchars($user->getNom()) ?></li>
            <li><strong>Prénom :</strong> <?= htmlspecialchars($user->getPrenom()) ?></li>
            <li><strong>Email :</strong> <?= htmlspecialchars($user->getEmail()) ?></li>
            <li><strong>Téléphone :</strong> <?= htmlspecialchars($user->getTelephone()) ?></li>
            <li><strong>Adresse :</strong> <?= htmlspecialchars($user->getAdresse()) ?></li>
        </ul>
    </div>

    <!-- Section des comptes bancaires -->
    <div class="user-accounts mt-5">
        <h4>💰 Comptes bancaires</h4>

        <?php if (!empty($comptes)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>RIB</th>
                        <th>Type</th>
                        <th>Solde (€)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comptes as $compte): ?>
                        <tr>
                            <td><?= $compte->getRib() ?></td>
                            <td><?= $compte->getTypeCompte() ?></td>
                            <td><?= number_format($compte->getSoldeInitial(), 2, ',', ' ') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <!-- ℹMessage si aucun compte n'est associé à l'utilisateur -->
            <p class="text-muted">Aucun compte associé.</p>
        <?php endif; ?>
    </div>

    <!-- Section des contrats -->
    <div class="user-contracts mt-5">
        <h4>📄 Contrats souscrits</h4>

        <?php if (!empty($contrats)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Montant (€)</th>
                        <th>Durée (mois)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contrats as $contrat): ?>
                        <tr>
                            <td><?= htmlspecialchars($contrat->getTypeContrat()) ?></td>
                            <td><?= number_format($contrat->getMontant(), 2, ',', ' ') ?></td>
                            <td><?= $contrat->getDuree() ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <!-- Message si aucun contrat trouvé -->
            <p class="text-muted">Aucun contrat souscrit.</p>
        <?php endif; ?>
    </div>

    <!-- Lien de déconnexion -->
    <div class="mt-4 text-center">
        <a href="?action=auth.logout" class="btn btn-danger">🚪 Se déconnecter</a>
    </div>
</div>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
