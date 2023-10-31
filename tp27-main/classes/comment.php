<?php
class Comment
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createComment($post_id, $content, $author_id)
    {
        $sql = "INSERT INTO comments (post_id, content, author_id, created_at) VALUES ($post_id, '$content', $author_id, NOW())";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute();
        if ($stmt->execute()) {
            return "Todo Ok";
        } else {
            return "Error";
        }
    }

    public function getCommentsForPost($post_id)
    {
        $sql = "SELECT * FROM comments WHERE post_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$post_id]);

        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $arrResponse = [];

        for ($i = 0; $i < count($arr); $i++) {
            $arrResponse[$i]['id'] = $arr[$i]['id'];
            $arrResponse[$i]['post_id'] = $arr[$i]['post_id'];
            $arrResponse[$i]['content'] = $arr[$i]['content'];
            $arrResponse[$i]['created_id'] = $arr[$i]['created_id'];

            $idPublicacion = $arr[$i]['author_id'];
            $pdo = $this->db->prepare("SELECT username FROM users WHERE id='$idPublicacion'");
            $pdo->execute();
            $arrUser = $pdo->fetchAll(PDO::FETCH_ASSOC);
            $arrResponse[$i]['author_id'] = $arrUser[0]['username'];
        }

        return $arrResponse;
    }
}
