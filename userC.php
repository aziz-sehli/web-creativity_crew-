<?php

require_once "../config.php";
include_once "../Model/user.php";
include_once "../sms/twilio/vendor/autoload.php";

use Twilio\Rest\client;

class userC
{
    function searchById($id)
{
    $sql = "SELECT * FROM utilisateur WHERE id = :id";
    $db = config::getConnexion();
    $message = "";
    $result = NULL;

    try {
        $query = $db->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $count = $query->rowCount();
        if ($count > 0) {
            $result = $query->fetch();
        }
    } catch (Exception $e) {
        $message = " " . $e->getMessage();
    }

    return $result;
}

    public function emailExists($email) {
        $db = config::getConnexion();
        $query = $db->prepare("SELECT COUNT(*) FROM utilisateur WHERE email = :email");
        $query->bindParam(":email", $email);
        $query->execute();
        $count = $query->fetchColumn();
        return $count > 0;
    }

    // Function to check if a phone number exists in the database
    public function phoneExists($phone) {
        $db = config::getConnexion();
        $query = $db->prepare("SELECT COUNT(*) FROM utilisateur WHERE phone = :phone");
        $query->bindParam(":phone", $phone);
        $query->execute();
        $count = $query->fetchColumn();
        return $count > 0;
    }
  
    public function countsociete()
    {
        $db = config::getConnexion();
        $query = $db->query("SELECT COUNT(*) FROM utilisateur WHERE role = 'societe'");
        $count = $query->fetchColumn();
        return $count;
    }
    public function countcondidat()
    {
        $db = config::getConnexion();
        $query = $db->query("SELECT COUNT(*) FROM utilisateur WHERE role = 'condidat'");
        $count = $query->fetchColumn();
        return $count;
    }

 

    function updatePass($pass,$id)
    {
     
        
        $sql = "UPDATE Utilisateur SET password = :pass WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'pass' => $pass,
                'id' => $id,
            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
    function deleteTok($id)
    {
        $sql = "DELETE FROM token WHERE id=:id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
    function check2($code) {
        $sql="SELECT * FROM token WHERE token='" .$code. "'";
        $db = config::getConnexion () ;
        $check=NULL;
        try{
            $query=$db->prepare ($sql) ;
            $query->execute ();
            $count=$query->rowCount();
            if($count==0) {
              
                $check=0;
        }else {
                $check=$query->fetch ();
             //   $message = $x['role'];
        }}
        catch (Exception $e){
            $message= " ".$e->getMessage () ;
        }
        return $check;
        }
    function check($phone) {
        $sql="SELECT * FROM Utilisateur WHERE phone='" .$phone. "'";
        $db = config::getConnexion () ;
        $check=NULL;
        try{
            $query=$db->prepare ($sql) ;
            $query->execute ();
            $count=$query->rowCount();
            if($count==0) {
              
                $check=0;
        }else {
                $check=$query->fetch ();
             //   $message = $x['role'];
        }}
        catch (Exception $e){
            $message= " ".$e->getMessage () ;
        }
        return $check;
        }
    function test($id)
    {
    $randomCode = substr(uniqid(rand(), true), 0, 5);
     $sid="AC360b902fbb87e6e2b739fdeb5266fc4c";
     $token="13066d45f80de281744a1fd0c4fc6cbb";
     $twilio = new Client($sid,$token);
     $message = $twilio->messages->create("+21621777784",array(
        "from" => "+13342747605",
        "body" => $randomCode
     ));
     $message->sid;
     $sql = "INSERT INTO token (id, token)
     VALUES (:id, :code);";
      $db = config::getConnexion();
      try {
          $query = $db->prepare($sql);
          $query->execute([
              'code' => $randomCode,
              'id' => $id,
          ]);
      } catch (Exception $e) {
          echo 'Erreur: ' . $e->getMessage();
      }
    }
    function modifierUser($user)
    {
     
        
        $sql = "UPDATE Utilisateur SET nom = :nom, prenom = :prenom, email = :email, phone = :phone, password = :pass WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail(),
                'phone' => $user->getPhone(),
                'pass' => $user->getPassword(),
                'id' => $user->getId(),
            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
    
    function ajoutersociete($societe)
    {
    
        $sql = "INSERT INTO Utilisateur (nom, prenom, email, phone, password, role)
                VALUES (:nom, :prenom, :email, :phone, :pass, :role);
                
                SET @userId = LAST_INSERT_ID();
                
                INSERT INTO societe (id, cv, specialite, workAdress)
                VALUES (@userId, :cv, :spec, :wadd);";
    
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $societe->getNom(),
                'prenom' => $societe->getPrenom(),
                'email' => $societe->getEmail(),
                'phone' => $societe->getPhone(),
                'pass' => $societe->getPassword(), // Plain text password
                'role' => "societe",
                'cv' => $societe->getCv(),
                'spec' => $societe->getSpecialite(),
                'wadd' => $societe->getWorkAdress(),
            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
    
    function ajoutercondidat($condidat)
    {
    
        $sql = "INSERT INTO Utilisateur (nom, prenom, email, phone, password, role)
                VALUES (:nom, :prenom, :email, :phone, :pass, :role);
                
                SET @userId = LAST_INSERT_ID();
                
                INSERT INTO condidat (id, job, address)
                VALUES (@userId, :m, :add);";
    
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $condidat->getNom(),
                'prenom' => $condidat->getPrenom(),
                'email' => $condidat->getEmail(),
                'phone' => $condidat->getPhone(),
                'pass' => $condidat->getPassword(), // Plain text password
                'role' => "condidat",
                'm' => $condidat->getmatiere(),
                'add' => $condidat->getAddress(),
            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
    
    function connexionUser ($email, $password) {
        $sql="SELECT * FROM Utilisateur WHERE email='" .$email. "' and password = '". $password."'";
        $db = config::getConnexion () ;
        $message= "";
        $check=NULL;
        try{
            $query=$db->prepare ($sql) ;
            $query->execute ();
            $count=$query->rowCount();
            if($count==0) {
                $message= "pseudo ou le mot de passe est incorrect " ;
                $check=0;
        }else {
                $check=$query->fetch ();
             //   $message = $x['role'];
        }}
        catch (Exception $e){
            $message= " ".$e->getMessage () ;
        }
        return $check;
        }
        function retrieveUser($id, $role)
        {
            $sql = "";
            
            if ($role == "societe") {
                $sql = "SELECT * FROM soociete WHERE id = :id";
            } elseif ($role == "condidat") {
                $sql = "SELECT * FROM condidat WHERE id = :id";
            } else {
                // You might want to throw an exception or handle it accordingly.
                return NULL;
            }
        
            $db = config::getConnexion();
            $message = "";
            $check = NULL;
        
            try {
                $query = $db->prepare($sql);
                $query->bindParam(':id', $id, PDO::PARAM_INT);
                $query->execute();
                $count = $query->rowCount();
                $check = $query->fetch();
            } catch (Exception $e) {
                $message = " " . $e->getMessage();
            }
        
            return $check;
        }
        
            function supprimerUser($id)
            {
                $sql = "DELETE FROM utilisateur WHERE id=:id";
                $db = config::getConnexion();
                $req = $db->prepare($sql);
                $req->bindValue(':id', $id);
                try {
                    $req->execute();
                } catch (Exception $e) {
                    echo 'Erreur: ' . $e->getMessage();
                }
            }
            
    function afficherUser()
    {
        $sql = "SELECT * FROM utilisateur";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    function update($id)
    {
        try {
            $db = config::getConnexion();
           $sql = "UPDATE commands SET etat = 'En cours'  WHERE id=:id ";
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
            ]);
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
}

