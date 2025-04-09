<?php require_once __DIR__ . '/Template/Header.php'; ?>

<link rel="stylesheet" href="View/css/edit-compte.css">

<div class="edit-compte-container">
    <form action="?action=compte.update" method="POST" class="edit-compte-form">
        <h2>✏️ Modifier un compte</h2>

        <input type="hidden" name="id_compte" value="<?= $compte->getIdCompte(); ?>">

        <div class="mb-3">
            <label for="rib" class="form-label">RIB :</label>
            <input type="text" class="form-control" id="rib" name="rib" value="<?= htmlspecialchars($compte->getRib()); ?>" required>
        </div>

        <div class="mb-3">
            <label for="type_compte" class="form-label">Type de compte :</label>
            <select class="form-control" id="type_compte" name="type_compte" required>
                <option value="">-- Choisir un type --</option>
                <option value="Compte courant" <?= $compte->getTypeCompte() === "Compte courant" ? "selected" : "" ?>>Compte courant</option>
                <option value="Compte épargne" <?= $compte->getTypeCompte() === "Compte épargne" ? "selected" : "" ?>>Compte épargne</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="solde_initial" class="form-label">Solde initial :</label>
            <input type="number" class="form-control" id="solde_initial" name="solde_initial" value="<?= htmlspecialchars($compte->getSoldeInitial()); ?>" required step="0.01">
        </div>

        <div class="mb-3">
            <label for="id_utilisateur" class="form-label">Client :</label>
            <input type="number" class="form-control" id="id_utilisateur" name="id_utilisateur" value="<?= htmlspecialchars($compte->getIdUtilisateur()); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour le compte</button>
    </form>
</div>
<a href="?action=compte.index" class="btn btn-secondary mt-3 w-100">⬅️ Retour</a>

<?php require_once __DIR__ . '/Template/Footer.php'; ?>
