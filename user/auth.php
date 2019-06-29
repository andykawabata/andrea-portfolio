<?php
require '../get-env.php';
session_start();

if($_SESSION['password'] == $_ENV['PASSWORD'])
{

}
else{
    header('Location: login.php');
}

