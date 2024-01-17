<?php

require_once 'utility.php';

if(isset($_COOKIE['sessionid']))
    {
        terminateSession($_COOKIE['sessionid']);

        //remove cookie
        unset($_COOKIE['sessionid']);
        setcookie('sessionid', '', 1);
    }

//redirect to login page
$parentURI = getCurrentParentURI();
header('Location: '.$parentURI.'/login.php');
exit;


?>