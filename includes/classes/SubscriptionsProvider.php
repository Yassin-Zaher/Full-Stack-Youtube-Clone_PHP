<?php

class SubscriptionsProvider{
     private $con, $userLoggedInObj;

     public function __construct($con, $userLoggedInObj){
         $this->con = $con;
         $this->userLoggedInObj = $userLoggedInObj;
     }

     public function getVideo() {
         $videos = array();

         //this is an array of objects containing the user
         $subscriptions = $this->userLoggedInObj->getVideoSubscriptions();


         if(sizeof($subscriptions) > 0) {
             $condition = "";
             $i = 0;

             while ($i < sizeof($subscriptions)) {

                 if($i == 0){
                     $condition .= "WHERE uploadedBy=?";
                 }else {
                     $condition .= " OR uploadedBy=?";
                 }
                 $i++;

             }
             $queryString = "SELECT * FROM videos $condition ORDER BY uploadDate DESC";
             $videoQuery = $this->con->prepare($queryString);

             $i = 1;
             foreach($subscriptions as $sub) {
                 $subUserName = $sub->getUserName();
                  $videoQuery->bindParam($i, $subUserName);
                  $i++;
             }

             $videoQuery->execute();
             while ($row = $videoQuery->fetch(PDO::FETCH_ASSOC)){
                 $video = new Video($this->con, $row, $this->userLoggedInObj);
                 array_push($videos, $video);
             }
             return $videos;
         }

         return $videos;
     }
}