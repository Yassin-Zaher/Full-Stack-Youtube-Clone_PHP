<?php
require_once("../includes/config.php");

if(isset($_POST['userTo'])  && isset($_POST['userFrom'])){
    $userTo = $_POST['userTo'];
    $userFrom = $_POST['userFrom'];
   //TODO :CHECK IF THE USER IS SUBSCRIBED
    $query = $con->prepare("SELECT * FROM subscribers WHERE userTo=:userTo AND userFrom=:userFrom");
    $query->bindParam(":userTo", $userTo);
    $query->bindParam(":userFrom", $userFrom);
    $query->execute();

    if($query->rowCount() == 0){
        //TODO : ADD AS NEW SUBSCRIBER
        //INSERT INTO likes(username, videoId) VALUES (:username, :videoId)
        $query = $con->prepare("INSERT INTO subscribers(userTo, userFrom) VALUES (:userTo, :userFrom)");
        $query->bindParam(":userTo", $userTo);
        $query->bindParam(":userFrom", $userFrom);
        $query->execute();

    } else {
        //TODO : REMOVE THE SUBSCRIBE note: the user here is already subscribed and his action is removing the like
        $query = $con->prepare("DELETE FROM subscribers WHERE userTo=:userTo AND userFrom=:userFrom");
        $query->bindParam(":userTo", $userTo);
        $query->bindParam(":userFrom", $userFrom);
        $query->execute();

    }

    // return the number of subscribers in the table
    $query = $con->prepare("SELECT * FROM subscribers WHERE userTo=:userTo");
    $query->bindParam(":userTo", $userTo);
    $query->execute();

    $subscribers = array("count" => $query->rowCount());
    echo json_encode($subscribers);



} else {
    echo "one or more parameters not passed in to subscribe.php";
}


?>