<?php

include('app/init.php');

$Template->set_data('header', 'hello');
$Template->set_alert('alert!');

$Template->load('app/views/v_public_home.php', 'Welcome!');
//$Template->redirect('http://www.killersites.com');