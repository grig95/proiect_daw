<?php

$link = mysqli_connect("localhost", "onlineshop", "onlinesho", "onlineshop");

$query = "select * from utilizatori where email='".$_POST['email']."' and parola='".$_POST['parola']."';";

$result = $link->query($query);

$row = $result->fetch_array();
if($row)
    {
        $query="select * from admini where id='".$row["id"]."';";
        $result= $link->query($query);
        if($result->fetch_array())
            {
                echo "Logged in as Admin";
            }
        else
            {
                echo "Admin login denied";
            }
    }
else
    {
        echo "Admin login denied";
    }

mysqli_close($link);

?>