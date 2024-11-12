<?php

// namespace Models;

// class ListModel
// {
//     // On stocke la connexion à la base de données
//     private \PDO $db;
//     // Nom de la table qu'on va utiliser
//     private string $table = "lists";

//     // Quand on crée un nouveau ListModel, on se connecte à la base
//     public function __construct()
//     {
//         $database = new \Config\Database();
//         $this->db = $database->getConnection();
//     }

//     // Récupère toutes les listes, classées par date de création
//     public function findAll(): array
//     {
//         $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
//         $stmt = $this->db->query($query);
//         return $stmt->fetchAll();
//     }

//     // Trouve une liste par son ID
//     // Le ? devant array veut dire qu'on peut retourner un tableau ou null
//     public function findById(int $id): ?array
//     {
//         $query = "SELECT * FROM {$this->table} WHERE id = :id";
//         $stmt = $this->db->prepare($query);
//         $stmt->execute(['id' => $id]);
//         $result = $stmt->fetch();
//         return $result ?: null;
//     }

//     // Crée une nouvelle liste et retourne son ID
//     public function create(string $title, ?string $description = null): int
//     {
//         $query = "INSERT INTO {$this->table} (title, description) VALUES (:title, :description)";
//         $stmt = $this->db->prepare($query);
//         // On nettoie les données avant de les enregistrer
//         $stmt->execute([
//             'title' => htmlspecialchars($title),
//             'description' => $description ? htmlspecialchars($description) : null
//         ]);
//         return (int)$this->db->lastInsertId();
//     }
// }


namespace Models;

require_once '../src/Models/AbstractModel.php';

class ListModel extends AbstractModel
{
    protected string $table = "lists";

    // On garde uniquement les méthodes spécifiques aux listes
    public function create(string $title, ?string $description = null): int
    {
        $query = "INSERT INTO {$this->table} (title, description) VALUES (:title, :description)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'title' => $this->sanitize($title),
            'description' => $description ? $this->sanitize($description) : null
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function findAll(): array
    {
        $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        return $this->db->query($query)->fetchAll();
    }
}
