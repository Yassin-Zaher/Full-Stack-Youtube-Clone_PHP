<?php
require_once("../includes/config.php");
require_once("../includes/classes/Video.php");
require_once("../includes/classes/UserInfo.php");

$username = $_SESSION["userLoggedIn"];
$videoId = $_POST["videoId"];

if(!isset($_SESSION["userLoggedIn"])){
    $result = array("userLoggedIn" => "false");
    echo json_encode($result);
    exit();
}

$userLoggedInObj = new UserInfo($con, $username);
$video = new Video($con, $videoId, $userLoggedInObj);

echo $video->disLike();

?>