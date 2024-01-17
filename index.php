<html>
    <title> MGOS </title>
    <body>

    <?php
    require_once 'constants.php';
    $link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    $query = "select count(*) c from tranzactii;";
    $transactionCount = $link->query($query)->fetch_array()['c'];
    mysqli_close($link);
    ?>

    <h3>Bun venit la <b>MGOS,</b> cel mai bun site old-school de shopping online, prin care s-au efectuat deja <?php echo $transactionCount; ?> tranzactii!</h3>

    <table>
        <tr>
            <td><a href="login.php">Login</a></td>
        </tr>
        <tr>
            <td><a href="signup.php">Sign up</a></td>
        </tr>
        <tr>
            <td><a href="admin_login.php">Admin login</a></td>
        </tr>
    </table>
    </body>
</html>