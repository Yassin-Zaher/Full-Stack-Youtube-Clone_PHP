<?php

class Video{

    public $con, $sqlData, $userLoggedInObj;
    public function __construct($con, $input, $userLoggedInObj) {
        $this->con = $con;

       $this->userLoggedInObj = $userLoggedInObj;

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

    public function IncrementView() {

        $query = $this->con->prepare("UPDATE videos SET views=views+1 WHERE id=:id");
        $query->bindParam("id", $videoId);
        $videoId = $this->getVideoId();
        $query->execute();

        $this->sqlData["views"] = $this->sqlData["views"] + 1;
    }

    public function getVideoLikes(){
        $query = $this->con->prepare("SELECT count(*) as 'count' FROM likes WHERE videoId= :videoId");
        $query->bindParam("videoId", $videoId);
        $videoId = $this->getVideoId();
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data["count"];
    }

    public function like(){
        $id = $this->getVideoId();
        $username = $this->userLoggedInObj->getUserName();
        $query = $this->con->prepare("SELECT * FROM likes WHERE username=:username AND id=:id");
        $query->bindParam("username", $username);
        $query->bindParam("id", $id);
        $query->execute();

        if($query->rowCount() > 0){
            // already like the video
            echo "liked";
        }else {
            $query = $this->con->prepare("INSERT INTO likes(username, videoId) VALUES (:username, :videoId)");
            $query->bindParam("username", $username);
            $query->bindParam("id", $id);
            $query->execute();
        }


    }


}