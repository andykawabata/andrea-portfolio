<?php

/////processes images being uploaded from upload.php

require "auth.php";
include "head.php";
include "user-menu.php";
include "../config/db.php";

if(empty($_POST['album-name']) or empty($_FILES['files']['name'][0])){
  header("Location: upload.php");
}
else{
$albumName = $_POST['album-name'];
$albumNameUnderscore = str_replace(' ', '_', $_POST['album-name']);




//declare variables
$indexes_with_ext_error = array();
$indexes_with_php_error = array();
$i = 0;
$ext_error = false;
$query = "INSERT INTO ".$albumNameUnderscore." (name, path) VALUES ('pic','/path')";
$names_array = $_FILES['files']['name'];
$errors_array = $_FILES['files']['error'];
$indexes_with_php_error_and_code = [];
$tmp_name_array = $_FILES['files']['tmp_name'];
$extentions = array('jpg','jpeg','gif','png');
$existing_names_array = scandir("../img/");
$duplicate = false;
$duplicate_name;

foreach($names_array as $new_name){
    foreach($existing_names_array as $existing_name){
        if($new_name == $existing_name){
            $duplicate = true;
            $duplicate_name = $new_name;
            break;
        }
    }
}

//check for php and ext errors
    for($i = 0; $i < count($names_array); $i++){
        //isolate file extention 
        $exploded_array = explode('.', $names_array[$i] );
        $file_extention = end($exploded_array);
        //if file ext doesn't match array, add index to $indexes_with_ext_error
        if(!in_array($file_extention, $extentions)){
            array_push($indexes_with_ext_error, $i);
        }
        //if theres a php error, put the index and code in associative array: $indexes_with_php_error_and_code
        if($errors_array[$i]){
            array_push($indexes_with_php_error_and_code, array('index'=> $i,'code'=> $errors_array[$i]));
        }
    }



    function create_query($pic, $path, $album){
        return "INSERT INTO ".$album." (name, path) VALUES ('".$pic . "','" . $path . "')";
    }

    //if there are any ext error, set ext_err to true
    if(!empty($indexes_with_ext_error)){
        $ext_error = true;
    }

    function add_pre($array){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
    

   

    //upload if no errors
    if($duplicate){
        echo "a file by the name ".$duplicate_name." has already been uploaded<br>";
        echo "none of you files where upload <br>";
        echo "make sure all file names are unique<br>";
    }
    else if(!empty($indexes_with_php_error_and_code)){

        echo "php error";
    }
    else if($ext_error){
        echo "invalid extention";
    }
    
    else{
        for($i = 0; $i < count($names_array); $i++){

            
            //MAKE IMAGE PATH VARIABLE
            if(move_uploaded_file($tmp_name_array[$i], "../img/".$names_array[$i]) &&
                mysqli_query($connect, create_query($names_array[$i], "img/".$names_array[$i], $albumNameUnderscore))){
            
                echo "<h4>upload success!</h4>";
            }
            else{
                echo "upload failed"."<br>";;
            }
        }
    }
}
   

?>

<br>
<h3>DO NOT REFESH THIS PAGE!</h3>

