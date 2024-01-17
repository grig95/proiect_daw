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

$offerID = $_POST['id_oferta'];

$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

$reserveOfferQuery = "update oferte set cod_terminare=2 where cod_terminare=0 and id=".$offerID.";";

$link->query($reserveOfferQuery);

if(mysqli_affected_rows($link)>0)
    {
        $transactionQuery = "insert into tranzactii (id_oferta, id_cumparator) values (".$offerID.", ".$userInfo['id'].")";
        $link->query($transactionQuery);
        echo "Tranzactie efectuata!";
    }
else
    {
        echo "Ne pare rau, tranzactia a esuat.\n";
    }

// Go home button:
echo "<a href='".getCurrentParentURI()."/user.php'>Home</a>";
mysqli_close($link);
?>