<?php
// Je démarre la session pour gérer l'utilisateur connecté
session_start();

// J'utilise un autoloader : il me permet d’inclure automatiquement les classes quand j’en ai besoin
// Je définis les chemins où chercher mes classes (Controller, Models, Repositories, Lib)
spl_autoload_register(function ($class) {
    $paths = [
        'Controller/',
        'Models/',
        'Models/Repositories/',
        'Lib/'
    ];

    foreach ($paths as $path) {
        $file = __DIR__ . "/$path$class.php";
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// J'inclus mes fonctions utilitaires comme isConnected() et isAdmin()
require_once 'Lib/utils.php';

// Ici, je crée une instance de chaque contrôleur dont j’ai besoin
// Chaque objet me permettra d’appeler des méthodes liées à l’authentification, aux utilisateurs, comptes, contrats...
$authController = new AuthController();
$userController = new UserController();
$compteController = new CompteController();
$contratController = new ContratController();

// Je récupère l'action demandée dans l'URL, sinon je mets "auth.login" par défaut
// Exemple d'URL : ?action=compte.index → action = compte.index
$action = $_GET['action'] ?? 'auth.login';

// Je définis ici les actions qui sont accessibles sans être connecté
$publicActions = ['auth.login', 'auth.authenticate'];

// Si l’utilisateur n’est pas connecté et qu’il essaie d'accéder à une page privée,
// alors je le redirige vers la page de connexion
if (!in_array($action, $publicActions) && !isConnected()) {
    header('Location: ?action=auth.login');
    exit();
}

// Ce switch permet de router l’action vers le bon contrôleur et la bonne méthode
switch ($action) {

    // AUTHENTIFICATION
    case 'auth.login':
        $authController->login(); // Je charge la vue de connexion
        break;

    case 'auth.authenticate':
        $authController->authenticate(); // Je vérifie les identifiants
        break;

    case 'auth.logout':
        $authController->logout(); // Je déconnecte l'utilisateur
        break;

    case 'forbidden':
        $authController->forbidden(); // Page d’accès interdit
        break;

    case 'home-user':
        $authController->homeUser(); // Espace client après connexion
        break;

    case 'dashboard.index':
        // Je vérifie que seul l’admin peut accéder au dashboard
        if (!isAdmin()) {
            header('Location: ?action=forbidden');
            exit();
        }
        $authController->dashboard();
        break;

    // UTILISATEURS
    // Je vérifie que toutes les actions utilisateur sont réservées à l’admin
    case 'utilisateur.index':
    case 'utilisateur.show':
    case 'utilisateur.create':
    case 'utilisateur.store':
    case 'utilisateur.edit':
    case 'utilisateur.update':
    case 'utilisateur.delete':
        if (!isAdmin()) {
            header('Location: ?action=forbidden');
            exit();
        }

        // Je récupère la méthode à appeler (ex: "index", "edit", etc.)
        $method = explode('.', $action)[1] ?? 'index';

        // Si la méthode existe dans le contrôleur, je l'appelle
        if (method_exists($userController, $method)) {
            // Certaines méthodes ont besoin d’un ID, je le récupère si présent
            if (in_array($method, ['index', 'create', 'store'])) {
                $userController->$method();
            } else {
                $userController->$method($_GET['id'] ?? null);
            }
        } else {
            http_response_code(404);
            require_once 'View/404.php';
        }
        break;

    // COMPTES
    case 'compte.index':
    case 'compte.show':
    case 'compte.create':
    case 'compte.store':
    case 'compte.edit':
    case 'compte.update':
    case 'compte.delete':
        if (!isAdmin()) {
            header('Location: ?action=forbidden');
            exit();
        }

        $method = explode('.', $action)[1] ?? 'index';

        if (method_exists($compteController, $method)) {
            if (in_array($method, ['index', 'create', 'store'])) {
                $compteController->$method();
            } else {
                $compteController->$method($_GET['id'] ?? null);
            }
        } else {
            http_response_code(404);
            require_once 'View/404.php';
        }
        break;

    // CONTRATS
    case 'contrat.index':
    case 'contrat.show':
    case 'contrat.create':
    case 'contrat.store':
    case 'contrat.edit':
    case 'contrat.update':
    case 'contrat.delete':
        if (!isAdmin()) {
            header('Location: ?action=forbidden');
            exit();
        }

        $method = explode('.', $action)[1] ?? 'index';

        if (method_exists($contratController, $method)) {
            if (in_array($method, ['index', 'create', 'store'])) {
                $contratController->$method();
            } else {
                $contratController->$method($_GET['id'] ?? null);
            }
        } else {
            http_response_code(404);
            require_once 'View/404.php';
        }
        break;

    // CAS PAR DÉFAUT : Si aucune action ne correspond, je montre une erreur 404
    default:
        http_response_code(404);
        require_once 'View/404.php';
        break;
}
