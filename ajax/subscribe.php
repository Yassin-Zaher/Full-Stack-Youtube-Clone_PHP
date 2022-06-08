<?php
require_once("../includes/config.php");

if(isset($_POST['userTo'])  && isset($_POST['userFrom'])){
   echo "good :)";
} else {
    echo "one or more parameters not passed in to subscribe.php";
}


?>