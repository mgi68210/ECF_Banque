<?php
require_once __DIR__ . '/../Models/Repositories/UserRepository.php';
require_once __DIR__ . '/../Models/Repositories/CompteRepository.php';
require_once __DIR__ . '/../Models/Repositories/ContratRepository.php';
require_once __DIR__ . '/../Lib/utils.php';

class DashboardController
{
    private UserRepository $userRepository;
    private CompteRepository $compteRepository;
    private ContratRepository $contratRepository;

    public function __construct()
    {
        // Je construis le contrôleur en initialisant les objets CompteRepository, UserRepository et ContratRepository
        $this->userRepository = new UserRepository();
        $this->compteRepository = new CompteRepository();
        $this->contratRepository = new ContratRepository();
    }

    public function index()
    {
        // Récupère les données à afficher sur le tableau de bord
        $clients = $this->userRepository->getUsers();
        $comptes = $this->compteRepository->getComptes();
        $contrats = $this->contratRepository->getContrats();

        // Calcul des statistiques globales
        $nombreClients = count($clients);
        $nombreComptes = count($comptes);
        $nombreContrats = count($contrats);

        // Affichage de la vue
        require_once __DIR__ . '/../View/dashboard.php';
    }
}
