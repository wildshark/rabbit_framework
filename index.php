<?php
error_reporting(E_ALL); 
include_once('./control/config.php');
include_once('./control/control.php');
include_once('./control/rsource.php');
include_once('./control/function.php');
include_once('./control/route.php');
//Start the loader,  uncomment the line below to start the application.
//Replace 'desk' with the name of the module you want to start.
rabbit::LoadModular();
rabbit::error_handler();
//carrot::info();
rabbit::start('soap');
set_error_handler("customErrorHandler");;

?>
