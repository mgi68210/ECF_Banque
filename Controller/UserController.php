<?php

// ➤ J'importe tout ce dont j'ai besoin : repositories, modèles, utils
require_once __DIR__ . '/../Models/Repositories/CompteRepository;php'; 
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/Compte.php';
require_once __DIR__ . '/../Lib/utils.php';

class UserController
{
    private $compteRepository;
    private $userRepository;

    public function __construct()
    {
    // Je construis le contrôleur en initialisant les objets CompteRepository et UserRepository
        $this->compteRepository = new CompteRepository();
        $this->userRepository = new UserRepository();
    }

    // C'est la méthode utilisée dans presque toutes les fonctions pour sécuriser l'accès
    private function checkAccess()
    {
        // Si l'utilisateur n'est pas connecté, on le redirige vers la page login
        if (!isConnected()) {
            header('Location: ?action=auth.login');
            exit();
        }

        // Si ce n'est pas un admin, l'accès est interdit
        if (!isAdmin()) {
            header('Location: ?action=forbidden');
            exit();
        }
    }

    // Retourne la liste complète des utilisateurs (sans affichage)
    public function list(): array
    {
        $this->checkAccess();
        return $this->userRepository->getUsers();
    }

    // Affiche la liste des utilisateurs dans la vue
    public function index()
    {
        $this->checkAccess();

        $users = $this->userRepository->getUsers();
        $clientsWithCompteCount = [];

        // Pour chaque utilisateur, je vérifie s'il a un compte
        foreach ($users as $user) {
            $hasCompte = $this->compteRepository->userHasCompte($user->getId());
            $clientsWithCompteCount[$user->getId()] = $hasCompte;
        }

        require_once __DIR__ . '/../View/client-list.php';
    }

    //Affiche les infos d'un utilisateur + ses comptes
    public function show(int $id)
    {
        $this->checkAccess();
        $user = $this->userRepository->getUser($id);
        $comptes = $this->compteRepository->getComptesByUserId($id);
        require_once __DIR__ . '/../View/view-client.php';
    }

    // Affiche le formulaire de création
    public function create()
    {
        $this->checkAccess();
        require_once __DIR__ . '/../View/create-client.php';
    }

    // Enregistre un nouveau client à partir du formulaire
    public function store()
    {
        $this->checkAccess();

        // Je crée un objet User avec les données du formulaire
        $user = new User();
        $user->setNom($_POST['nom']);
        $user->setPrenom($_POST['prenom']);
        $user->setEmail($_POST['email']);
        $user->setTelephone($_POST['telephone']);
        $user->setAdresse($_POST['adresse']);

        // J'appelle le repository pour enregistrer
        $this->userRepository->create($user);

        //  Je redirige vers la liste
        header('Location: ?action=utilisateur.index');
        exit;
    }

    //  Affiche le formulaire de modification d’un client
    public function edit(int $id)
    {
        $this->checkAccess();

        $user = $this->userRepository->getUser($id);

        // Si le client n’existe pas, je redirige
        if (!$user) {
            header('Location: ?action=utilisateur.index');
            exit();
        }

        require_once __DIR__ . '/../View/edit-client.php';
    }

    // Met à jour les infos du client depuis le formulaire
    public function update()
    {
        $this->checkAccess();

        $user = new User();
        $user->setId($_POST['id']);
        $user->setNom($_POST['nom']);
        $user->setPrenom($_POST['prenom']);
        $user->setEmail($_POST['email']);
        $user->setTelephone($_POST['telephone']);
        $user->setAdresse($_POST['adresse']);

        $this->userRepository->update($user);

        header('Location: ?action=utilisateur.index');
        exit;
    }

    // Supprime un client (sauf s’il a encore des comptes !)
    public function delete(int $id)
    {
        $this->checkAccess();

        $comptes = $this->compteRepository->getComptesByUserId($id);

        if (!empty($comptes)) {
            $_SESSION['error'] = "Ce client possède encore des comptes et ne peut pas être supprimé.";
            header('Location: ?action=utilisateur.index');
            exit;
        }

        $this->userRepository->delete($id);

        header('Location: ?action=utilisateur.index');
        exit;
    }

    // Affiche la page d'accès interdit
    public function forbidden()
    {
        require_once __DIR__ . '/../View/403.php';
        http_response_code(403);
    }
}
