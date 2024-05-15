<?php
class post
{
    private ?int $id = null;
    private ?string $auteur = null;
    private ?string $titre = null;
    private ?string $contenu = null;
   
    public function __construct( $id = NULL, $auteur, $titre,$contenu)
    {
        $this->id = $id;
        $this->auteur = $auteur;
        $this->titre = $titre;
        $this->contenu = $contenu;


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
    public function gettitre()
    {
        return $this->titre;
    }

    public function settitre($titre)
    {
        $this->titre = $titre;

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
    public function getcontenu()
    {
        return $this->contenu;
    }
    public function setcontenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }
   
}
