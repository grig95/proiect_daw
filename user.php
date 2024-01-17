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
        
        <!-- Log out button -->
        <section>
        <?php
        echo "<a href='".getCurrentParentURI()."/logout_q.php'>Log out</a>";
        ?>
        </section>
        
        <!-- Shop button -->
        <section>
        <?php
        echo "<a href='".getCurrentParentURI()."/user_buy.php'>Start shopping</a>";
        ?>
        </section>

        <!-- Sell button -->
        <section>
        <?php
        echo "<a href='".getCurrentParentURI()."/user_sell.php'>Sell</a>";
        ?>
        </section>

        <!-- Sales history button -->
        <section>
        <?php
        echo "<a href='".getCurrentParentURI()."/user_sales_history.php'>Sales history</a>";
        ?>
        </section>

        <!-- Change password button -->
        <section>
        <?php
        echo "<a href='".getCurrentParentURI()."/user_change_password.php'>Change password</a>";
        ?>
        </section>
    </body>
</html>