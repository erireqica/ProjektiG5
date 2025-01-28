<?php
require_once 'Database.php';

class TextContent {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getTextContent() {
        $stmt = $this->db->query("SELECT section, content FROM text_content");
        $textContent = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $textContent[$row['section']] = $row['content'];
        }
        
        return $textContent;
    }
}
?>
