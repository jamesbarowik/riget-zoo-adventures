<?php
session_start();
require '../server/db_connect.php';
require '../server/functions.php';

if (!isset($_SESSION['admin_cookie']) || $_SESSION['group'] !== 'ROOT') {
    header("Location: ../index.php?error=cookie_error");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "INSERT INTO hotel_rooms (type, occupancy, no_of_rooms, price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $_POST['type']);
    $stmt->bindParam(2, $_POST['occupancy']);
    $stmt->bindParam(3, $_POST['no_of_rooms']);
    $stmt->bindParam(4, $_POST['price']);
    $stmt->execute();

    header("refresh:5; url=../admin_index.php");
    echo "Created room";
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Create a new ticket</h1>
<?php
if (isset($_GET['error']) && $_GET['error'] === 'invalid_email') {
    echo "<p style='color: red;'>Your email must have @rzl.com. Please try again!</p>";
}
?>
<form method="POST" action="">
    <div class='text-element'>Enter room type</div>
    <input class="text_input" type="text" name="type" required>
    <div class='text-element'>Enter occupancy</div>
    <input class="text_input" type="text" name="occupancy" required>
    <div class='text-element'>Enter number of rooms</div>
    <input class="text_input" type="number" name="no_of_rooms" required>
    <div class='text-element'>Enter price</div>
    <input class="text_input" type="number" name="price" required>
    <br><br>
    <input class="submit" type="submit" value="Create">
</form>
</body>
