
<?php
include_once '../config.php';


class commentC
{
    private $db;

    public function __construct()
    {
        $this->db = config::getConnexion();
    }

    public function listComment()
    {
        $sql = "SELECT * FROM comment";
        try {
            $liste = $this->db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function addComment($postId, $author, $content)
    {
        $sql = "INSERT INTO comment (post_id, auteur, contenu_comment) VALUES (:post_id, :auteur, :contenu_comment)";
        try {
            $query = $this->db->prepare($sql);
            $query->execute([
                'post_id' => $postId,
                'auteur' => $author,
                'contenu_comment' => $content
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deleteComment($id)
    {
        $sql = "DELETE FROM comment WHERE id = :id";
        try {
            $query = $this->db->prepare($sql);
            $query->execute([
                'id' => $id
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    function showcomment($id)
    {
        $sql = "SELECT * from comment where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $comment = $query->fetch();
            return $comment;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
   
    public function listcom() {
        $sql = "SELECT comment.*,post.* FROM comment INNER JOIN post ON comment.post_id = post.id";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:'. $e->getMessage());
        }
    }

    // getCommentsByPostId
    public function getCommentsByPostId($post_id)
    {
        $sql = "SELECT * FROM comment WHERE post_id = $post_id";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:'. $e->getMessage());
        }
    }
}
