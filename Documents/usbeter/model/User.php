<?php

class UserException extends Exception
{
}

class User
{
    private $id;
    private $name;
    private $password;
    private $email;
    private $phone;
    private $house_number;
    private $zip;
    private $adminstatus;
    private $isActive;

    public function __construct($name, $password, $email, $phone, $house_number, $zip, $id = null, $adminstatus = 0, $isActive = 1)
    {
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
        $this->phone = $phone;
        $this->house_number = $house_number;
        $this->zip = $zip;
        $this->id = $id;
        $this->adminstatus = $adminstatus;
        $this->isActive = $isActive;
        

    }

    public function getName()
    {
        return $this->name;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getHouseNumber()
    {
        return $this->house_number;
    }

    public function getZip()
    {
        return $this->zip;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAdminStatus()
    {
        return $this->adminstatus;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setName($name)
    {
        if (empty($name) || !is_string($name)) {
            throw new UserException("Name cannot be empty");
        }
        $this->name = $name;
    }

    public function setPassword($password)
    {
        if (empty($password) || !is_string($password)) {
            throw new UserException("Password cannot be empty");
        }
        $this->password = $password;
    }

    public function setEmail($email)
    {
        if (empty($email) || !is_string($email)) {
            throw new UserException("Email cannot be empty");
        }
        $this->email = $email;
    }

    public static function getUserInfo($db, $id)
    {
        $sql = $db->prepare("SELECT name, email, phone, house_number, zip, adminstatus, isActive FROM customer WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        $result = $sql->fetch();

        $user = new User($result["name"], "", $result["email"], $result["phone"], $result["house_number"], $result["zip"], $id, $result["adminstatus"], $result["isActive"]);
        return $user;
    }

    public static function getAllUsers($db)
    {
        $sql = $db->prepare("SELECT id, name, email, password, phone, house_number, zip, adminstatus, isActive FROM customer");
        $sql->execute();
        $result = $sql->fetchAll();

        $users = [];
        foreach ($result as $row) {
            $user = new User($row["name"], $row["password"], $row["email"], $row["phone"], $row["house_number"], $row["zip"], $row["id"], $row["adminstatus"], $row["isActive"]);
            $users[] = $user;
        }
        return $users;
    }

    public function UserToAssocArray() : array{
        return [
            "name" => $this->name,
            "password" => $this->password,
            "email" => $this->email,
            "phone" => $this->phone,
            "house_number" => $this->house_number,
            "zip" => $this->zip,
            "id" => $this->id,
            "adminstatus" => $this->adminstatus,
            "isActive" => $this->isActive
        ];
    }
}

