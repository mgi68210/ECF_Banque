<?php require_once __DIR__ . '/Template/Header.php'; ?>

<link rel="stylesheet" href="View/css/edit-client.css">

<div class="edit-client-container">
    <form action="?action=utilisateur.update" method="POST" class="edit-client-form">
        <h2>✏️ Modifier un client</h2>

        <input type="hidden" name="id" value="<?= $user->getId(); ?>">

        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" name="nom" id="nom" class="form-control" value="<?= htmlspecialchars($user->getNom()); ?>" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom :</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="<?= htmlspecialchars($user->getPrenom()); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($user->getEmail()); ?>" required>
        </div>
        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone :</label>
            <input type="text" name="telephone" id="telephone" class="form-control" value="<?= htmlspecialchars($user->getTelephone()); ?>" required>
        </div>
        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse :</label>
            <input type="text" name="adresse" id="adresse" class="form-control" value="<?= htmlspecialchars($user->getAdresse()); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>

    </form>
</div>
<a href="?action=utilisateur.index" class="btn btn-secondary mt-3 w-100">⬅️ Retour</a>
<?php require_once __DIR__ . '/Template/Footer.php'; ?>
