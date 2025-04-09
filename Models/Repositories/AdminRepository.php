<?php

require_once __DIR__ . '/../../Lib/Database.php'; // Correction du chemin et du nom de la classe
require_once __DIR__ . '/../Admin.php';

class AdminRepository
{
    public DatabaseConnection $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }

    public function getAdminById(int $id): ?Admin
    {
        $statement = $this->connection->getConnection()->prepare('SELECT * FROM Admin WHERE id_admin = :id_admin');
        $statement->execute(['id_admin' => $id]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return null;
        }
        $admin = new Admin();
        $admin->setIdAdmin($result['id_admin'] ?? null);
        $admin->setNomAdmin($result['nom_admin'] ?? '');
        $admin->setEmail($result['email'] ?? '');
        $passwordFromDb = $result['mot_de_passe'] ?? '';
        $admin->setMotDePasse(mb_convert_encoding($passwordFromDb, 'UTF-8', mb_detect_encoding($passwordFromDb, 'UTF-8, ISO-8859-1', true)));
        return $admin;
    }

    public function getAdminByEmail(string $email): ?Admin
    {
        $statement = $this->connection->getConnection()->prepare('SELECT * FROM Admin WHERE email = :email');
        $statement->execute(['email' => $email]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return null;
        }
        $admin = new Admin();
        $admin->setIdAdmin($result['id_admin'] ?? null);
        $admin->setNomAdmin($result['nom_admin'] ?? '');
        $admin->setEmail($result['email'] ?? '');
        $admin->setMotDePasse($result['mot_de_passe'] ?? '');
        
        return $admin;
    }

}