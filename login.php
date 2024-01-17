<html>
    <title> MGOS Login </title>
    <body>
    <form method="POST" action="login_q.php">
        <table>
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
    
    <!-- Sign up redirect: -->
    <?php
    require_once 'utility.php';
    $uri = getCurrentParentURI().'/signup.php';
    echo "<a href='".$uri."'>Sign up</a>";
    ?>

    </body>
</html>