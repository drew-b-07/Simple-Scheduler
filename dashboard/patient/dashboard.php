<?php
include_once __DIR__ . "/../../config/settings.php";

if(!isset($_SESSION["login_acc"])) {
    echo 
    "<script>
        alert(\"No user is logged in!\");
        window.location.href = \"../../index.php\";
    </script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Patient</title>
</head>
<body>
    <div id="wrapper">
        <div class="greeting container">
            <h1>Hello, Patient <?= $_SESSION["login_acc"]["name"] ?>!</h1>
            <a href="../Authentication.php?logout">Logout</a>
        </div>
        <div class="appointment container">
            <h2>Schedule Appointment</h2>
            <form action="./Appointment.php" method="post">
                <label for="appointment_name">Name of Appointment: </label>
                <input type="text" name="appointment_name" id="appointment_name" placeholder="Appointment Name" required/>
                <br>
                <label for="appointment_schedule">Schedule: </label>
                <input type="datetime-local" name="appointment_schedule" id="appointment_datetime" required/>
                <br>
                <input type="submit" name="create_appointment" value="Create Schedule"/>
            </form>
        </div>
        <hr>
        <div class="records container">
            <h2>Records of Appointment</h2>
            <table border="1rem">
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
                <tr id="records_container">
                    <?php 
                    require_once __DIR__ . "/Appointment.php";
                    ?>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>