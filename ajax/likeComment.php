<?php
require_once("../includes/config.php");
require_once("../includes/classes/Comment.php");
require_once("../includes/classes/UserInfo.php");

$videoId = $_POST["videoId"];
$username = $_SESSION["userLoggedIn"];
$commentId = $_POST["commentId"];

$userLoggedInObj = new UserInfo($con, $username);
$comment = new Comment($con, $commentId, $userLoggedInObj, $videoId);

echo $comment->like();


?>