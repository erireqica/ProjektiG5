<?php
require_once 'Database.php';

class Review {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addReview($user_id, $username, $review, $rating, $imagePath = null) {
        $stmt = $this->db->prepare("INSERT INTO reviews (user_id, username, review_text, rating, image_path) VALUES (:user_id, :username, :review, :rating, :image_path)");
        return $stmt->execute([
            ':user_id' => $user_id,
            ':username' => $username,
            ':review' => $review,
            ':rating' => $rating,
            ':image_path' => $imagePath,
        ]);
    }

    public function deleteReview($review_id) {
        $stmt = $this->db->prepare("DELETE FROM reviews WHERE id = :id");
        return $stmt->execute([':id' => $review_id]);
    }

    public function getAllReviews() {
        $stmt = $this->db->prepare("SELECT * FROM reviews ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
