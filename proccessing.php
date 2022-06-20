<?php
require_once("includes/header.php");
require_once("includes/classes/VideoUploadData.php");
include_once("includes/classes/VideoProcessor.php");

if(!isset($_POST["uploadButton"])){
    echo "nothing send to this page";
    exit();
}


$videoUploadData = new VideoUploadData(
                                $_FILES["fileInput"],
                                $_POST["titleInput"],
                                $_POST["descriptionInput"],
                                $_POST["privacyInput"],
                                $_POST["categoryInput"],
                                $user->getUserName()

);


$videoProcessor = new VideoProcessor($con);
$wasUploaded = $videoProcessor-> upload($videoUploadData)




?>
