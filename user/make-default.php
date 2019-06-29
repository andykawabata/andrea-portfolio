<?php 

include "auth.php";
include "head.php";
include "user-menu.php";
include "../config/db.php";

$all_tables = $_POST['album-array'];


if(empty($_POST['album-name'])){

    header("Location: manage-albums.php");
}
else if( strpos($_POST['album-name'], '_default') !== false){

    header("Location: manage-albums.php");
}
else{

    //check if theres currently a default album
    $current_default;
    $default_removed;
    foreach($all_tables as $table){
        $current_name = $table;
        if (strpos($current_name, '_default') !== false){
            $current_default = $current_name;
            $default_removed = str_replace("_default","",$current_default);
            break;
        }
    }
    //if theres currently a default, rename it

    if(!empty($current_default)){
        
        $query = "RENAME TABLE ".$current_default." TO ".$default_removed;
        $mysqli_result = mysqli_query($connect, $query);

        if($mysqli_result){
            echo "previous default unset <br>";
        }
        else{
            echo "ERROR: previous default not unset! <br>";
        }
    }




    $album_name = $_POST['album-name'];
    $new_name = $album_name."_default";
    $query = "RENAME TABLE ".$album_name." TO ".$new_name;
    $mysqli_result = mysqli_query($connect, $query);

    if($mysqli_result){
        echo "new default set";
    }
    else{
        echo "ERROR: album not default!";
    }

}