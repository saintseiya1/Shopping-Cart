<?php

include('app/init.php');

// get category nav
$category_nav = $Categories->create_category_nav('home');
$Template->set_data('page_nav', $category_nav);

$Template->load('app/views/v_public_home.php', 'Welcome!');
//$Template->redirect('http://www.killersites.com');


?>