<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
include_once '../config.php';
include '../model/post.php';

class postC
{
    public function listpost()
    {
        $sql = "SELECT * FROM post";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
        public function postExists($postId) {
        $sql = "SELECT count(*) FROM post WHERE id = :postId";
        $query = $this->db->prepare($sql);
        $query->execute(['postId' => $postId]);
        return $query->fetchColumn() > 0;

    }


    function deletepost($id)
    {
        $sql = "DELETE FROM post WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function add($post)
    {
        $sql = "INSERT INTO post 
        VALUES (NULL, :auteur, :titre,:contenu)";  
        $db = config::getConnexion(); 
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'auteur' => $post->getauteur(),
                'titre' => $post->gettitre(),
                'contenu' => $post->getcontenu()
                ]);
                $userEmails = $db->query("SELECT email FROM user")->fetchAll(PDO::FETCH_COLUMN);

                foreach ($userEmails as $email) {
                    $mail = new PHPMailer(true);

                    try {
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'choeurproject@gmail.com';
                        $mail->Password = 'oabw kzbc bghm mgeb';
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;
                        $mail->setFrom('choeurproject@gmail.com', 'Mailer');
                        $mail->addAddress($email);
                        $mail->isHTML(true);
                        $mail->Subject = 'New Post added';
                        $mail->Body = 'A new Post has been added. Check it out!';

                        $mail->send();
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }

        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

function updatepost($id, $auteur, $titre, $contenu) {
    $sql = "UPDATE post SET auteur = :auteur, titre = :titre, contenu = :contenu WHERE id = :id";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'id' => $id,
            'auteur' => $auteur,
            'titre' => $titre,
            'contenu' => $contenu
        ]);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

    function showpost($id)
    {
        $sql = "SELECT * from post where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $post = $query->fetch();
            return $post;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    public function listpostByAuthor()
    {
        $sql = "SELECT * FROM post ORDER BY auteur ASC";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    
    public function listpostByPopularity()
    {
        // Assuming you have a 'comment' table with a 'post_id' column
        $sql = "SELECT post.*, COUNT(comment.id) as comment_count 
                FROM post 
                LEFT JOIN comment ON post.id = comment.post_id 
                GROUP BY post.id 
                ORDER BY comment_count DESC";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    
    // get post by id
    public function getPostById($id)
    {
        $sql = "SELECT * FROM post WHERE id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $post = $query->fetch();
            return $post;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

}
