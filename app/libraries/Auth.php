<?php

class Auth
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function register($data)
    {
        $sql = 'INSERT INTO users(`name`, `email`, `password`) VALUES (:name, :email, :pass)';

        $this->db->query($sql);

        if($this->db->execute($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $pass)
    {
        $user = $this->findByEmail($email);
        if (!empty($user) && password_verify($pass, $user->password)) {
            $_SESSION['is_login'] = true;
            $_SESSION['name'] = $user->name;
            $_SESSION['email'] = $user->email;
            $_SESSION['pass'] = $user->password;
            return true;
        } else {
            return false;
        }
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $this->db->query($sql);
        $this->db->execute(['email' => $email]);
        return $this->db->single();
    }

    public static function isLogin()
    {
        if (isset($_SESSION['is_login']) && $_SESSION['is_login']) {
            return true;
        } else {
            return false;
        }
    }
}