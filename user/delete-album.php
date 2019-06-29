<?php

require "auth.php";
include "../config/db.php";
include "head.php";
include "user-menu.php";
//delete table from database

if(isset($_POST['album-name'])){
    $current_album_name = $_POST['album-name'];
    $query = "DROP TABLE ".$current_album_name;
    if(mysqli_query($connect, $query)){
        echo "deleted table from database <br>";
    }
    else{
        echo "ERROR: database error";
    }
   
}
else{
    header('Location: login.php');
}

if(isset($_POST['path_array'])){
    foreach($_POST['path_array'] as $path){
        if(unlink("../".$path)){
            echo "photo deleted from file<br>";
        }
        else{
            echo "ERROR: unlink error <br>";
        }
    }
}




