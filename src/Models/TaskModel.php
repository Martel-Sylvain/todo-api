<?php

// namespace Models;

// class TaskModel
// {
//     // Même chose que pour ListModel
//     private \PDO $db;
//     private string $table = "tasks";

//     public function __construct()
//     {
//         $database = new \Config\Database();
//         $this->db = $database->getConnection();
//     }

//     // Trouve toutes les tâches d'une liste
//     public function findByListId(int $listId): array
//     {
//         $query = "SELECT * FROM {$this->table} WHERE list_id = :list_id";
//         $stmt = $this->db->prepare($query);
//         $stmt->execute(['list_id' => $listId]);
//         return $stmt->fetchAll();
//     }

//     // Crée une nouvelle tâche dans une liste
//     public function create(int $listId, string $title, ?string $description = null): int
//     {
//         $query = "INSERT INTO {$this->table} (list_id, title, description) VALUES (:list_id, :title, :description)";
//         $stmt = $this->db->prepare($query);
//         $stmt->execute([
//             'list_id' => $listId,
//             'title' => htmlspecialchars($title),
//             'description' => $description ? htmlspecialchars($description) : null
//         ]);
//         return (int)$this->db->lastInsertId();
//     }

//     // Change l'état d'une tâche (terminée ou non)
//     public function setDone(int $id, bool $isDone): bool
//     {
//         $query = "UPDATE {$this->table} SET is_done = :is_done WHERE id = :id";
//         $stmt = $this->db->prepare($query);
//         return $stmt->execute([
//             'id' => $id,
//             'is_done' => $isDone
//         ]);
//     }
// }


namespace Models;

require_once '../src/Models/AbstractModel.php';

class TaskModel extends AbstractModel
{
    protected string $table = "tasks";

    // On garde uniquement les méthodes spécifiques aux tâches
    public function create(int $listId, string $title, ?string $description = null): int
    {
        $query = "INSERT INTO {$this->table} (list_id, title, description) VALUES (:list_id, :title, :description)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'list_id' => $listId,
            'title' => $this->sanitize($title),
            'description' => $description ? $this->sanitize($description) : null
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function findByListId(int $listId): array
    {
        $query = "SELECT * FROM {$this->table} WHERE list_id = :list_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['list_id' => $listId]);
        return $stmt->fetchAll();
    }
}
