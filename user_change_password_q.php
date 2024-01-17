<?php

require_once 'constants.php';
require_once 'utility.php';
require_once 'phpmailer/mail_cod.php';

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

$currPass = hash(PASSWD_HASH_FUNC, sanitizeSQLInput($_POST['parola_curenta']));
$newPass = hash(PASSWD_HASH_FUNC, sanitizeSQLInput($_POST['parola_noua']));

$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

$checkQuery = "select * from utilizatori where id=".$userInfo['id']." and parola='".$currPass."';";
if($link->query($checkQuery)->fetch_array())
    {
        $changeQuery = "update utilizatori set parola='".$newPass."' where id=".$userInfo['id'].";";
        $link->query($changeQuery);
        sendPasswordChangeMail($userInfo['email']);
    }
else
    {
        echo "Parola curenta introdusa este invalida.";
    }

mysqli_close($link);

?>

<html>
    <title>MGOS Change Password</title>
    <body>
    <section>
    <?php
    echo "<a href='".getCurrentParentURI()."/user.php'>Home</a>";
    ?>
    </section>
    </body>
</html>