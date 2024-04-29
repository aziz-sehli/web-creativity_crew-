<?php

class Job {
    private $id_job_offers;
    private $id_entreprise;
    private $id_recruteur;
    private $id_category;
    private $date;
    private $titre;
    private $description;
    private $competence_requis;
    private $experience;
    
    private $lieu_travail;

    // Constructor
    public function __construct($id_job_offers, $id_entreprise, $id_recruteur, $id_category, $date, $titre, $description, $competence_requis, $experience, $lieu_travail) {
        $this->id_job_offers = $id_job_offers;
        $this->id_entreprise = $id_entreprise;
        $this->id_recruteur = $id_recruteur;
        $this->id_category = $id_category;
        $this->date = $date;
        $this->titre = $titre;
        $this->description = $description;
        $this->competence_requis = $competence_requis;
        $this->experience = $experience;
       
        $this->lieu_travail = $lieu_travail;
    }

    // Getter methods
    public function getid_job_offers() {
        return $this->id_job_offers;
    }

    public function getid_entreprise() {
        return $this->id_entreprise;
    }

    public function getid_recruteur() {
        return $this->id_recruteur;
    }

    public function getid_category() {
        return $this->id_category;
    }

    public function getdate() {
        return $this->date;
    }

    public function gettitre() {
        return $this->titre;
    }

    public function getdescription() {
        return $this->description;
    }

    public function getcompetence_requis() {
        return $this->competence_requis;
    }

    public function getexperience() {
        return $this->experience;
    }

   
    public function getlieu_travail() {
        return $this->lieu_travail;
    }
}

?>
