<?php
require_once __DIR__ . "/../config/Database.php";
include_once __DIR__ . "/../config/settings.php";

class Authentication {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function signup($name, $email, $password, $acc_type) {
        $stmt = $this->db->prepare("SELECT * FROM account WHERE email = :email");
        $stmt->execute([":email"=>$email]);
        if($stmt->rowCount() > 0) {
            echo 
            "<script>
                alert(\"Account Is Already Existing!\");
                window.location.href = \"../index.php\";
            </script>";
            exit();
        }

        $stmt =$this->db->prepare("INSERT INTO account(name,email,password,type)VALUES(:name,:email,:password,:type)");
        $stmt->execute([
            ":name"=>$name,
            ":email"=>$email,
            ":password"=>$password,
            ":type"=>$acc_type
        ]);

        echo 
        "<script>
            alert(\"Account Added Successfully!\");
            window.location.href = \"../index.php\";
        </script>";
    }

    public function signin($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM account WHERE email = :email");
        $stmt->execute([":email"=>$email]);
        if($stmt->rowCount() <= 0) {
            echo 
            "<script>
                alert(\"Account Does Not Existing Yet!\");
                window.location.href = \"../index.php\";
            </script>";
            exit();
        }

        $account = $stmt->fetch(PDO::FETCH_ASSOC);
        if($password === $account["password"]) {
            echo 
            "<script>
                alert(\"Password Did Not Match!\");
                window.location.href = \"../index.php\";
            </script>";
            exit();
        }

        switch($account["type"]) {
            case "patient":
                echo "Hi, Patient " . $account["name"] . "!";
                break;
            case "secretary":
                echo "Hi, Secretary " . $account["name"] . "!";
                break;
        }
    }
}

if(isset($_POST["signup"])) {
    (new Authentication())->signup(
        $_POST["name"],
        $_POST["email"],
        $_POST["password"],
        $_POST["acc_type"]
    );
}

if(isset($_POST["signin"])) {
    (new Authentication())->signin(
        $_POST["email"],
        $_POST["password"]
    );
}
