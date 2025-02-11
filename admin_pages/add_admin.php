<?php
session_start();
require '../server/db_connect.php';
require '../server/functions.php';

if (!isset($_SESSION['admin_cookie']) || $_SESSION['group'] !== 'ROOT') {
    header("Location: ../index.php?error=cookie_error");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate the email to ensure it has the @rzl.com
    $email = $_POST['email'];
    if (!str_ends_with($email, '@rzl.com')) {
        header("Location: add_admin.php?error=invalid_email");
        exit();
    }
    $sql = "INSERT INTO admins (first_name, last_name, email, password, `group`, sign_up_date) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $_POST['first_name']);
    $stmt->bindParam(2, $_POST['last_name']);
    $stmt->bindParam(3, $email);

    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt->bindParam(4, $hashed_password);
    $stmt->bindParam(5, $_POST['group']);

    $date_time = time();
    $stmt->bindParam(6, $date_time);
    $stmt->execute();

    header("refresh:5; url=admin_index.php");
    echo "Created User";
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Login</h1>
<?php
if (isset($_GET['error']) && $_GET['error'] === 'invalid_email') {
    echo "<p style='color: red;'>Your email must have @rzl.com. Please try again!</p>";
}
?>
<form method="POST" action="">
    <div class='text-element'>Enter first name</div>
    <input class="text_input" type="text" name="first_name" required>
    <div class='text-element'>Enter last name</div>
    <input class="text_input" type="text" name="last_name" required>
    <div class='text-element'>Enter email</div>
    <input class="text_input" type="email" name="email" required>
    <div class='text-element'>Enter password</div>
    <input class="text_input" type="password" name="password" required>
    <div class='text-element'>Select your group</div>
    <select name="group" required>
        <option value="ADMIN">Admin</option>
        <option value="MANAGER">Manager</option>
    </select>
    <br><br>
    <input class="submit" type="submit" value="Create">
</form>
</body>
