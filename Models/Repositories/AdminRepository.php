<?php

require_once __DIR__ . '/../../Lib/Database.php'; 
require_once __DIR__ . '/../Admin.php';         

class AdminRepository
{
    // Je déclare ma propriété qui me permettra d’accéder à la base de données
    public DatabaseConnection $connection;

    // Dans le constructeur, j’instancie la connexion à la base
    public function __construct()
    {
        // À chaque fois que je crée un AdminRepository, je crée automatiquement une connexion
        $this->connection = new DatabaseConnection();
    }

    // Cette méthode me permet de récupérer un administrateur à partir de son ID
     
    public function getAdminById(int $id): ?Admin
    {
        // Je prépare ma requête SQL avec un paramètre nommé
        $statement = $this->connection->getConnection()->prepare(
            'SELECT * FROM Admin WHERE id_admin = :id_admin'
        );

        // J'exécute la requête en passant l’ID à rechercher
        $statement->execute(['id_admin' => $id]);

        // Je récupère le résultat sous forme de tableau associatif
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // Si je ne trouve rien, je retourne null
        if (!$result) {
            return null;
        }

        // Sinon, je crée un objet Admin avec les données reçues
        $admin = new Admin();
        $admin->setIdAdmin($result['id_admin'] ?? null); 
        $admin->setNomAdmin($result['nom_admin'] ?? ''); 
        $admin->setEmail($result['email'] ?? '');        

        // Je prends soin d’encoder le mot de passe correctement si besoin
        $passwordFromDb = $result['mot_de_passe'] ?? '';
        $admin->setMotDePasse(
            mb_convert_encoding($passwordFromDb, 'UTF-8', mb_detect_encoding($passwordFromDb, 'UTF-8, ISO-8859-1', true))
        );

        // Je retourne l’objet admin rempli
        return $admin;
    }

    
    //  Cette méthode me permet de trouver un administrateur à partir de son email

    public function getAdminByEmail(string $email): ?Admin
    {
        // Je prépare la requête SQL
        $statement = $this->connection->getConnection()->prepare(
            'SELECT * FROM Admin WHERE email = :email'
        );

        // J'exécute la requête avec l’adresse email à rechercher
        $statement->execute(['email' => $email]);

        // Je récupère le résultat
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // Si je ne trouve pas de résultat, je retourne null
        if (!$result) {
            return null;
        }

        // Sinon, je crée un objet Admin et je le remplis
        $admin = new Admin();
        $admin->setIdAdmin($result['id_admin'] ?? null);
        $admin->setNomAdmin($result['nom_admin'] ?? '');
        $admin->setEmail($result['email'] ?? '');
        $admin->setMotDePasse($result['mot_de_passe'] ?? '');

        // Je retourne l’objet admin prêt à être utilisé
        return $admin;
    }
}
