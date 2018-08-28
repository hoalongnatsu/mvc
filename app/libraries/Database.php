<?php

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        // DSN
        $dsn = "mysql:host={$this->host}; dbname={$this->dbname}";
        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        // Create PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function execute($params = [])
    {
        return $this->stmt->execute($params);
    }

    public function results_set()
    {
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function single()
    {
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
}