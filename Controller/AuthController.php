<?php

require_once __DIR__ . '/../Models/Repositories/UserRepository.php';     // Pour accéder aux utilisateurs
require_once __DIR__ . '/../Models/User.php';                            // Modèle représentant un utilisateur
require_once __DIR__ . '/../Models/Repositories/AdminRepository.php';    // Pour accéder aux administrateurs
require_once __DIR__ . '/../Models/Admin.php';                           // Modèle représentant un administrateur
require_once __DIR__ . '/../Models/Repositories/CompteRepository;php';   // Pour accéder aux comptes bancaires
require_once __DIR__ . '/../Models/Repositories/ContratRepository.php';  // Pour accéder aux contrats
require_once __DIR__ . '/../Lib/utils.php';                              // Fonctions utilitaires (isConnected, isAdmin...)

class AuthController
{
    // Je déclare les propriétés qui vont contenir mes objets repository
    private UserRepository $userRepository;
    private AdminRepository $adminRepository;
    private CompteRepository $compteRepository;
    private ContratRepository $contratRepository;

    // Je construis le contrôleur en initialisant les objets CompteRepository, UserRepository, AdminRepository, ContratRepository
    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->adminRepository = new AdminRepository();
        $this->compteRepository = new CompteRepository();
        $this->contratRepository = new ContratRepository();
    }

    // Cette méthode affiche le formulaire de connexion
    public function login()
    {
        require_once __DIR__ . '/../View/login.php';
    }

    // Cette méthode vérifie les identifiants envoyés via le formulaire de connexion
    public function authenticate()
    {
        // Je récupère les valeurs saisies dans le formulaire
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Je commence par vérifier si c’est un administrateur
        $admin = $this->adminRepository->getAdminByEmail($email);
        if ($admin && password_verify($password, $admin->getMotDePasse())) {
            // Si le mot de passe est bon, je stocke son ID et son rôle dans la session
            $_SESSION['user_id'] = $admin->getIdAdmin();
            $_SESSION['user_role'] = 'admin';
            // Je le redirige vers le tableau de bord
            header('Location: ?action=dashboard.index');
            exit();
        }

        // Sinon, je vérifie si c’est un utilisateur normal
        $user = $this->userRepository->getUserByEmail($email);
        if ($user && password_verify($password, $user->getPassword())) {
            // Si c’est bien un utilisateur existant avec le bon mot de passe, je l’authentifie
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['user_role'] = 'user';
            // Je le redirige vers son espace personnel
            header('Location: ?action=home-user');
            exit();
        }

        // Si aucun des deux cas n’est valide, j’affiche la page 403
        $error = "Identifiants incorrects.";
        require_once __DIR__ . '/../View/403.php';
    }

    // Cette méthode permet à l'utilisateur de se déconnecter
    public function logout()
    {
        // Je détruis la session et je le renvoie vers la page de connexion
        session_destroy();
        header('Location: ?action=auth.login');
        exit();
    }

    // Si un utilisateur tente d’accéder à une page interdite
    public function forbidden()
    {
        http_response_code(403);
        require_once __DIR__ . '/../View/403.php';
    }

    // Cette méthode affiche l’espace personnel d’un utilisateur connecté
    public function homeUser()
    {
        // Si l’utilisateur n’est pas connecté ou que ce n’est pas un "user", je bloque l’accès
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'user') {
            header('Location: ?action=forbidden');
            exit();
        }

        // Je récupère l’objet utilisateur à partir de son ID
        $user = $this->userRepository->getUser($_SESSION['user_id']);
        if (!$user) {
            // Si l’utilisateur n’existe pas en base, je bloque l’accès
            header('Location: ?action=forbidden');
            exit();
        }

        // Je récupère tous les comptes bancaires liés à cet utilisateur
        $comptes = $this->compteRepository->getComptesByUserId($user->getId());

        // Je récupère tous les contrats, puis je filtre uniquement ceux de l’utilisateur
        $allContrats = $this->contratRepository->getContrats();
        $contrats = array_filter($allContrats, fn($c) => $c->getIdUtilisateur() == $user->getId());

        // J'affiche la vue de l’espace personnel utilisateur
        require_once __DIR__ . '/../View/home-user.php';
    }

    // Cette méthode charge les données à afficher dans le tableau de bord de l'admin
    public function dashboard()
    {
        // Je récupère tous les clients, comptes et contrats
        $clients = $this->userRepository->getUsers();
        $comptes = $this->compteRepository->getComptes();
        $contrats = $this->contratRepository->getContrats();

        // Je compte combien il y a de clients, comptes et contrats
        $nombreClients = count($clients);
        $nombreComptes = count($comptes);
        $nombreContrats = count($contrats);

        // J'affiche la vue du tableau de bord
        require_once __DIR__ . '/../View/dashboard.php';
    }
}
