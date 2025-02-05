<?php

require 'server/db_connect.php';

// Assuming these values come from an HTML form via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date_time = time();
    $hpswd = password_hash($password = $_POST['password'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (email, password, sign_up_date, user_type_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$_POST['email']);
    $stmt->bindParam(2,$hpswd);
    $stmt->bindParam(3,$date_time);
    $stmt->bindParam(4,$_POST['role']);
    $stmt->execute();

    header("refresh:5; url=login.php");
    echo "Created User";
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Login</h1>
<form method="POST" action="">
    <div class='text-element'>Enter email</div>
    <input class="text_input" type="email" id="email" name="email" required>
    <br><br>
    <div class='text-element'>Enter password</div>
    <input class="text_input" type="password" id="email" name="password" required>
    <br><br>
    <div class='text-element'>Select your group</div>
    <select id="role" name="role" required>
        <option value="1">Customer</option>
        <option value="2">Education</option>
        <option value="3">Commercial</option>
    </select>
    <br><br>
    <input class="submit" type="submit" value="Log In">
</form>
<p>Penis</p>
</body>