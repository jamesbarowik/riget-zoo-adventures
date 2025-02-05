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
    <h1>Login</h1>
    <form method="POST" action="">
        <div class='text-element'>Enter email *</div>
        <input class="text_input" type="email" id="email" name="email" required>
        <br><br>
        <div class='text-element'>Enter password *</div>
        <input class="text_input" type="password" id="email" name="password" required>
        <br><br>
        <input class="submit" type="submit" value="Log In">
    </form>
</body>
</html>

<?php

require 'server/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
}
?>
