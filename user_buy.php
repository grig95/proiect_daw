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


        <h3>Buy Something!</h3>
        <section>
        <?php
        $link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        
        $query = "select o.*, u.nume vanzator from oferte o join utilizatori u on o.id_vanzator=u.id where o.cod_terminare=0;";

        $result = $link->query($query);
        $row = $result->fetch_array();

        if(!$row)
            echo "Nimic la vanzare momentan!";
        else
        {
            echo "<table>";
            echo "<tr>";
            echo "<th>Bun</th>";
            echo "<th>Vanzator</th>";
            echo "<th>Pret</th>";
            echo "<th></th>"; //buton sau chestie de cumparat
            echo "</tr>";

            do
            {
                echo "<tr>";

                echo "<td>".$row['bun']."</td>";
                echo "<td>".$row['vanzator']."</td>";
                echo "<td>".$row['pret']."</td>";

                //buy button
                echo '<td><form method="POST" action="user_buy_q.php">';
                echo "<button name='id_oferta' value=".$row['id'].">Cumpara</button>";
                echo "</form></td>";

                echo "</tr>";

                $row = $result->fetch_array();
            } while($row);

            echo "</table>";
        }
        

        mysqli_close($link);

        ?>
        </section>
    </body>
</html>