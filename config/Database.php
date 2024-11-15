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
}