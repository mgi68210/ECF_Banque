<?php

//  J'importe les classes nécessaires
require_once __DIR__ . '/../Models/Repositories/CompteRepository;php';
require_once __DIR__ . '/../Models/Repositories/UserRepository.php';
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/Compte.php';
require_once __DIR__ . '/../Lib/utils.php';

class UserController
{
    private $compteRepository;
    private $userRepository;

    public function __construct()
    {
        // Lors de l’instanciation du contrôleur, je crée les deux repositories
        $this->compteRepository = new CompteRepository();
        $this->userRepository = new UserRepository();
    }

    /**
     * Je vérifie que seul un admin connecté a accès aux méthodes de ce contrôleur
     */
    private function checkAccess()
    {
        if (!isConnected()) {
            header('Location: ?action=auth.login');
            exit();
        }

        if (!isAdmin()) {
            header('Location: ?action=forbidden');
            exit();
        }
    }

    /**
     * Renvoie tous les utilisateurs (version sans vue)
     */
    public function list(): array
    {
        $this->checkAccess();
        return $this->userRepository->getUsers();
    }

    /**
     * Affiche la liste des utilisateurs dans une vue
     */
    public function index()
    {
        $this->checkAccess();
        $users = $this->userRepository->getUsers();
        require_once __DIR__ . '/../View/client-list.php';
    }

    /**
     * Affiche un seul utilisateur avec ses comptes associés
     */
    public function show(int $id)
    {
        $this->checkAccess();
        $user = $this->userRepository->getUser($id);
        $comptes = $this->compteRepository->getComptesByUserId($id);
        require_once __DIR__ . '/../View/view-client.php';
    }

    /**
     * Affiche le formulaire de création d’un utilisateur
     */
    public function create()
    {
        $this->checkAccess();
        require_once __DIR__ . '/../View/create-client.php';
    }

    /**
     * Enregistre un nouvel utilisateur (POST)
     */
    public function store()
    {
        $this->checkAccess();

        $user = new User();
        $user->setNom($_POST['nom']);
        $user->setPrenom($_POST['prenom']);
        $user->setEmail($_POST['email']);
        $user->setTelephone($_POST['telephone']);
        $user->setAdresse($_POST['adresse']);

        $this->userRepository->create($user);

        header('Location: ?action=utilisateur.index');
        exit;
    }

    /**
     * Affiche le formulaire d’édition d’un utilisateur
     */
    public function edit(int $id)
    {
        $this->checkAccess();

        $user = $this->userRepository->getUser($id);

        if (!$user) {
            header('Location: ?action=utilisateur.index');
            exit();
        }

        require_once __DIR__ . '/../View/edit-client.php';
    }

    /**
     * Met à jour les infos d’un utilisateur
     */
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

    /**
     * Supprime un utilisateur
     * Grâce au `ON DELETE CASCADE`, les comptes et contrats associés seront aussi supprimés automatiquement
     */
    public function delete(int $id)
    {
        $this->checkAccess();

        //  Ici, on ne bloque plus la suppression même si l’utilisateur a des comptes
        //  Le message d’avertissement est affiché côté front
        $this->userRepository->delete($id);

        header('Location: ?action=utilisateur.index');
        exit();
    }

    /**
     * Affiche la page 403 si un utilisateur tente un accès interdit
     */
    public function forbidden()
    {
        require_once __DIR__ . '/../View/403.php';
        http_response_code(403);
    }
}
