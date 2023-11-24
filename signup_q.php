<?php

$link = mysqli_connect("localhost", "onlineshop", "onlinesho", "onlineshop");

$email_query = "select * from utilizatori where email='".$_POST['email']."';";

$email_result = $link->query($email_query);

$name_query = "select * from utilizatori where nume='".$_POST['nume']."';";

$name_result = $link->query($name_query);


if($email_result->fetch_array())
    {
        echo "Email already in use";
    }
elseif($name_result->fetch_array())
    {
        echo "Name already in use";
    }
else
    {
        $query = "insert into utilizatori (nume, email, parola) values ('".$_POST["nume"]."', '".$_POST["email"]."', '".$_POST["parola"]."');";

        $result = $link->query($query);

        echo 'User registered. <a href="login.php"> Log in </a>';
    }

mysqli_close($link);

?>