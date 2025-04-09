<?php

require_once __DIR__ . '/../Lib/Database.php';

class UserModel
{
    private DatabaseConnection $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }

    // Authentifier un utilisateur par email et mot de passe
// Dans UserModel.php
public function authenticate(string $email, string $password): ?User
{
    $conn = $this->connection->getConnection();
    $statement = $conn->prepare("SELECT * FROM utilisateur WHERE email = :email LIMIT 1");
    $statement->execute(['email' => $email]);

    $userData = $statement->fetch();

    if ($userData && password_verify($password, $userData['password'])) {
        $user = new User();
        $user->setId($userData['id_utilisateur']);
        $user->setNom($userData['nom']);
        $user->setPrenom($userData['prenom']);
        $user->setEmail($userData['email']);
        $user->setTelephone($userData['telephone']);
        $user->setAdresse($userData['adresse']);
        $user->setRole($userData['role']); 

        return $user;
    }

    return null;  // Retourne null si les identifiants sont incorrects
}

}
