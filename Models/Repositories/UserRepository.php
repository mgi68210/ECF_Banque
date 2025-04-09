<?php

require_once __DIR__ . '/../User.php';
require_once __DIR__ . '/../../Lib/Database.php';


class UserRepository
{
    public DatabaseConnection $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }

    public function getUsers(): array
    {
        $statement = $this->connection->getConnection()->prepare("SELECT * FROM utilisateur");
        $statement->execute();

        $users = [];
        foreach ($statement as $row) {
            $user = new User();
            $user->setId($row['id_utilisateur']);
            $user->setNom($row['nom']);
            $user->setPrenom($row['prenom']);
            $user->setEmail($row['email']);
            $user->setTelephone((string)$row['telephone']);
            $user->setAdresse($row['adresse']);
            $user->setRole($row['role'] ?? 'user');
            $user->setPassword($row['password'] ?? null);
            $users[] = $user;
        }

        return $users;
    }

    public function getUser(int $id): ?User
    {
        $statement = $this->connection->getConnection()->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = :id");
        $statement->execute(['id' => $id]);
        $result = $statement->fetch();

        if (!$result) {
            return null;
        }

        $user = new User();
        $user->setId($result['id_utilisateur']);
        $user->setNom($result['nom']);
        $user->setPrenom($result['prenom']);
        $user->setEmail($result['email']);
        $user->setTelephone((string)$result['telephone']);
        $user->setAdresse($result['adresse']);
        $user->setRole($result['role'] ?? 'user');
        $user->setPassword($result['password'] ?? null);

        return $user;
    }

    public function getUserByEmail(string $email): ?User
    {
        $statement = $this->connection->getConnection()->prepare("SELECT * FROM utilisateur WHERE email = :email LIMIT 1");
        $statement->execute(['email' => $email]);

        $result = $statement->fetch();
        if (!$result) {
            return null;
        }

        $user = new User();
        $user->setId($result['id_utilisateur']);
        $user->setNom($result['nom']);
        $user->setPrenom($result['prenom']);
        $user->setEmail($result['email']);
        $user->setTelephone((string)$result['telephone']);
        $user->setAdresse($result['adresse']);
        $user->setRole($result['role'] ?? 'user');
        $user->setPassword($result['password'] ?? null);

        return $user;
    }

    public function create(User $user): bool
    {
        $statement = $this->connection
            ->getConnection()
            ->prepare('INSERT INTO utilisateur (nom, prenom, email, telephone, adresse) VALUES (:nom, :prenom, :email, :telephone, :adresse)');

        return $statement->execute([
            'nom'       => $user->getNom(),
            'prenom'    => $user->getPrenom(),
            'email'     => $user->getEmail(),
            'telephone' => $user->getTelephone(),
            'adresse'   => $user->getAdresse()
        ]);
    }

    public function update(User $user): bool
    {
        $statement = $this->connection
            ->getConnection()
            ->prepare('UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone, adresse = :adresse WHERE id_utilisateur = :id');

        return $statement->execute([
            'id'        => $user->getId(),
            'nom'       => $user->getNom(),
            'prenom'    => $user->getPrenom(),
            'email'     => $user->getEmail(),
            'telephone' => $user->getTelephone(),
            'adresse'   => $user->getAdresse()
        ]);
    }

    public function delete(int $id): bool
    {
        $statement = $this->connection
            ->getConnection()
            ->prepare('DELETE FROM utilisateur WHERE id_utilisateur = :id');
        $statement->bindParam(':id', $id);

        return $statement->execute();
    }
}
