<?php
require_once("includes/header.php");
require_once("includes/classes/VideoPlayer.php");
require_once("includes/classes/VideosDetailsFormProvider.php");
require_once("includes/classes/VideoUploadData.php");

if(!UserInfo::isLoggedIn()) {
    header("Location: signin.php");
}

if(!isset($_GET["videoId"])){
    echo "No videos Selected";
    exit();
}

$video = new Video($con, $_GET["videoId"], $user);
if($video->getVideoUploadedBy() != $user->getUserName()){
    echo "Not you videos :(";
    exit();
}


?>