<?php

//Pour organiser le code et éviter les conflits de nommage en regroupant ce fichier dans une espace de noms spécifiques
namespace Config;

use PDO;
use PDOException;

//La classe Database est responsable de gérer la connexion à la base de données.
class Database
{
    // Paramètres de connexion à la base de données
    //$host : Contient l'adresse de l'hôte de la base de données, souvent "localhost" pour les environnements de développement locaux.
    private string $host = "localhost";
    //$dbname : Le nom de la base de données (dans cet exemple, "todo_list_api").
    private string $dbname = "todo_list_api";
    //$username : Le nom d'utilisateur nécessaire pour se connecter à la base de données (par exemple, "root" pour un environnement local).
    private string $username = "postgres";
    //$password : Le mot de passe correspondant à l'utilisateur.
    private string $password = "P@ssw0rd";
    //Port par défaut pour PostGresql
    private int $port = 5432;
    //$connection : C'est un attribut de type \PDO (le "?" signifie qu'il peut être soit un objet PDO, soit null). Cet attribut est utilisé pour stocker la connexion à la base de données.
    private ?PDO $connection = null;

    public function getConnection(): PDO
    {
        // Si la connexion n'existe pas encore
        if ($this->connection === null) {
            try {
                // Tentative de connexion à la base
                $dsn = "pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->dbname;
                $this->connection = new PDO($dsn, $this->username, $this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // En cas d'erreur, on lance une exception
                throw new \Exception("Connection error: " . $e->getMessage());
            }
        }
        // Retourne la connexion
        return $this->connection;
    }
}
