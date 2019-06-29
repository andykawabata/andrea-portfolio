<?php
require '../get-env.php';
session_start();



//post request - not sent from login.php - with correct password?
if(isset($_SESSION['password'])){
    if($_SESSION['password'] == $_ENV['PASSWORD']){
        //session variable already correctly set
    }
}
else if($_POST['password'] == $_ENV['PASSWORD']){
    $_SESSION["password"] = $_POST['password'];
}
else{
    header('Location: login.php');
}



include "../config/db.php";
include "head.php";
include "user-menu.php";


$query ="SELECT table_name FROM information_schema.tables WHERE table_type = 'base table' AND table_schema='pictures';"; 
$mysqli_result = mysqli_query($connect,$query );
$num_rows = mysqli_num_rows($mysqli_result);
$album_options = "";
$album_array = [];

while($row = mysqli_fetch_assoc($mysqli_result)['table_name']){
    $album_options .= "<option value='".$row."'>".$row."</option>";  
    array_push($album_array, $row);
    }
?>


<?php if(!empty($album_array)): ?>
    <div id="uploadForm">
        <h2 class="title">UPLOAD some pics!</h2>
        <div id="directions">
            <p id="chooseFile">Choose file</p>
             <p>Choose Album</p>
        </div>

   
        <form action="process.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="files[]" multiple>
            <select name="album-name" id="select">
            <option value =""></option>
            <?php echo $album_options; ?>                      
        </select>
            <input type="submit" value="upload now!">
        </form>
        <h4>20 files (at a time) max!</h4>
    </div>
<?php endif; ?>




<div id = "createAlbum">
    <h2>Create an Album!</h2>
    <p>type album name and click "create album"...*no number or special charecters! letters only!*</p>
    <form action="process-album.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="album-name" multiple>
        <input type="submit" value="create album!">
    </form>
</div>




