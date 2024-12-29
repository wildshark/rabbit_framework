<?php

switch($_REQUEST['page']){

    case"register";
        require("./frame/registration.php");
    break;

    case"forgot-password";
        require("./frame/forget.password.php");
    break;

    case"lock-screen";
        require("./frame/lock-screen.php");
    break;

    default:
        header('location: ?login=user-login');
}

?>