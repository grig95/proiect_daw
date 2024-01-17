<?php

require_once 'constants.php';
require_once 'utility.php';

// Redirect in case no cookie is passed
if(!isset($_COOKIE['sessionid']))
    {
        $parentURI = getCurrentParentURI();
        header('Location: '.$parentURI.'/login.php');
        exit;
    }
        
$userInfo = getUserInfoForSession($_COOKIE['sessionid']);
// Redirect in case of invalid user
if(!$userInfo)
    {
        $parentURI = getCurrentParentURI();
        header('Location: '.$parentURI.'/login.php');
        exit;
    }


$bun = sanitizeSQLInput($_POST['bun']);
$pret = $_POST['pret'];

$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

$query = "insert into oferte (id_vanzator, bun, pret) values (".$userInfo['id'].", '".$bun."', ".$pret.");";

$link->query($query);

if(mysqli_affected_rows($link)<=0)
    echo "Something went wrong. Please try again.";
else
    {
        $parentURI = getCurrentParentURI();
        header('Location: '.$parentURI.'/user.php');
    }


mysqli_close($link);
?>