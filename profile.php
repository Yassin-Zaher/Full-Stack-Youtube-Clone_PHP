<?php
include_once("includes/header.php");
include_once("includes/classes/ProfileGenerator.php");

if(isset($_GET["username"])){
    $profileUsername = $_GET["username"];
}else {
    echo "sign up or login in please :(";
}
$profileGenerator = new ProfileGenerator($con, $user, $profileUsername);
echo $profileGenerator->create();

