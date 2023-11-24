<?php

$link = mysqli_connect("localhost", "onlineshop", "onlinesho", "onlineshop");

$query = "select * from utilizatori where email='".$_POST['email']."' and parola='".$_POST['parola']."';";

$result = $link->query($query);

$row = $result->fetch_array();
if($row)
    {
        echo "Logged in as ".$row["nume"];
    }
else
    {
        echo "Access denied";
    }

mysqli_close($link);

?>