<?php
require_once("../includes/config.php");
require_once("../includes/classes/UserInfo.php");

$videoId = $_GET["id"];
$username = $_SESSION["userLoggedIn"];
$user = new UserInfo($con, $username);

if(isset($_POST['postedBy'])  && isset($_POST['comment'])){

    $postedBy = $_POST['postedBy'];
    $body = $_POST['comment'];
    $responseTo = "//TODO";

    $query = $con->prepare("INSERT INTO comments postedBy=:postedBy body=:body responseTo=:responseTo");
    $query->bindParam(":postedBy", $postedBy);
    $query->bindParam(":body", $body);
    $query->execute();

}


?>