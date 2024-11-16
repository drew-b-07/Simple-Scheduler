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
        if($password !== $account["password"]) {
            echo 
            "<script>
                alert(\"Password Did Not Match!\");
                window.location.href = \"../index.php\";
            </script>";
            exit();
        }

        $_SESSION["login_acc"] = $account;

        switch($account["type"]) {
            case "patient":
                header("Location: ./patient/dashboard.php");
                break;
            case "secretary":
                header("Location: ./secretary/dashboard.php");
                break;
        }
    }

    public function signout() {
        session_unset();
        session_destroy();

        echo
        "<script>
            alert(\"Sign Out Successfully!\");
            window.location.href = \"../index.php\";
        </script>";
    }
}

include_once __DIR__ . "/../config/settings.php";

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt password
    $role = $_POST['acc_type']; // 'patient' or 'secretary'

    // Database connection (Assume $conn is the database connection)
    $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $password, $role);

    if ($stmt->execute()) {
        echo "<script>alert('Sign-Up Successful!'); window.location.href = '../index.php';</script>";
    } else {
        echo "<script>alert('Error: Could not complete sign-up.'); history.back();</script>";
    }
    $stmt->close();
    $conn->close();
}


if(isset($_POST["signin"])) {
    (new Authentication())->signin(
        $_POST["email"],
        $_POST["password"]
    );
}

if(isset($_GET["logout"])) {
    (new Authentication())->signout();
}