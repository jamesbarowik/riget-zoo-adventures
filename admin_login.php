<?php
// Connects the database
require 'server/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT password, `group` FROM admins WHERE email = ?"; //set up the sql statement
    $stmt = $conn->prepare($sql); //prepares
    $stmt->bindParam(1,$_POST['email']);  //binds the parameters to execute
    $stmt->execute(); //run the sql code
    $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results

    password_verify($_POST["password"], $result["password"]); // verifies the password is matched

    $_SESSION["admin_ssnlogin"] = true;  // sets up the session variables
    $_SESSION["email"] = $_POST['email'];
    $_SESSION["group"] = $result["group"];
//    auditor($_POST['username'],"login", "Logged into the system");
    header("location:admin_index.php");  //redirect on success
    exit();
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Admin Login</h1>
    <form method="POST" action="">
        <div class='text-element'>Enter email *</div>
        <input class="text_input" type="email" id="email" name="email" required>
        <div class='text-element'>Enter password *</div>
        <input class="text_input" type="password" id="email" name="password" required>
        <br><br>
        <input class="submit" type="submit" value="Log In">
    </form>
</body>
</html>