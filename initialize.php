<?php
//called by index.php and album.php

include 'config/db.php';

$query ="SELECT table_name FROM information_schema.tables WHERE table_type = 'base table' AND table_schema='pictures';";
$mysqli_result = mysqli_query($connect, $query);
$all_tables = mysqli_fetch_all($mysqli_result, MYSQLI_ASSOC);


$album_names_underscore = [];
$default_album_name = "";
$has_default = true;

//convert mysqli_result object to array of table names
//find default ablum name and its index
$index= 0;
$index_default = 0;
foreach($all_tables as $table){

    $current_name = $table['table_name'];
    if (strpos($current_name, '_default') !== false) {
        $default_album_name = $current_name;
        $index_default = $index;
    }
    array_push($album_names_underscore, $current_name);
    $index++;
}

//if no album is marked default, use first album in array
if($default_album_name == ""){
    $default_album_name = $all_tables[0]['table_name'];
    $has_default = false;
}

//make sure default album is first name in array 
if($index_default !== 0){
    $tmp = $album_names_underscore[$index_default];
    for($i = $index_default; $i > 0; $i--){
        $album_names_underscore[$i] = $album_names_underscore[$i-1];
    }
    $album_names_underscore[0]= $tmp;
}
//album_names_underscore = array with underscores and _default



//function to remove underscores from array of strings
function remove_underscores($album_array){
    $clean = [];
    foreach($album_array as $album){
        $clean_album = str_replace('_',' ', $album);
        array_push($clean, $clean_album);
    }
    return $clean;
}


//remove '_default', then remove underscores
if($has_default){
    $album_names_underscore[0] = rtrim($default_album_name,' default');
}

$album_names_clean = remove_underscores($album_names_underscore);

