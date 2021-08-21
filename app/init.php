<?php 

/* 
    INIT
    Basic configuration settings
*/

// connect to database
$server = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'shop_cart';
$Database = new mysqli($server, $user, $pass, $db);