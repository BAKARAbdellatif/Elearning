<?php
require_once 'User.php';

class Admin extends User
{
    private $conn;
    private $table = "admins";
    private $id_admin = null;
    private $id_user;
    private $is_active = true;

    public function __construct($db, $id = null, $nom = null, $prenom = null, $email = null, $password = null)
    {
        parent::__construct($db, $id, $nom, $prenom, $email, $password);
        $this->conn = $db;
    }

    public function getIsActive()
    {
        return $this->is_active;
    }

    public function setIsActive($is_active)
    {
        $this->is_active = $is_active;
    }

    public function getIdAdmin()
    {
        return $this->id_admin;
    }

    public function setIdAdmin($id_admin)
    {
        $this->id_admin = $id_admin;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    public function createAdmin()
    {
        $this->create();
        $this->id_user = $this->getId();
        $query = "INSERT INTO " . $this->table . " (id_user, is_active) VALUES (:id_user, :is_active)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_user', $this->id_user);
        $stmt->bindParam(':is_active', $this->is_active);
        if ($stmt->execute()) {
            $lastId = $this->conn->lastInsertId();
            $this->setIdAdmin($lastId);
            return true;
        }
        return false;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table . " INNER JOIN users ON admins.id_user = users.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $resultats = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $admin = new Admin($this->conn);
            $admin->setIdAdmin($row['id_admin']);
            $admin->setId($row['id_user']);
            $admin->setNom($row['nom']);
            $admin->setPrenom($row['prenom']);
            $admin->setEmail($row['email']);
            $admin->setPassword($row['password']);
            $admin->setIsActive($row['is_active']);
            $admin->setIdUser($row['id_user']);
            $resultats[] = $admin;
        }
        return $resultats;
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " INNER JOIN users ON admins.id_user = users.id WHERE id_admin = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $admin = new Admin($this->conn);
            $admin->setIdAdmin($row['id_admin']);
            $admin->setId($row['id_user']);
            $admin->setNom($row['nom']);
            $admin->setPrenom($row['prenom']);
            $admin->setEmail($row['email']);
            $admin->setPassword($row['password']);
            $admin->setIsActive($row['is_active']);
            $admin->setIdUser($row['id_user']);
            return $admin;
        }
        return null;
    }
    // TODO ; Update Admin
}
