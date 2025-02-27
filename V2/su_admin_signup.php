<?php
// Use the pre-made database connection
require 'server/db_connect.php';
require 'server/functions.php';

if (root_checker()){
    header("refresh:0; url=admin_login.php");
    echo "Super user already created";
}elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $hash_password = password_hash($password = $_POST['password'], PASSWORD_DEFAULT);
    $group = "ROOT";
    $sign_up_date = time();

    $sql = "INSERT INTO admins (first_name, last_name, email, password, `group`, sign_up_date) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$first_name);
    $stmt->bindParam(2,$last_name);
    $stmt->bindParam(3,$email);
    $stmt->bindParam(4,$hash_password);
    $stmt->bindParam(5,$group);
    $stmt->bindParam(6,$sign_up_date);

    $stmt->execute();
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
    <h1>Create a Super User</h1>
    <form action="" method="POST">
        <div class='text-element'>Enter first name *</div>
        <input class="text_input" type="text" name="first_name" required>
        <div class='text-element'>Enter last name *</div>
        <input class="text_input" type="text" name="last_name" required>
        <div class='text-element'>Enter email *</div>
        <input class="text_input" type="email" name="email" required>
        <div class='text-element'>Enter password *</div>
        <input class="text_input" type="password" name="password" required>
        <br><br>
        <input type='submit' name='submit' value='Continue'>
    </form>
</body>
</html>