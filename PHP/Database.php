<?php
    require_once 'config.php';

    class Database {
        private $host = DB_HOST;
        private $dbname = DB_NAME;
        private $username = DB_USERNAME;
        private $password = DB_PASSWORD;
        private $conn;

        public function __construct() {
            $this->connect();
        }

        private function connect() {
            try {
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection error: " . $e->getMessage());
            }
        }

        public function getConnection() {
            return $this->conn;
        }
    }
?>
