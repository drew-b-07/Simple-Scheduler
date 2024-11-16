<?php
include_once __DIR__ . "/config/settings.php";

if (isset($_SESSION["login_acc"])) {
    echo 
    "<script>
        alert(\"Account is logged in!\");
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
    <title>Sign In & Sign Up | Scheduler</title>
    <link rel="stylesheet" href="src/css/styles.css"> <!-- Link to external CSS file -->
</head>
<body>
<script src="src/js/scripts.js"></script>
    <header>
        <h1>Welcome to Scheduler</h1>
        <nav>
            <a href="#signup">Sign Up</a>
            <a href="#signin">Sign In</a>
            <a href="homepage.php">Homepage</a> <!-- Link to the homepage -->
        </nav>
    </header>

    <div id="wrapper">
        <div class="signup container" id="signup">
            <h2>Sign Up</h2>
            <form action="./dashboard/Authentication.php" method="post">
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="Enter Your Name"><br>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter Your Password"><br>
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Enter Your Email"><br>
                <label for="acc_type">Type</label>
                <select name="acc_type" id="acc_type">
                    <option value="patient">Patient</option>
                    <option value="secretary">Secretary</option>
                </select>
                <br>
                <input type="submit" name="signup" value="SIGN UP">
            </form>
        </div>
        <hr>
        <div class="signin container" id="signin">
            <h2>Sign In</h2>
            <form action="./dashboard/Authentication.php" method="post">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter Your Password"><br>
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Enter Your Email"><br>
                <input type="submit" value="SIGN IN" name="signin">
            </form>
        </div>
    </div>
</body>
</html>
