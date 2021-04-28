<?php
class User 
{
    private $db;

    public function __construct() 
    {
        $this->db = new Database;
    }

    public function getUsers() 
    {
        $this->db->query("SELECT * FROM users");

        $result = $this->db->resultSet();

        return $result;
    }

    public function register($data) {
        $this->db->query('INSERT INTO users (name, username, email, password) 
        VALUES(:name, :username, :email, :password)');

        //Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($username, $password) {
        $this->db->query('SELECT * FROM users WHERE username = :username');

        //Bind value
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        $hashedPassword = $row->password;

        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    //Find user by username. Username is passed in by the Controller.
    public function findUserByUsername($username) {
        //Prepared statement
        $this->db->query('SELECT * FROM users WHERE username = :username');

        //Email param will be binded with the email variable
        $this->db->bind(':username', $username);

        //Check if email is already registered
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findUserByEmail($email) {
        //Prepared statement
        $this->db->query('SELECT * FROM users WHERE email = :email');

        //Email param will be binded with the email variable
        $this->db->bind(':email', $email);

        //Check if email is already registered
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findUserById($id)
    {
        $this->db->query("SELECT * FROM users WHERE id = :id");

        $this->db->bind(':id', $id);

        $result = $this->db->single();

        return $result;
    }

    public function deleteUser($id)
    {
        $this->db->query("DELETE FROM users WHERE id = :id");

        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        }
        else {
            return false;
        }
    }

    public function updateUsers($data)
    {
        $this->db->query("UPDATE users SET name = :name, username = :username WHERE id = :id");

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':id', $data['id']);

        if($this->db->execute()){
            return true;
        }
        else {
            return false;
        }
    }

}
