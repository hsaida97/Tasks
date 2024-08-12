<?php
class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "mydatabase";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getTotalCount($table)
    {
        $sql = "SELECT COUNT(*) FROM $table";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function all($table, $limit = null, $offset = null)
    {
        $limit = $limit ?? (isset($_GET['limit']) ? (int) $_GET['limit'] : 6);
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = $offset ?? ($page - 1) * $limit;

        $sql = "SELECT * FROM $table LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $totalItems = $this->getTotalCount($table);
        $totalPages = ceil($totalItems / $limit);

        return [
            'data' => $data,
            'totalItems' => $totalItems,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'limit' => $limit
        ];
    }

    public function closeConnection()
    {
        $this->conn = null;
    }
}

$db = new Database();
$data = $db->all('items', 5);
