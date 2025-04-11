<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Bancaire</title>
    <!-- Ici je définis l'encodage des caractères (UTF-8) et le titre de la page -->
    
    <link rel="stylesheet" href="View/css/header.css">
    <!-- J'inclus une feuille de style spécifique pour le header et la mise en page -->
</head>
<body>

<header>
    🏦 Gestion Bancaire
    <!-- Je crée un en-tête principal pour le site, visible sur toutes les pages -->
</header>

<div class="layout">
    <!-- Cette division contient toute la structure principale : sidebar + contenu -->
    
    <nav class="sidebar">
        <!-- La barre latérale gauche, qui sert de menu de navigation -->

        <ul>
            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                <!-- Si l'utilisateur est un administrateur connecté, j'affiche le menu admin -->

                <li>
                    <a href="?action=dashboard.index" class="<?= $_GET['action'] === 'dashboard.index' ? 'active' : '' ?>">
                        Tableau de bord
                    </a>
                </li>
                <li>
                    <a href="?action=utilisateur.index" class="<?= str_contains($_GET['action'], 'utilisateur') ? 'active' : '' ?>">
                        Gestion des clients
                    </a>
                </li>
                <li>
                    <a href="?action=compte.index" class="<?= str_contains($_GET['action'], 'compte') ? 'active' : '' ?>">
                        Gestion des comptes
                    </a>
                </li>
                <li>
                    <a href="?action=contrat.index" class="<?= str_contains($_GET['action'], 'contrat') ? 'active' : '' ?>">
                        Gestion des contrats
                    </a>
                </li>
                <li>
                    <a href="?action=auth.logout">
                        Déconnexion
                    </a>
                </li>

            <?php elseif (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'user'): ?>
                <!-- Si c'est un utilisateur normal (client), j'affiche un menu plus simple -->

                <li>
                    <a href="?action=home-user">Tableau utilisateur</a>
                </li>
                <li>
                    <a href="?action=auth.logout">Déconnexion</a>
                </li>

            <?php else: ?>
                <!-- Si personne n'est connecté, je propose uniquement la connexion -->

                <li>
                    <a href="?action=auth.login">Connexion</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>

    <main class="main-content">
    <!-- Cette balise <main> est utilisée pour contenir le contenu principal de la page -->
