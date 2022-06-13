<?php

class SubscriptionsProvider{
     private $con, $userLoggedInObj;

     public function __construct($con, $userLoggedInObj){
         $this->con = $con;
         $this->userLoggedInObj = $userLoggedInObj;
     }

     public function getVideo() {
         $videos = array();

         $subscriptions = $this->userLoggedInObj->getVideoSubscriptions();


         if(sizeof($subscriptions) > 0){

         }

         return $videos;
     }
}