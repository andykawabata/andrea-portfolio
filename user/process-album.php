<?php

require "auth.php";
include '../config/db.php';
include "head.php";
include 'user-menu.php';
///process requests for creating a new album



//get album name and replace any spaces with underscores
$albumName = $_POST['album-name'];
$albumNameUnderscore = str_replace(' ', '_', $_POST['album-name']);

//create new table in db

$query = "CREATE TABLE ".$albumNameUnderscore." ( id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, name VARCHAR(200), path VARCHAR(200), default_album BOOLEAN NOT NULL DEFAULT FALSE )";


if(mysqli_query($connect, $query)){
  echo "<h1>album was created!</h1>";
}
else
echo "album was not created <br>";



?>
<h3>DO NOT REFESH THIS PAGE!</h3>