<?php 

/**
 * Cette classe me permet de gérer ma connexion à la base de données MySQL en utilisant PDO.
 * Elle est conçue pour n'établir la connexion qu'une seule fois, et la réutiliser ensuite.
 */
class DatabaseConnection {

    // Je crée une propriété privée qui contiendra l'objet PDO.
    // Je l'initialise à null, ce qui signifie qu'aucune connexion n'est encore ouverte.
    private ?\PDO $database = null;

    /**
     * Cette méthode me retourne une instance PDO pour interagir avec ma base de données.
     * Si elle n'existe pas encore, je la crée à l'aide des paramètres définis.
     */
    public function getConnection(): PDO
    {
        // Je vérifie si la connexion n'est pas déjà existante
        if ($this->database == null) {

            // Je configure les informations de connexion à la base de données
            $host = 'localhost';         // Adresse du serveur de base de données (souvent localhost en local)
            $dbname = 'banque';          // Nom de ma base de données
            $username = 'root';          // Nom d'utilisateur MySQL (par défaut root)
            $password = '';              // Mot de passe MySQL (souvent vide sur les environnements locaux comme XAMPP)
            $charset = 'utf8mb4';        // Encodage à utiliser (permet de gérer les accents et caractères spéciaux)

            // Je construis la chaîne DSN (Data Source Name) utilisée par PDO
            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

            // Je définis les options PDO pour mieux gérer les erreurs et les résultats
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,       // Lève une exception en cas d'erreur SQL
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC   // Retourne les résultats sous forme de tableaux associatifs
            ];

            // J'essaie d'établir la connexion
            try {
                $this->database = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                // En cas d'échec, j'arrête le script et j'affiche un message d'erreur
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }

        // Je retourne la connexion PDO active
        return $this->database;
    }
}
