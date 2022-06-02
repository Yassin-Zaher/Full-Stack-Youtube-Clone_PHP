<?php
require_once("../includes/config.php");
require_once("../includes/classes/Video.php");
require_once("../includes/classes/UserInfo.php");

$videoId = $_POST["videoId"];
$username = $_SESSION["userLoggedIn"];
$user = new UserInfo($con, $username);
$video = new Video($con, $videoId, $user);

echo $video->like();


?>