<?php

// To access 'require ../server/db_connect.php'

$servername = "127.0.0.1"; // IP Address of the SQL Server
$username = "root"; //Should be replaced with a rza account
$password = ""; // Secure password
$dbname = "rza"; // Database Name

try {
    $conn = new PDO(
        "mysql:host=$servername;
        port=3306;
        dbname=$dbname",
        $username,
        $password
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>