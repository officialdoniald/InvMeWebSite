<?php
$eventname = $_POST["eventname"];
$town = $_POST["town"];

require 'labels/labels.php';

$cookie_name = "justdontforgettheusername";
if($eventname == "" || $town == ""){
    header("Location: ../search.php?any=notokay");
    exit;
}
if(isset($_COOKIE[$cookie_name]))
{
    $fnev = $_COOKIE[$cookie_name];
    if($fnev == ""){header("Location: ../index.php");}
    $conn = mysql_connect($servername, $username, $password);

    mysql_select_db($dbname,$conn);

    mysql_query("SET NAMES UTF8");

    $qry = "SELECT * FROM favorite_words";

    $result = mysql_query($qry,$conn);

    while($row = mysql_fetch_array($result))
    {
        if($fnev == $row[0] && $eventname == $row[1] && $town == $row[2])
        {
            header("Location: ../search.php?hashtag=addednotnow");
            exit;
        }
    }

    $sql = "INSERT INTO `favorite_words` (username, word, town) VALUES (N'".$fnev."', N'".$eventname."', N'".$town."')";

    if (mysql_query($sql,$conn)== TRUE) {
        mysql_close($conn);
        header("Location: ../search.php?hashtag=okay");
        exit;
    } else {
        header("Location: ../search.php?hashtag=notokay");
        exit;
    }
}
else{
    header("Location: ../index.php");
    exit;
}
