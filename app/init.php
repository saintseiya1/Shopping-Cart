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

// error reporting
mysqli_report(MYSQLI_REPORT_ERROR);
ini_set('display_errors', 1);

// set up constants
define('SITE_NAME', 'My Online Store');
define('SITE_PATH', 'http://localhost/Shopping-Cart/');
define('IMAGE_PATH', 'http://localhost/Shopping-Cart/resources/images/');

//include objects
include('app/models/m_template.php');
include('app/models/m_categories.php');

// create objects
$Template = new Template();
$Categories = new Categories();


session_start();