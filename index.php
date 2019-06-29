<?php
require 'initialize.php';
include 'config/db.php';

//get array of of paths from the DEFAULT table
$query = "SELECT path FROM ".$default_album_name."";
$mysqli_result = mysqli_query($connect, $query);
$all_paths = mysqli_fetch_all($mysqli_result);
$path_array = [];
foreach ($all_paths as $path){
    array_push($path_array, $path[0]);
}

require 'templates/top.php';
require 'templates/album-template.php';
require 'templates/bottom.php';


?>
 


