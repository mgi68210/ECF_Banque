<?php

require_once __DIR__ . '/../Models/Repositories/CompteRepository;php';
require_once __DIR__ . '/../Models/Repositories/UserRepository.php';
require_once __DIR__ . '/../Models/Compte.php';
require_once __DIR__ . '/../Lib/utils.php';


class CompteController
{
    private CompteRepository $compteRepository;
    private UserRepository $userRepository;

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

    public function index()
    {
        $this->checkAccess();
        $comptes = $this->compteRepository->getComptes();
        require_once __DIR__ . '/../View/compte-list.php';
    }

    public function show()
    {
        $this->checkAccess();
        if (isset($_GET['id'])) {
            $id_compte = $_GET['id'];
            $comptes = [$this->compteRepository->getCompte($id_compte)];
            require_once __DIR__ . '/../View/view-compte.php';
        } else {
            header('Location: ?action=compte.index');
            exit();
        }
    }

    public function create()
    {
        $this->checkAccess();
        $clients = $this->userRepository->getUsers();
        require_once __DIR__ . '/../View/create-compte.php';
    }

    public function store()
    {
        $this->checkAccess();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rib = $_POST['rib'];
            $type_compte = $_POST['type_compte'];
            $solde_initial = $_POST['solde_initial'];
            $id_utilisateur = $_POST['id_utilisateur'];

            $compte = new Compte();
            $compte->setRib($rib);
            $compte->setTypeCompte($type_compte);
            $compte->setSoldeInitial($solde_initial);
            $compte->setIdUtilisateur($id_utilisateur);

            $this->compteRepository->createC($compte);

            header('Location: ?action=compte.index');
            exit();
        }
    }

    public function edit()
    {
        $this->checkAccess();
        if (isset($_GET['id'])) {
            $id_compte = $_GET['id'];
            $compte = $this->compteRepository->getCompte($id_compte);
            $clients = $this->userRepository->getUsers();
            require_once __DIR__ . '/../View/edit-compte.php';
        } else {
            header('Location: ?action=compte.index');
            exit();
        }
    }

    public function update()
    {
        $this->checkAccess();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_compte = $_POST['id_compte'];
            $rib = $_POST['rib'];
            $type_compte = $_POST['type_compte'];
            $solde_initial = $_POST['solde_initial'];
            $id_utilisateur = $_POST['id_utilisateur'];

            $compte = new Compte();
            $compte->setIdCompte($id_compte);
            $compte->setRib($rib);
            $compte->setTypeCompte($type_compte);
            $compte->setSoldeInitial($solde_initial);
            $compte->setIdUtilisateur((int)$id_utilisateur);

            $this->compteRepository->updateC($compte);

            header('Location: ?action=compte.index');
            exit();
        }
    }

    public function delete()
    {
        $this->checkAccess();
        if (isset($_GET['id'])) {
            $id_compte = $_GET['id'];
            $this->compteRepository->deleteC($id_compte);
            header('Location: ?action=compte.index');
            exit();
        } else {
            header('Location: ?action=compte.index');
            exit();
        }
    }

    public function forbidden()
    {
        require_once __DIR__ . '/../View/403.php';
        http_response_code(403);
    }
}
