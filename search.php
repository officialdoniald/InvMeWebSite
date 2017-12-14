<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hashtags</title>
    <link rel="icon" href="images/logo.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css_style/center.css">
    <link rel="stylesheet" type="text/css" href="css_style/elemtns_css.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
</head>

<body>
<div align="center">
    <?php
    require 'php_files/labels/labels.php';
    menubar();
    ?><br><br>
<?php
    if (isset($_GET["hashtag"]) && $_GET["hashtag"] == 'notokay') {
        echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> Something went wrong, please try it again later!
  </div></p>';
    }
if (isset($_GET["any"]) && $_GET["any"] == 'notokay') {
    echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> You must fill the entries!
  </div></p>';
}
    if (isset($_GET["hashtag"]) && $_GET["hashtag"] == 'addednotnow') {
        echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> You have already added this hashtag!
  </div></p>';
    }
    if (isset($_GET["hashtag"]) && $_GET["hashtag"] == 'okay') {
        echo '<p><div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Done!</strong> You added your hashtag successfull!
  </div></p>';
    }
    if (isset($_GET["delete"]) && $_GET["delete"] == 'deleted') {
        echo '<p><div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Done!</strong> You deleted your hashtag successfull!
  </div></p>';
    }
    if (isset($_GET["delete"]) && $_GET["delete"] == 'not') {
        echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> Something went wrong, please try it again later!
  </div></p>';
    }
$fnev = $_COOKIE["justdontforgettheusername"];
if($fnev == ""){header("Location: ./");}

echo '
        <form action="php_files/search_check.php" method="post">
            <input required type="text" name="eventname"><br>
            <label>Hashtag</label><br>
            <input type="text" name="town"><br>
            <label>Town/Online</label><br>
            <button class="buttonshadow" type="submit">Add hashtag</button><br><br>
        </form>';

$conn = mysql_connect($servername, $username, $password);

mysql_select_db($dbname,$conn);

mysql_query("SET NAMES UTF8");

$qry = "SELECT * FROM favorite_words order by word asc";

mysql_select_db($dbname,$conn);

$result = mysql_query($qry,$conn);

while($row = mysql_fetch_array($result))
{
    if($fnev == $row[0])
    {
        echo '<div style="vertical-align: middle;horiz-align: center;">
                <a style="vertical-align: middle;horiz-align: center;color:white;font-size:25px;" href="list_events.php?contains_event='.utf8_encode($row[1]).'&town='.utf8_encode($row[2]).'">#'.utf8_encode($row[1]).' '.utf8_encode($row[2]).'</a>
                &nbsp;&nbsp;
                <a style="vertical-align: middle;horiz-align: center;" title="Delete this hashtag" alt="Delete this hashtag" href="php_files/delete_search.php?word='.$row[1].'&town='.$row[2].'"><img style="vertical-align: middle;horiz-align: center;" border="0" width="25" height="25" src="images/Delete.png"></a>
                <br>
              </div>';
    }
}
?>
<?php
impress();
?>
</div>
</body>
</html>