<?php

class VideoItem{
     private $con, $userLoggedIn;
     public function __construct($con, $userLoggedIn){
         $this->con = $con;
         $this->userLoggedIn = $userLoggedIn;
     }

     public function create(){

     }
}