<?php

require_once __DIR__ . '/../Models/Repositories/UserRepository.php';
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/Repositories/AdminRepository.php';
require_once __DIR__ . '/../Models/Admin.php';
require_once __DIR__ . '/../Models/Repositories/CompteRepository;php';
require_once __DIR__ . '/../Lib/utils.php';

class AuthController
{
    private UserRepository $userRepository;
    private AdminRepository $adminRepository;
    private CompteRepository $compteRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->adminRepository = new AdminRepository();
        $this->compteRepository = new CompteRepository();
    }

    public function login()
    {
        require_once __DIR__ . '/../View/login.php';
    }

    public function authenticate()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // 1. Vérifie si c'est un admin
        $admin = $this->adminRepository->getAdminByEmail($email);
        if ($admin && password_verify($password, $admin->getMotDePasse())) {
            $_SESSION['user_id'] = $admin->getIdAdmin();
            $_SESSION['user_role'] = 'admin';
            header('Location: ?action=dashboard.index');
            exit();
        }

        // 2. Sinon on accepte comme utilisateur fictif (pas besoin de check DB)
        $_SESSION['user_id'] = rand(1000, 9999);
        $_SESSION['user_role'] = 'user';
        header('Location: ?action=home-user');
        exit();
    }

    public function logout()
    {
        session_destroy();
        header('Location: ?action=auth.login');
        exit();
    }

    public function forbidden()
    {
        http_response_code(403);
        require_once __DIR__ . '/../View/403.php';
    }

    public function homeUser()
    {
        require_once __DIR__ . '/../View/home-user.php';
    }

    public function dashboard()
    {
        if (!isAdmin()) {
            header('Location: ?action=forbidden');
            exit();
        }

        $clients = $this->userRepository->getUsers();
        $comptes = $this->compteRepository->getComptes();

        $nombreClients = count($clients);
        $nombreComptes = count($comptes);
        $nombreContrats = 0; // si tu ajoutes la gestion de contrats plus tard

        require_once __DIR__ . '/../View/dashboard.php';
    }
}
