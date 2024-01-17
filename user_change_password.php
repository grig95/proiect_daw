<html>
    <title>MGOS User Page</title>
    <body>
        <?php 
        require_once 'constants.php';
        require_once 'utility.php';

        // Redirect in case no cookie is passed
        if(!isset($_COOKIE['sessionid']))
            {
                require_once 'utility.php';
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
        ?>

        <section>
        <?php
        echo 'Logged in as '.$userInfo['nume'].'.';
        ?>
        </section>
        
        <section>
        <form method="POST" action="user_change_password_q.php">
        <table>
        <tr>
        <td> Parola curenta: </td>
        <td>    <input type="password" name="parola_curenta">   </td>
        </tr>
        <tr>
        <td> Parola noua: </td>
        <td>    <input type="password" name="parola_noua">   </td>
        </tr>
        <tr>
        <td> <input type='submit' value='Submit'> </td>
        </tr>
        </table>
    </form>
        </section>
    </body>
</html>