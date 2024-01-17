<?php

require_once 'utility.php';
require_once 'constants.php';

$email = sanitizeSQLInput($_POST['email']);
$parola = hash(PASSWD_HASH_FUNC, sanitizeSQLInput($_POST['parola']));


$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

$query = "select * from utilizatori where email='".$email."' and parola='".$parola."';";

$result = $link->query($query);

$row = $result->fetch_array();
if($row)
    {
        //generate new session
        $sessionID = generateRandomString(SESSIONID_LENGTH);
        $checkCollisionQuery = "select * from sesiuni where id='".$sessionID."';";
        $checkResult = $link->query($checkCollisionQuery)->fetch_array();
        while($checkResult)
        {
            $sessionID = generateRandomString(SESSIONID_LENGTH);
            $checkCollisionQuery = "select * from sesiuni where id='".$sessionID."';";
            $checkResult = $link->query($checkCollisionQuery)->fetch_array();
        }
        $createSessionQuery = "insert into sesiuni (id, id_utilizator) values ('".$sessionID."', ".$row['id'].");";
        $link->query($createSessionQuery);

        setcookie('sessionid', $sessionID, time()+SESSIONID_VALIDITY_TIME_SECONDS);
        mysqli_close($link);
        $userPageURI = getCurrentParentURI().'/user.php';
        header('Location: '.$userPageURI);
        exit;
    }
else
    {
        echo "Access denied";
    }

mysqli_close($link);

?>