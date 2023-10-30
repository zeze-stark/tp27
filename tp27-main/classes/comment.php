<?php
class Comment {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createComment($post_id, $content, $author_id) {
        $sql = "INSERT INTO comments (post_id, content, author_id, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$post_id, $content, $author_id]);
    }

    public function getCommentsForPost($post_id) {
        $sql = "SELECT * FROM comments WHERE post_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$post_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
