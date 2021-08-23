<?php

include('app/init.php');
$Template->set_data('page_class', 'shoppingcart');

if (isset($_GET['id']) && is_numeric($_GET['id']))
{
    // check if adding a valid item

    // add item to cart
    if (isset($_GET['num']) && is_numeric($_GET['num']))
    {
        $Cart->add($_GET['id'], $_GET['num']);
        $Template->set_alert('Items have been added to the cart!');
    }
    else 
    {
        $Cart->add($_GET['id']);
        $Template->set_alert('Item has been added to the cart!');
    }
    $Template->redirect(SITE_PATH . 'cart.php');
}

if (isset($_GET['empty']))
{
    $Cart->empty_cart();
    $Template->set_alert('Shopping cart emptied!');
    $Template->redirect(SITE_PATH . 'cart.php');
}

$Template->load('app/views/v_public_cart.php', 'Shopping Cart');
