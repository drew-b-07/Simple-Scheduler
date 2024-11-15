<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In & Sign Up | Scheduler</title>
</head>
<body>
    <div id="wrapper">
        <div class="signup container">
            <form action="/dashboard/Authentication.php" method="post">
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="Enter Your Name"><br>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter Your Password"><br>
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Enter Your Email"><br>
                <label for="acc_type">Type</label>
                <select name="acc_type" id="acc_type">
                    <option value="patient">Patient</option>
                    <option value="secretary">secretary</option>
                </select>
                <br>
                <input type="submit" name="signup" value="SIGN UP">
            </form>

        </div>
        <hr>
        <div class="signin container">
            <form action="/dashboard/Authentication.php" method="post">
            <label for="password">Password</label>
                <input type="password" name="Sign In Password" placeholder="Enter Your Password"><br>
                <label for="email">Email</label>
                <input type="email" name="Sign In Email" placeholder="Enter Your Email"><br>
                <input type="Submit" value="SIGN IN" name="signin">
            </form>
        </div>
    </div>
</body>
</html>
