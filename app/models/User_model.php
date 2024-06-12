<?php
class User_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function register($data)
    {
        if ($this->emailExists($data['email'])) {
            return -2;
        }
        $passhash = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->db->query('INSERT INTO user (name, email, password) VALUES (:name, :email, :password)');
        $this->db->bind('name', $data['nama']);

        $this->db->bind('email', $data['email']);
        $this->db->bind('password', $passhash);

        if ($this->db->execute()) {
            return 1;
        } else {
            return 0;
        }
    }
    public function emailExists($email)
    {
        $this->db->query('SELECT * FROM user WHERE email = :email');
        $this->db->bind('email', $email);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM user WHERE email = :email');
        $this->db->bind('email', $email);
        $user = $this->db->single();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }
}
