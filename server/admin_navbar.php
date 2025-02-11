<?php
/*
 * User Groups
 - ROOT : First admin user that was created
 - MANAGER : Be able to add and manage Tickets, Hotel Rooms, User Types
 - ADMIN :
 */
session_start();

if (empty($_SESSION["admin_cookie"])) {
    echo "<a href='admin_login.php'><li> Login </li></a>";
} elseif ($_SESSION["admin_cookie"]) {
    // If the session variable "group" is equal to root
    if ($_SESSION["group"]=="ROOT") {
        echo "<a href='admin_pages/add_admin.php' <li> Create Admin Users </li></a>";
        echo "|";
    // If the session variable "group" is equal to Root or Manager
    }if ($_SESSION["group"]=="ROOT" or $_SESSION["group"]=="MANAGER"){
        echo "<a href='admin_pages/add_ticket.php' <li> Add Ticket </li></a>";
        echo "|";
        echo "<a href='admin_pages/add_hotel_room.php' <li> Add Hotel Room </li></a>";
        echo "|";
        echo "<a href='admin_pages/add_user_type.php' <li> Add User Type </li></a>";
        echo "|";
    // If the session variable "group" is equal to Root or Manager or Admin
    }if ($_SESSION["group"]=="ROOT" or $_SESSION["group"]=="MANAGER" or $_SESSION["group"]=="ADMIN"){
        echo "<a href='admin_pages/add_ticket.php' <li> Update Ticket </li></a>";
        echo "|";
        echo "<a href='admin_pages/add_hotelroom.php' <li> Update Hotel Room </li></a>";
        echo "|";
        echo "<a href='admin_pages/add_usertype.php' <li> Update User Type </li></a>";
    }
}?>