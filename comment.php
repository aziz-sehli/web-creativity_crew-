<?php

class comment
{
    private ?int $id = null;
    private ?string $post_id = null;
    private ?string $auteur = null;
    private ?string $contenu_comment = null;
   
    public function __construct( $id = NULL, $post_id, $auteur,$contenu_comment)
    {
        $this->id = $id;
        $this->post_id = $post_id;
        $this->auteur = $auteur;
        $this->contenu_comment = $contenu_comment;


    }

    public function getid()
    {
        return $this->id;
    }
    public function setid($id)
    {
        $this->id = $id;

        return $this;
    }
    public function getpost_id()
    {
        return $this->post_id;
    }

    public function setpost_id($post_id)
    {
        $this->post_id = $post_id;

        return $this;
    }

    public function getauteur()
    {
        return $this->auteur;
    }
    public function setauteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }
    public function getcontenu_comment()
    {
        return $this->contenu_comment;
    }
    public function setcontenu_comment($contenu_comment)
    {
        $this->contenu_comment = $contenu_comment;

        return $this;
    }
}