<?php

// J'inclus la classe User et la classe de connexion à la base
require_once __DIR__ . '/../User.php';
require_once __DIR__ . '/../../Lib/Database.php';

class UserRepository
{
    private DatabaseConnection $connection;

    //  Quand j'appelle new UserRepository(), je prépare la connexion
    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }

    // Je récupère tous les utilisateurs de la base de données
    public function getUsers(): array
    {
        $conn = $this->connection->getConnection();
        $statement = $conn->prepare("SELECT * FROM utilisateur");
        $statement->execute();

        $users = [];

        //  Pour chaque utilisateur récupéré, je crée un objet User
        foreach ($statement->fetchAll() as $row) {
            $user = new User();
            $user->setId($row['id_utilisateur']);
            $user->setNom($row['nom']);
            $user->setPrenom($row['prenom']);
            $user->setEmail($row['email']);
            $user->setTelephone($row['telephone']);
            $user->setAdresse($row['adresse']);

            // Je vérifie s'il a un ou plusieurs comptes
            $hasCompteStmt = $conn->prepare("SELECT COUNT(*) FROM compte_bancaire WHERE id_utilisateur = ?");
            $hasCompteStmt->execute([$user->getId()]);
            $user->hasCompte = $hasCompteStmt->fetchColumn() > 0;

            $users[] = $user;
        }

        return $users;
    }

    //  Je récupère un seul utilisateur par son ID
    public function getUser(int $id): ?User
    {
        $conn = $this->connection->getConnection();
        $statement = $conn->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = :id");
        $statement->execute(['id' => $id]);
        $row = $statement->fetch();

        //  Si aucun résultat trouvé, je retourne null
        if (!$row) return null;

        $user = new User();
        $user->setId($row['id_utilisateur']);
        $user->setNom($row['nom']);
        $user->setPrenom($row['prenom']);
        $user->setEmail($row['email']);
        $user->setTelephone($row['telephone']);
        $user->setAdresse($row['adresse']);

        return $user;
    }

    // Je crée un nouvel utilisateur dans la base
    public function create(User $user): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO utilisateur (nom, prenom, email, telephone, adresse) 
             VALUES (:nom, :prenom, :email, :telephone, :adresse)"
        );

        return $statement->execute([
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'email' => $user->getEmail(),
            'telephone' => $user->getTelephone(),
            'adresse' => $user->getAdresse()
        ]);
    }

    //  Je mets à jour un utilisateur existant
    public function update(User $user): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE utilisateur 
             SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone, adresse = :adresse 
             WHERE id_utilisateur = :id"
        );

        return $statement->execute([
            'id' => $user->getId(),
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'email' => $user->getEmail(),
            'telephone' => $user->getTelephone(),
            'adresse' => $user->getAdresse()
        ]);
    }

    //  Je supprime un utilisateur de la base
    public function delete(int $id): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            "DELETE FROM utilisateur WHERE id_utilisateur = :id"
        );
        return $statement->execute(['id' => $id]);
    }

    //  Je récupère un utilisateur par son email (utile pour login)
    public function getUserByEmail(string $email): ?User
    {
        $conn = $this->connection->getConnection();
        $statement = $conn->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $statement->execute(['email' => $email]);

        $row = $statement->fetch();

        //  Si je ne trouve personne, je retourne null
        if (!$row) return null;

        $user = new User();
        $user->setId($row['id_utilisateur']);
        $user->setNom($row['nom']);
        $user->setPrenom($row['prenom']);
        $user->setEmail($row['email']);
        $user->setTelephone($row['telephone']);
        $user->setAdresse($row['adresse']);

        //  Je vérifie s'il y a un mot de passe dans la BDD
        $user->setPassword($row['password'] ?? '');

        return $user;
    }
}
