<?php

require_once 'constants.php';
require_once 'utility.php';

$email = sanitizeSQLInput($_POST['email']);
$nume = sanitizeSQLInput($_POST['nume']);
$parola = sanitizeSQLInput($_POST['parola']);

// CHESTIA ASTA NU REDIRECTIONEAZA CU TOT CU ARGUMENTE SI NU IMI DAU SEAMA DE CE
if($nume != $_POST['nume'])
    {
        $uri = getCurrentParentURI().'/signup.php?invalid_username=1';
        header('Location: '.$uri);
        exit;
    }
if($parola != $_POST['parola'])
    {
        $uri = getCurrentParentURI().'/signup.php?invalid_password=1';
        header('Location: '.$uri);
        exit;
    }
$parola = hash(PASSWD_HASH_FUNC, $parola);


$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

$email_query = "select * from utilizatori where email='".$email."';";

$email_result = $link->query($email_query);

$name_query = "select * from utilizatori where nume='".$nume."';";

$name_result = $link->query($name_query);


if($email_result->fetch_array())
    {
        echo "Email already in use";
    }
elseif($name_result->fetch_array())
    {
        echo "Name already in use";
    }
else
    {
        $query = "insert into utilizatori (nume, email, parola) values ('".$nume."', '".$email."', '".$parola."');";

        $result = $link->query($query);

        echo 'User registered. <a href="login.php"> Log in </a>';
    }

mysqli_close($link);

?>