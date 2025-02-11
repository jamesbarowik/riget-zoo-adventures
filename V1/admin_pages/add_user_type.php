<?php
session_start();
require '../server/db_connect.php';
require '../server/functions.php';

if (!isset($_SESSION['admin_cookie']) || $_SESSION['group'] !== 'ROOT') {
    header("Location: ../index.php?error=cookie_error");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "INSERT INTO user_type (`group`, discount) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $_POST['group_name']);
    $stmt->bindParam(2, $_POST['discount']);
    $stmt->execute();

    header("refresh:5; url=admin_index.php");
    echo "Created user type";
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Create a user type</h1>
<?php
if (isset($_GET['error']) && $_GET['error'] === 'invalid_email') {
    echo "<p style='color: red;'>Your email must have @rzl.com. Please try again!</p>";
}
?>
<form method="POST" action="">
    <div class='text-element'>Enter group name</div>
    <input class="text_input" type="text" name="group_name" required>
    <div class='text-element'>Enter discount</div>
    <input class="text_input" type="number" name="discount" required>
    <br><br>
    <input class="submit" type="submit" value="Create">
</form>
</body>
