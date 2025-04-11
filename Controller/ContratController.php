<?php

// J'importe les classes nécessaires au fonctionnement du controller
require_once __DIR__ . '/../Models/Repositories/ContratRepository.php';
require_once __DIR__ . '/../Models/Repositories/UserRepository.php';
require_once __DIR__ . '/../Models/Contrat.php';
require_once __DIR__ . '/../Lib/utils.php';

class ContratController
{
    private ContratRepository $contratRepository;
    private UserRepository $userRepository;

    public function __construct()
    {
        // Je construis le contrôleur en initialisant les objets ContratRepository et UserRepository
        $this->contratRepository = new ContratRepository();
        $this->userRepository = new UserRepository();
    }

    /**
     * Je vérifie que l’utilisateur est bien connecté et admin.
     * Sinon : redirection vers login ou page interdite
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
     * J'affiche la liste des contrats
     */
    public function index()
    {
        $this->checkAccess(); // ➤ Vérification admin
        $contrats = $this->contratRepository->getContrats(); // ➤ Je récupère tous les contrats
        require_once __DIR__ . '/../View/contrat-list.php'; // ➤ Je charge la vue
    }

    /**
     * J'affiche le formulaire de création d’un contrat
     */
    public function create()
    {
        $this->checkAccess();
        $clients = $this->userRepository->getUsers(); // ➤ Liste des utilisateurs à afficher dans le <select>
        require_once __DIR__ . '/../View/create-contrat.php';
    }

    /**
     * Je traite l’enregistrement d’un nouveau contrat
     */
    public function store()
    {
        $this->checkAccess();

        //  Si on a bien un formulaire > POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contrat = new Contrat();
            $contrat->setTypeContrat($_POST['type_contrat']);
            $contrat->setMontant(floatval($_POST['montant']));
            $contrat->setDuree(intval($_POST['duree']));
            $contrat->setIdUtilisateur(intval($_POST['id_utilisateur']));

            // J’enregistre le contrat dans la base
            $this->contratRepository->createC($contrat);

            // Puis je redirige
            header('Location: ?action=contrat.index');
            exit();
        }
    }

    /**
     * J'affiche le formulaire de modification d’un contrat
     */
    public function edit()
    {
        $this->checkAccess();

        //  Si on a bien passé un ID en GET
        if (isset($_GET['id'])) {
            $contrat = $this->contratRepository->getContrat((int)$_GET['id']);

            // Je récupère le client associé au contrat pour l’afficher
            $client = $this->userRepository->getUser($contrat->getIdUtilisateur());
            $contrat->client_nom = $client->getNom();
            $contrat->client_prenom = $client->getPrenom();

            require_once __DIR__ . '/../View/edit-contrat.php';
        } else {
            header('Location: ?action=contrat.index');
            exit();
        }
    }

    /**
     * Pour mettre à jour les informations d’un contrat existant
     */
    public function update()
    {
        $this->checkAccess();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contrat = $this->contratRepository->getContrat(intval($_POST['id']));

            if ($contrat) {
                $contrat->setMontant(floatval($_POST['montant']));
                $contrat->setDuree(intval($_POST['duree']));
                $this->contratRepository->updateC($contrat);
            }

            header('Location: ?action=contrat.index');
            exit();
        }
    }

    /**
     * Pour supprimer un contrat via son ID
     */
    public function delete()
    {
        $this->checkAccess();

        if (isset($_GET['id'])) {
            $this->contratRepository->deleteC((int)$_GET['id']);
            header('Location: ?action=contrat.index');
            exit();
        }
    }

    /**
     * Pour afficher un contrat en détail (view-contrat)
     */
    public function show()
    {
        $this->checkAccess();

        if (isset($_GET['id'])) {
            $contrat = $this->contratRepository->getContrat((int)$_GET['id']);

            if ($contrat) {
                $client = $this->userRepository->getUser($contrat->getIdUtilisateur());
                require_once __DIR__ . '/../View/view-contrat.php';
                return;
            }
        }

        // Redirection si contrat introuvable
        header('Location: ?action=contrat.index');
        exit();
    }
}
