<html>
    <title>MGOS Admin Page</title>
    <body>
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
        ?>

        <section>
        <?php
        echo 'Logged in as admin '.$userInfo['nume'].'.';
        ?>
        </section>

        <section>
        <?php
        echo "<a href='".getCurrentParentURI()."/logout_q.php'>Log out</a>";
        ?>
        </section>

        <section>
            <b>You are an ADMIN! </b> Your job is to delete the accounts of nasty nasty users! Just enter their email address and they're <b>TOAST!</b>
            <form method='POST' action='admin_toast_q.php'>
                <input type='email' name='email'>
                <input type='submit' value='TOAST THEM!'>
            </form>
        </section>
    </body>
</html>