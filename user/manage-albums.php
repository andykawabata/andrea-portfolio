<?php

require "auth.php";
include "../config/db.php";
include "head.php";
include "user-menu.php";

// get names of albums and put them into select list as string
$query ="SELECT table_name FROM information_schema.tables WHERE table_type = 'base table' AND table_schema='pictures';"; 
$mysqli_result = mysqli_query($connect,$query );
$num_rows = mysqli_num_rows($mysqli_result);
$album_options = "";
$album_exists = true;
$album_array =[];
while($row = mysqli_fetch_assoc($mysqli_result)['table_name']){ 
    $album_options .= "<option value='".$row."'>".$row."</option>";
    array_push($album_array, $row);
}



//get array of paths in for selected album
if(isset($_GET['album-name'])){
    $current_album_name = $_GET['album-name'];
    $query = "SELECT path FROM ".$current_album_name."";
    $mysqli_result = mysqli_query($connect, $query);
}
//mysqli_result = true if table exisits
if($mysqli_result){
    $all_paths = mysqli_fetch_all($mysqli_result);
    $path_array = [];
    foreach ($all_paths as $path){
        array_push($path_array, $path[0]);
    }
}
else{
    $album_exists = false;
}


?>
<!-- select album to view/edit -->

<form action="" method="get">
    <select name="album-name" id="select">
    <option value="">
    <?php echo $album_options; ?>                      
</select>
    <input type="submit" value="select album">
</form>


<?php if($album_exists && isset($_GET['album-name'])): ?>
    <h1> <?php echo $_GET['album-name']; ?> </h1>

    <!-- make default-->
    <form action="make-default.php" method="POST">
        <input type="hidden" name="album-name" value="<?php echo $current_album_name; ?>">
        <?php foreach($album_array as $album): ?> 
                <input type="hidden" name="album-array[]" value="<?php echo $album ?>">
        <?php endforeach; ?> 
        <input type="submit" value="set album as default">
    </form>

    <!-- delete selected pics -->
    <?php if (isset($path_array)) {?>
        <form action="delete-images.php" method="POST">
            <?php foreach($path_array as $array): ?>
            <div class="container">
                <img src="<?php echo "../".$array ?>" style=" max-width: 200px; max-height: 200px;">
                <input type="checkbox" name="paths[]" value="<?php echo $array ?>">
                
            </div>
            <?php endforeach; ?>
            <input name="album-name" style="display: none;" value="<?php echo $current_album_name ?>">
            <input type="submit" value="delete selected pictures">
        </form>
    <?php } ?>


    <!-- delete entire album -->
    <?php if (isset($_GET['album-name'])): ?>
        <form action="delete-album.php" method="POST" >
            <input type="hidden" name="album-name" value="<?php echo $current_album_name; ?>">
            <?php foreach($path_array as $path): ?> 
                <input type="hidden" name="path_array[]" value="<?php echo $path ?>">
            <?php endforeach; ?>    
            <input type="submit" value="delete entire album">
        </form>
    <?php endif; ?>
<?php endif; ?>