<?php

class Database {
    private $hostname;
    private $dbname;
    private $username;
    private $password;

    public function __construct() {
        if($_SERVER["SERVER_NAME"] === "localhost" || $_SERVER["SERVER_ADDR"] === "192.168.1.72" || $_SERVER["SERVER_ADDR"] === "127.0.0.1") {
            $this->hostname = "localhost";
            $this->dbname = "sample";
            $this->username = "root";
            $this->password = "";
        } else {
            $this->hostname = "localhost";
            $this->dbname = "root";
            $this->username = "root";
            $this->password = "root";
        }
    }

    public function connect() {
        $pdo = null;

        try {
            $pdo = new PDO("mysql:host={$this->hostname};dbname={$this->dbname}", $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $pdo_err) {
            echo 
            "<script>
                alert(\"{$pdo_err->getMessage()}\");
                window.location.href = \"../index.php\";
            </script>";
            exit();
        }

        return $pdo;
    }
}
