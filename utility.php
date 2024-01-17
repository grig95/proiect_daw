<?php


function getCurrentParentURI()
{
    $uri = '';
    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];
    $uri .= $_SERVER['REQUEST_URI'];
    $i = strlen($uri)-1;
    while($uri[$i]!='/')
        $i--;
    $uri = substr($uri, 0, $i);
    return $uri;
}

///gets all user data
function getUserInfoForSession($sessionID)
{
    //check the sessionID for SQLInjection attempt
    if($sessionID != sanitizeSQLInput($sessionID))
        return null;

    require_once 'constants.php';

    $link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    ///get session info only if it's still valid
    $sessionQuery = "select * from sesiuni where id='".$sessionID."' and expirare>now();";

    $sessionResult = $link->query($sessionQuery)->fetch_array();

    if(!$sessionResult)
        return null;
    
    $userQuery = "select * from utilizatori where id=".$sessionResult['id_utilizator'].";";

    $userResult = $link->query($userQuery)->fetch_array();

    mysqli_close($link);

    if(!$userResult)
        return null;
    return $userResult;
}

function isUserAdmin($userID)
{
    //check the userID for SQLInjection attempt (although this function should not be used with direct user input)
    if(is_string($userID))
        {
            if($userID != sanitizeSQLInput($userID))
                return false;
        }
    
    require_once 'constants.php';

    $link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    $query = "select * from admini where id=".$userID.";";

    $result = $link->query($query)->fetch_array();

    mysqli_close($link);

    if(!$result)
        return false;
    return true;
}

function generateRandomString($length, $charset='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMONPQRSTUVWXYZ1234567890')
{
    $str='';
    for($i=0;$i<$length;$i++)
        $str.=$charset[random_int(0, strlen($charset)-1)];
    return $str;
}


function sanitizeSQLInput($string)
{
    require_once 'constants.php';

    for($i=0;$i<strlen(SQL_UNSAFE_CHARS);$i++)
        $string = str_replace(SQL_UNSAFE_CHARS[$i], '', $string);
    return $string;
}


function terminateSession($sessionID)
{
    //check the sessionID for SQLInjection attempt
    if($sessionID != sanitizeSQLInput($sessionID))
        return;

    require_once 'constants.php';

    $link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    $query = "delete from sesiuni where id='".$sessionID."';";

    $link->query($query);

    mysqli_close($link);
}
?>