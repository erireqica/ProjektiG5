<?php
require_once 'Database.php';

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([":email" => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['user'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['user_id'] = $user['id'];
            return $user['role'];
        } else {
            return false;
        }
    }

    public function register($name, $surname, $email, $password) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->db->prepare("INSERT INTO users (name, surname, email, password, role) VALUES (:name, :surname, :email, :password, :role)");
        return $stmt->execute([
            ":name" => $name,
            ":surname" => $surname,
            ":email" => $email,
            ":password" => $hashed_password,
            ":role" => "user"
        ]);
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
    }
}
?>
