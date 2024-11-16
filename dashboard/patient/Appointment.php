<?php
require_once __DIR__ . "/../../config/Database.php";
include_once __DIR__ . "/../../config/settings.php";

class Appointment {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function createAppointment($name, $date) {
        $stmt = $this->db->prepare("INSERT INTO appointment(patient_email, name, schedule) VALUES(:patient_email, :name, :schedule)");
        $stmt->execute([
            ":patient_email" => $_SESSION["login_acc"]["email"],
            ":name" => $name,
            ":schedule" => $date
        ]);

        echo
        "<script>
            alert(\"Schedule Added Successfully!\");
            window.location.href = \"./dashboard.php\";
        </script>";
    }
}

if(isset($_POST["create_appointment"])) {
    (new Appointment())->createAppointment(
        $_POST["appointment_name"],
        $_POST["appointment_schedule"]
    );
}