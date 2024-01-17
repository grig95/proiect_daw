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

        <!-- Go home button -->
        <section>
        <?php
        echo "<a href='".getCurrentParentURI()."/user.php'>Home</a>";
        ?>
        </section>


        <h3>Sell Something!</h3>
        <form method="POST" action="user_sell_q.php">
            <table>
            <tr>
            <td> Bun: </td>
            <td>    <input type="text" name="bun">   </td>
            </tr>
            <tr>
            <td> Pret: </td>
            <td>    <input type="number" name="pret">   </td>
            </tr>
            <tr>
            <td> <input type='submit' value='Submit'> </td>
            </tr>
            </table>
        </form>
    </body>
</html>