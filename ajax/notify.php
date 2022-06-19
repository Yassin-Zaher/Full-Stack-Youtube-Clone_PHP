<?php
include_once("../includes/config.php");

if(isset($_POST["userTo"]) && isset($_POST["userFrom"])) {
    $userTo = $_POST["userTo"];
    $userFrom = $_POST["userFrom"];
    // TODO : HANDLE THE JS ERROR

    $query = $con->prepare("SELECT * FROM notifications WHERE userTo=:userTo AND userFrom=:userFrom");
    $query->bindParam(":userTo", $userTo);
    $query->bindParam("userFrom", $userFrom);
    $query->execute();

    $notification = array("isNotified" => false);

    if($query->rowCount() != 0) {
        $query = $con->prepare("DELETE FROM notifications WHERE userTo=:userTo AND userFrom=:userFrom");
        $query->bindParam(":userTo", $userTo);
        $query->bindParam(":userFrom", $userFrom);
        $query->execute();
    } else {
        //VALUES (:username, :videoId)
        $query = $con->prepare("INSERT INTO notifications(userFrom, userTo) VALUES(:userFrom, :userTo");
        $query->bindParam(":userFrom", $userFrom);
        $query->bindParam(":userTo", $userTo);
        $query->execute();
        $notification["isNotified"] = true;
    }
    echo json_encode($notification);



} else {
    echo json_encode(array("notification ajax err" => 1));
}




?>
