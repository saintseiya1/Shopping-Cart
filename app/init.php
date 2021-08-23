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

define('SHOP_TAX', '0.0875');

//include objects
include('app/models/m_template.php');
include('app/models/m_categories.php');
include('app/models/m_products.php');
include('app/models/m_cart.php');

// create objects
$Template = new Template();
$Categories = new Categories();
$Products = new Products();
$Cart = new Cart();


session_start();

// global
$Template->set_data('cart_total_items', $Cart->get_total_items());
$Template->set_data('cart_total_cost', $Cart->get_total_cost());