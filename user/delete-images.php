<?php
require "auth.php";
include "../config/db.php";
include "head.php";
include "user-menu.php";

if(!isset($_POST['paths'])){
    header("Location: manage-albums.php?album-name=".$_POST['album-name']);
}

$album_name = $_POST['album-name'];
$path_array = $_POST['paths'];

echo "<pre>";
print_r($path_array);
echo "</pre>";

$delete_err = false;
$unlink_err = false;

//delete from db
foreach($path_array as $path){
    if(mysqli_query($connect, "DELETE from ".$album_name." WHERE path = '".$path."'")){
        
    }
    else{
        $delete_err = true;
    }
}

//delete from folder
if(!$delete_err){
    foreach($path_array as $path){
        if(unlink("../".$path)){

            

        }
        else{
            echo "ERROR: one or more images not deleted from file <br>";
            $unlink_err = true;
        }
    }
}
else{
    echo "ERROR: one or more images not deleted from database";
}

if(!$unlink_err && !$delete_err){
    echo "images were deleted!";
}
?>
<h3>DO NOT REFESH THIS PAGE!</h3>