<?php 
require_once 'constants.php';
require_once 'utility.php';

// Redirect in case no cookie is passed
if(!isset($_COOKIE['sessionid']))
    {
        $parentURI = getCurrentParentURI();
        header('Location: '.$parentURI.'/admin_login.php');
        exit;
    }
        
$userInfo = getUserInfoForSession($_COOKIE['sessionid']);
// Redirect in case of invalid user
if(!$userInfo)
    {
        $parentURI = getCurrentParentURI();
        header('Location: '.$parentURI.'/admin_login.php');
        exit;
    }
        
// Redirect in case of non-admin user
if(!isUserAdmin($userInfo['id']))
    {
        $parentURI = getCurrentParentURI();
        header('Location: '.$parentURI.'/admin_login.php');
        exit;
    }


$email = sanitizeSQLInput($_POST['email']);

$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

$query = "select * from utilizatori where email='".$email."';";

$result = $link->query($query)->fetch_array();

if($result)
    {
        $id=$result['id'];
        $query = "select * from admini where id=".$id.";";
        
        $result = $link->query($query)->fetch_array();
        if(!$result) //not an admin
            {
                //delete
                $query = "delete from utilizatori where id=".$id.";";
                $link->query($query);
                echo "The plug is in the socket and electricity is running, the metal's hot and the molecules are popping! Fried'em good! Here's your <b>toast</b>. Keep at it, champ!";
            }
        else //an admin
            {
                echo "<b>Woah, woah, woah,</b> hang on a minute, this guy's an admin! An admin can't delete another admin, that's like a toaster toasting another toaster! You need a <b>blowtorch</b> for that!";
            }
    }
else
    {
        echo "Sorry man, looks like we couldn't find your guy. Must be some new kind of <b>incognito bread...</b>";
    }



mysqli_close($link);
?>