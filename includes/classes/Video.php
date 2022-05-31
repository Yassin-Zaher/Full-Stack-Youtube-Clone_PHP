<?php

class Video{

    public $con, $sqlData;
    public function __construct($con, $input, $userLoggedInObj) {
        $this->con = $con;

       $this->$userLoggedInObj = $userLoggedInObj;

       // check if the input is sql data or an id // TODO
       if(is_array($input)){
           //means that the input that got passed to video constructor
           //is sql data we should keep it
           $this->sqlData = $input;
       } else {
           // it means that we recived an id and we should
           // get the data from the data base
           $query = $this->con->prepare("SELECT * FROM videos WHERE id=:id");
           $query->bindParam(":id", $input);
           $query->execute();


           //converting the returned values from the databse
           // into an object
           $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
       }

    }

    public function getVideoId(){
        return $this->sqlData["id"];
    }

    public function getVideoTitle(){
        return $this->sqlData["title"];
    }

    public function getVideoPath(){
        return $this->sqlData["filePath"];
    }

    public function getVideoUploadedBy(){
        return $this->sqlData["uploadedBy"];
    }

    public function getVideoPrivacy(){
        return $this->sqlData["privacy"];
    }

    public function getVideoCategory(){
        return $this->sqlData["category"];
    }

    public function getVideoViews(){
        return $this->sqlData["views"];
    }

    public function getVideoDuration(){
        return $this->sqlData["duration"];
    }

    public function getVideoDescription(){
        return $this->sqlData["description"];
    }


}