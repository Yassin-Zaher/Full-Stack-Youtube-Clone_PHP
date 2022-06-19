<?php

if(isset($_POST["userTo"]) && isset($_POST["userFrom"])) {
    $userTo = $_POST["userTo"];
    $userFrom = $_POST["userFrom"];

    $notification = array("userFrom" => $userFrom,
                          "userTo" => $userTo);

    echo json_encode($notification);

}




?>
