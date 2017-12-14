<!DOCTYPE html>
<html>
    <head>
        <title>Inv me! forgot password page</title>
        <meta charset="UTF-8">
        <link rel="icon" href="images/logo.jpg">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css_style/center.css">
        <link rel="stylesheet" type="text/css" href="css_style/elemtns_css.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
    <div align="center">
        <?php
        if (isset($_GET["wrongemail"]) && $_GET["wrongemail"] == 'wrong') {
            echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> There is no such e-mail in the database!
  </div></p>';
        }
        if (isset($_GET["errorwiththedatabase"]) && $_GET["errorwiththedatabase"] == 'failed') {
            echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> Something went wrong, please check back soon!
  </div></p>';
        }
        ?>
        <form action="php_files/forgot.php" method="post">
        <br><br><input type="text" name="email"><br><label>Your E-Mail</label><br>
        <button class="buttonshadow" type="submit">Send E-Mail</button>
        </form>
        <br><br>
        <div class="footer"><a style="color:white;" href="impress2.html">Impress</a></div>
    </body>
</html>