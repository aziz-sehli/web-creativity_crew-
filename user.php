<?php
class Utilisateur {
    protected $id;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $phone;
    protected $password;
    protected $role;
    
    public function __construct($id, $nom, $prenom, $email, $phone, $password, $role) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->role = $role;
    }
    
    // Getters
    public function getId() {
        return $this->id;
    }
    
    public function getNom() {
        return $this->nom;
    }
    
    public function getPrenom() {
        return $this->prenom;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getPhone() {
        return $this->phone;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function getRole() {
        return $this->role;
    }
    
    // Setters
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setNom($nom) {
        $this->nom = $nom;
    }
    
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function setPhone($phone) {
        $this->phone = $phone;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function setRole($role) {
        $this->role = $role;
    }
}

class societe extends Utilisateur {
    private $cv;
    private $specialite;
    private $workAdress;
    
    public function __construct($id, $nom, $prenom, $email, $phone, $password, $role, $cv, $specialite, $workAdress) {
        
        parent::__construct($id, $nom, $prenom, $email, $phone, $password, $role);
        $this->specialite = $specialite;
        $this->cv = $cv;
        $this->workAdress = $workAdress;
    }
    
    // Getters
    public function getCv() {
        return $this->cv;
    }
    
    public function getSpecialite() {
        return $this->specialite;
    }
    
    public function getWorkAdress() {
        return $this->workAdress;
    }
    
    // Setters
    public function setCv($cv) {
        $this->cv = $cv;
    }
    
    public function setSpecialite($specialite) {
        $this->specialite = $specialite;
    }
    
    public function setWorkAdress($workAdress) {
        $this->workAdress = $workAdress;
    }
}

class condidat extends Utilisateur {
    private $job;
    private $address;
    
    public function __construct($id, $nom, $prenom, $email, $phone, $password, $role, $job, $address) {
        parent::__construct($id, $nom, $prenom, $email, $phone, $password, $role);
        $this->matiere = $job;
        $this->address = $address;
    }
    
    // Getters
    public function getjob() {
        return $this->job;
    }
    public function getAddress() {
        return $this->address;
    }
    
    // Setters
    public function setjob($job) {
        $this->job = $job;
    }
    public function setAddress($address) {
        $this->address = $address;
    }
}


?>