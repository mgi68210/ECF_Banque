<?php
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
        $this->compteRepository = new CompteRepository();
        $this->userRepository = new UserRepository();
    }

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

    public function list(): array
    {
        $this->checkAccess();
        return $this->userRepository->getUsers();
    }

    public function index()
    {
        $this->checkAccess();
        $users = $this->userRepository->getUsers();
        require_once __DIR__ . '/../View/client-list.php';
    }

    public function show(int $id)
    {
        $this->checkAccess();
        $user = $this->userRepository->getUser($id);
        $comptes = $this->compteRepository->getComptesByUserId($id);
        require_once __DIR__ . '/../View/view-client.php';
    }

    public function create()
    {
        $this->checkAccess();
        require_once __DIR__ . '/../View/create-client.php';
    }

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

    public function edit(int $id)
    {
        $this->checkAccess();
        if (!isset($id)) {
            header('Location: ?action=utilisateur.index');
            exit();
        }
        $user = $this->userRepository->getUser($id);
        if (!$user) {
            header('Location: ?action=utilisateur.index');
            exit();
        }
        require_once __DIR__ . '/../View/edit-client.php';
    }

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
        exit();
    }

    public function delete(int $id)
    {
        $this->checkAccess();
        $this->userRepository->delete($id);
        header('Location: ?action=utilisateur.index');
        exit;
    }

    public function forbidden()
    {
        require_once __DIR__ . '/../View/404.php';
        http_response_code(403);
    }
}
