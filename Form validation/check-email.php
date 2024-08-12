<?php
class EmailRegistration
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "email_registration";
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

    public function checkAndRegisterEmail($email) {
        if ($this->emailExists($email)) {
            return 'exists';
        } else {
            $this->registerEmail($email);
            return 'available';
        }
    }

    private function emailExists($email) {
        $stmt = $this->conn->prepare('SELECT COUNT(*) FROM registered_emails WHERE email = :email');
        $stmt->execute(['email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

    private function registerEmail($email) {
        $stmt = $this->conn->prepare('INSERT INTO registered_emails (email) VALUES (:email)');
        $stmt->execute(['email' => $email]);
    }
}

$emailRegistration = new EmailRegistration();

$email = $_GET['email'] ?? '';

if ($email) {
    echo $emailRegistration->checkAndRegisterEmail($email);
} else {
    echo 'No email provided';
}
