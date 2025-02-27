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
    <br>
    <a href="admin_login.php">Login as an admin?</a>
</body>
</html>

<?php
//Start the session
session_start();
// Database Connection Statement
require 'server/db_connect.php';
// Functions Connection Statement
require 'server/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // First check if the email exists and get the staff details
    $sql = "SELECT user_id, email, password, user_type_id FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user_return = $stmt->fetch(PDO::FETCH_ASSOC);



    if ($user_return && password_verify($password, $user_return['password'])) {
        // Store the results in the arrary user_return and then make them session variables for later use
        $_SESSION['user_id'] = $user_return['user_id'];
        $_SESSION["ssnlogin"] = true;
        $_SESSION["email"] = $user_return["email"];
        $_SESSION["user_type_id"] = $user_return["user_type_id"]; // Store group in session

        // Set the cookie for a very long time during development
        if (!setcookie(
            'cookies_and_cream',
            'active',
            [
                'expires' => time() + (10000 * 60),  // 5 minutes
                'path' => '/',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Strict'
            ]
        )) {
            // Log failed cookie setting
//            $source = "Login";
//            $staff_id = $user['staff_id']; // Fetch from POST, not SESSION
//            $staff_code = $user['staff_code']; // Staff code is correctly from SESSION
//            $action = "Failed to set login cookie.";

//            logAction($conn, $staff_id, $action, $source);
            header("Location: ../index.php");
            exit();
        }
        // Log successful login attempt
//        $source = "Login";
//        $staff_id = $user['staff_id']; // Fetch from POST, not SESSION
//        $staff_code = $user['staff_code']; // Staff code is correctly from SESSION
//        $action = "User successfully logged in";
//
//        logAction($conn, $staff_id, $action, $source);
//        logAction($conn, $user['staff_id'], 'User successfully logged in');

        // Redirect to dashboard
        header("Location: user_index.php");
        exit();
    }
}
?>
