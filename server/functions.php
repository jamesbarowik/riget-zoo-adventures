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