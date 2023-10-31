<?php
class Post {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createPost($title, $content, $author_id) {
        $sql = "INSERT INTO posts (title, content, author_id, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$title, $content, $author_id]);
    }

    public function getPostById($post_id) {
        $sql = "SELECT * FROM posts WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$post_id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePost($post_id, $title, $content) {
        $sql = "UPDATE posts SET title = ?, content = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$title, $content, $post_id]);
    }

    public function deletePost($post_id) {
        $sql = "DELETE FROM posts WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$post_id]);
    }

    public function getPosts() {
        $sql = "SELECT * FROM posts ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
