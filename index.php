<?php
session_start();

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

require_once 'Lib/utils.php';

$authController = new AuthController();
$userController = new UserController();
$compteController = new CompteController();

$action = $_GET['action'] ?? 'auth.login';

// Actions publiques
$publicActions = ['auth.login', 'auth.authenticate'];

// Si non connecté et action privée
if (!in_array($action, $publicActions) && !isConnected()) {
    header('Location: ?action=auth.login');
    exit();
}

switch ($action) {
    // Auth
    case 'auth.login':
        $authController->login();
        break;

    case 'auth.authenticate':
        $authController->authenticate();
        break;

    case 'auth.logout':
        $authController->logout();
        break;

    case 'forbidden':
        $authController->forbidden();
        break;

    case 'home-user':
        $authController->homeUser();
        break;

    case 'dashboard.index':
        if (!isAdmin()) {
            header('Location: ?action=forbidden');
            exit();
        }
        $authController->dashboard();
        break;

    // Utilisateurs (admin)
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
        $method = explode('.', $action)[1] ?? 'index';
        if (method_exists($userController, $method)) {
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

    // Comptes (admin)
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

    // Route inconnue
    default:
        http_response_code(404);
        require_once 'View/404.php';
        break;
}
