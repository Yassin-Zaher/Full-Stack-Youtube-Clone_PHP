<?php

ob_start(); // turns on output buffering

date_default_timezone_set("Africa/Casablanca");

try {
          $con = new PDO("mysql:dbname=VideoTube;host=localhost", "root", "");
          $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
          echo "Connetion Failed" . $e->getMessage();
}
?>