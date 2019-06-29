<?php
session_start();
if(isset($_SESSION['password'])){
   
    echo "you are logged in! <br>";
  
    include "user-menu.php";
}

else{
    

    echo "whats the password???";
    echo "<br>";

    echo '<form action="upload.php" method="POST">
        <input type="text" name="password">
        <input type="submit" value="submit!">  
    </form>';
}