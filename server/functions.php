<?php
function root_checker(){
    include 'db_connect.php';//gets the select user details to check if admin exists or not
    $sql = "SELECT * FROM admins"; //set up the sql statement
    $stmt = $conn->prepare($sql); //prepares
    $stmt->execute(); //run the sql code
    $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results
    if($result){
        return true;
    } else {
        return false;
    }
}

function check_root_group(){
    if (!isset($_SESSION['ssnlogin']) || !isset($_COOKIE['cookies_and_cream']) || $_SESSION['group'] !== 'ROOT') {
        header("Location: ../index.php?error=cookie_error");
        exit();
    }
}

function check_admin_group(){
    if (!isset($_SESSION['ssnlogin']) || !isset($_COOKIE['cookies_and_cream']) || $_SESSION['group'] !== 'ADMIN') {
        header("Location: ../index.php?error=cookie_error");
        exit();
    }
}

function check_manager_group(){
    if (!isset($_SESSION['ssnlogin']) || !isset($_COOKIE['cookies_and_cream']) || $_SESSION['group'] !== 'MANAGER') {
        header("Location: ../index.php?error=cookie_error");
        exit();
    }
}