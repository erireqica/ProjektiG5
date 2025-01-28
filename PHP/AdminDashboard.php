<?php
    require_once 'Database.php';

class AdminDashboard {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUsers() {
        $stmt = $this->db->query("SELECT id, name, email, role FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteUser($user_id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $user_id);
        return $stmt->execute();
    }   

    public function updateUserRole($user_id, $role) {
        $stmt = $this->db->prepare("UPDATE users SET role = :role WHERE id = :id");
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':id', $user_id);
        return $stmt->execute();
    }
}
?>
