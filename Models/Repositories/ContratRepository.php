<?php

// J'importe la classe Contrat (modèle) et la connexion à la base
require_once __DIR__ . '/../Contrat.php';
require_once __DIR__ . '/../../Lib/Database.php';

class ContratRepository
{
    private DatabaseConnection $connection;

    public function __construct()
    {
        // Dès qu'on instancie le repository, je connecte à la BDD
        $this->connection = new DatabaseConnection();
    }

    /**
     * Je récupère tous les contrats de la base avec les noms/prénoms des clients
     */
    public function getContrats(): array
    {
        $stmt = $this->connection->getConnection()->prepare("
            SELECT c.*, u.nom AS client_nom, u.prenom AS client_prenom
            FROM contrat c
            JOIN Utilisateur u ON c.id_utilisateur = u.id_utilisateur
        ");
        $stmt->execute();

        $contrats = [];

        // Pour chaque ligne de résultat, je crée un objet Contrat
        foreach ($stmt as $row) {
            $contrat = new Contrat();
            $contrat->setIdContrat($row['id_contrat']);
            $contrat->setTypeContrat($row['type_contrat']);
            $contrat->setMontant($row['montant_du_contrat']);
            $contrat->setDuree($row['Duree_du_contrat']);
            $contrat->setIdUtilisateur($row['id_utilisateur']);

            // Je stocke aussi les infos du client directement
            $contrat->client_nom = $row['client_nom'];
            $contrat->client_prenom = $row['client_prenom'];

            $contrats[] = $contrat;
        }

        return $contrats;
    }

    /**
     * Je récupère un seul contrat via son ID
     */
    public function getContrat(int $id): ?Contrat
    {
        $stmt = $this->connection->getConnection()->prepare("SELECT * FROM contrat WHERE id_contrat = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        // Si aucun contrat trouvé, je retourne null
        if (!$row) return null;

        $contrat = new Contrat();
        $contrat->setIdContrat($row['id_contrat']);
        $contrat->setTypeContrat($row['type_contrat']);
        $contrat->setMontant($row['montant_du_contrat']);
        $contrat->setDuree($row['Duree_du_contrat']);
        $contrat->setIdUtilisateur($row['id_utilisateur']);

        return $contrat;
    }

    /**
     * J'enregistre un nouveau contrat dans la base
     */
    public function createC(Contrat $contrat): bool
    {
        $stmt = $this->connection->getConnection()->prepare("
            INSERT INTO contrat (type_contrat, montant_du_contrat, Duree_du_contrat, id_utilisateur)
            VALUES (:type, :montant, :duree, :user)
        ");

        // Je remplis la requête avec les valeurs de l’objet Contrat
        return $stmt->execute([
            'type' => $contrat->getTypeContrat(),
            'montant' => $contrat->getMontant(),
            'duree' => $contrat->getDuree(),
            'user' => $contrat->getIdUtilisateur()
        ]);
    }

    /**
     * Cela Met à jour les infos d’un contrat existant
     */
    public function updateC(Contrat $contrat): bool
    {
        $stmt = $this->connection->getConnection()->prepare("
            UPDATE contrat
            SET montant_du_contrat = :montant, Duree_du_contrat = :duree
            WHERE id_contrat = :id
        ");

        return $stmt->execute([
            'montant' => $contrat->getMontant(),
            'duree' => $contrat->getDuree(),
            'id' => $contrat->getIdContrat()
        ]);
    }

    /**
     * Pour Supprimer un contrat via son ID
     */
    public function deleteC(int $id): bool
    {
        $stmt = $this->connection->getConnection()->prepare("DELETE FROM contrat WHERE id_contrat = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Pour Vérifier si un utilisateur a au moins un contrat
     */
    public function userHasContrat(int $id_utilisateur): bool
    {
        $stmt = $this->connection->getConnection()->prepare("SELECT COUNT(*) FROM contrat WHERE id_utilisateur = :id");
        $stmt->execute(['id' => $id_utilisateur]);

        // Je retourne vrai si au moins 1 contrat trouvé
        return $stmt->fetchColumn() > 0;
    }
}
