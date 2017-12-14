<?php
$file = addslashes($_FILES['file']['tmp_name']);
$file = file_get_contents($file);
$file = base64_encode($file);
echo "asd";
?>