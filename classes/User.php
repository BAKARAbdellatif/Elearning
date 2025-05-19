<?php

class User
{
    private $conn;
    private $table = "users";
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;

    public function __construct($db, $id = null, $nom = null, $prenom = null, $email = null, $password = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = (isset($password)) ? password_hash($password, PASSWORD_BCRYPT) : null;
        $this->conn = $db;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNom()
    {
        $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getEmail()
    {
        $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function create()
    {
        $query = "INSERT INTO $this->table(`nom`, `prenom`, `email`, `password`) 
        VALUES (:nom, :prenom, :email, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':prenom', $this->prenom);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getAll()
    {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $resultats = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($this->conn);
            $user->setId($row['id']);
            $user->setNom($row['nom']);
            $user->setPrenom($row['prenom']);
            $user->setEmail($row['email']);
            $user->setPassword($row['password']);
            $resultats[] = $user;
        }
        return $resultats;
    }
}
