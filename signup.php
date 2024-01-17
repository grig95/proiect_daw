<html>
    <title> MGOS Signup </title>
    <body>
    <form method="POST" action="signup_q.php">
        <table>
        <tr>
        <td> Nume de utilizator: </td>
        <td>    <input type="text" name="nume">   </td>
        </tr>
        <tr>
        <td> Email: </td>
        <td>    <input type="email" name="email">   </td>
        </tr>
        <tr>
        <td> Parola: </td>
        <td>    <input type="password" name="parola">   </td>
        </tr>
        <tr>
        <td> <input type='submit' value='Submit'> </td>
        </tr>
        </table>
    </form>

    <!-- Invalid password/username message -->
    <?php
    require_once 'constants.php';
    if(isset($_GET['invalid_password']))
        echo 'Invalid password! Characters '.SQL_UNSAFE_CHARS.' are not allowed!';
    if(isset($_GET['invalid_username']))
        echo 'Invalid username! Characters '.SQL_UNSAFE_CHARS.' are not allowed!';
    ?>

    <!-- Log in redirect: -->
    <?php
    require_once 'utility.php';
    $uri = getCurrentParentURI().'/login.php';
    echo "<a href='".$uri."'>Log in</a>";
    ?>
    </body>
</html>