<?php

require_once __DIR__ . '/../Models/Repositories/CompteRepository;php';
require_once __DIR__ . '/../Models/Repositories/UserRepository.php';
require_once __DIR__ . '/../Models/Compte.php';
require_once __DIR__ . '/../Lib/utils.php';

class CompteController
{
    //  Propriétés pour interagir avec les comptes et les utilisateurs
    private CompteRepository $compteRepository;
    private UserRepository $userRepository;

    public function __construct()
    {
    // Je construis le contrôleur en initialisant les objets CompteRepository et UserRepository
        $this->compteRepository = new CompteRepository();
        $this->userRepository = new UserRepository();
    }

    /**
     *  Fonction de sécurité : redirige si l'utilisateur n'est pas connecté ou non admin
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
     *J'affiche la liste des comptes bancaires
     */
    public function index()
    {
        $this->checkAccess();
        $comptes = $this->compteRepository->getComptes();
        require_once __DIR__ . '/../View/compte-list.php';
    }

    /**
     * J'affiche un seul compte en détail (via l'ID dans l'URL)
     */
    public function show()
    {
        $this->checkAccess();

        if (isset($_GET['id'])) {
            $id_compte = $_GET['id'];
            // ➤ On met le compte dans un tableau car la vue attend une liste
            $comptes = [$this->compteRepository->getCompte($id_compte)];
            require_once __DIR__ . '/../View/view-compte.php';
        } else {
            header('Location: ?action=compte.index');
            exit();
        }
    }

    /**
     * J'affiche le formulaire de création de compte
     */
    public function create()
    {
        $this->checkAccess();
        // Je Récupère les clients pour les proposer dans la liste déroulante
        $clients = $this->userRepository->getUsers();
        require_once __DIR__ . '/../View/create-compte.php';
    }

    /**
     * j'enregistre un nouveau compte (POST)
     */
    public function store()
    {
        $this->checkAccess();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rib = $_POST['rib'];
            $type_compte = $_POST['type_compte'];
            $solde_initial = $_POST['solde_initial'];
            $id_utilisateur = $_POST['id_utilisateur'];

            // ➤ Je crée un objet Compte avec les données du formulaire
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

    /**
     * J'affiche le formulaire pour modifier un compte
     */
    public function edit()
    {
        $this->checkAccess();

        if (isset($_GET['id'])) {
            $id_compte = $_GET['id'];
            $compte = $this->compteRepository->getCompte($id_compte);
            $clients = $this->userRepository->getUsers(); // Pour affichage nom utilisateur
            require_once __DIR__ . '/../View/edit-compte.php';
        } else {
            header('Location: ?action=compte.index');
            exit();
        }
    }

    /**
     * Je met à jour un compte (POST)
     */
    public function update()
    {
        $this->checkAccess();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_compte = $_POST['id_compte'];
            $type_compte = $_POST['type_compte'];
            $solde_initial = $_POST['solde_initial'];

            $compte = $this->compteRepository->getCompte($id_compte);

            //  Si le compte n'existe pas, on redirige
            if (!$compte) {
                header('Location: ?action=compte.index');
                exit();
            }

            //  Mise à jour des données
            $compte->setTypeCompte($type_compte);
            $compte->setSoldeInitial((float)$solde_initial);

            $this->compteRepository->updateC($compte);

            header('Location: ?action=compte.index');
            exit();
        }
    }

    /**
     *  Supprime un compte bancaire via l’ID
     */
    public function delete()
    {
        $this->checkAccess();

        if (isset($_GET['id'])) {
            $id_compte = $_GET['id'];
            $this->compteRepository->deleteC($id_compte);
        }

        header('Location: ?action=compte.index');
        exit();
    }

    /**
     *  Page 403 si accès refusé
     */
    public function forbidden()
    {
        require_once __DIR__ . '/../View/403.php';
        http_response_code(403);
    }
}
