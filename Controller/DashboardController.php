<?php
require_once __DIR__ . '/../Models/Repositories/UserRepository.php';
require_once __DIR__ . '/../Models/Repositories/CompteRepository;php';
require_once __DIR__ . '/../Lib/utils.php';


class DashboardController
{
    private UserRepository $userRepository;
    private CompteRepository $compteRepository;
    // private ?ContratRepository $contratRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->compteRepository = new CompteRepository();
        
        // Facultatif si tu n’as pas encore la gestion des contrats
        if (class_exists('ContratRepository')) {
            $this->contratRepository = new ContratRepository();
        } else {
            $this->contratRepository = null;
        }
    }

    public function index()
    {
        $nombreClients = count($this->userRepository->getUsers());
        $nombreComptes = count($this->compteRepository->getComptes());
        // $nombreContrats = $this->contratRepository ? count($this->contratRepository->getAll()) : 0;

        $clients = $this->userRepository->getUsers();
        $comptes = $this->compteRepository->getComptes();

        require_once __DIR__ . '/../View/dashboard.php';
    }
}
