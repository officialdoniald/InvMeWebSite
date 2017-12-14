<?php
$word = $_GET["word"];
$town = $_GET["town"];

require 'labels/labels.php';

$cookie_name = "justdontforgettheusername";

$fnev = $_COOKIE[$cookie_name];
if($fnev == ""){header("Location: ../index.php");}

$conn = mysql_connect($servername, $username, $password);

mysql_select_db($dbname,$conn);

$qry = "DELETE FROM favorite_words WHERE username=N'".$fnev."' AND word=N'".$word."' AND town=N'".$town."'";

$result = mysql_query($qry,$conn);

if($result == 1)
{
    header("Location: ../search.php?delete=deleted");
}
else
{
    header("Location: ../search.php?delete=not");
}