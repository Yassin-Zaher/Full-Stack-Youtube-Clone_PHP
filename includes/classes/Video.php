<?php

class Video{

    public $con, $sqlData, $userLoggedInObj;
    public function __construct($con, $videoId, $userLoggedInObj) {
        $this->con = $con;

       $this->userLoggedInObj = $userLoggedInObj;

       // check if the input is sql data or an id // TODO
       if(is_array($videoId)){
           //means that the input that got passed to video constructor
           //is sql data we should keep it
           $this->sqlData = $videoId;
       } else {
           // it means that we received an id, and we should
           // get the data from the database
           $query = $this->con->prepare("SELECT * FROM videos WHERE id=:id");
           $query->bindParam(":id", $videoId);
           $query->execute();


           //converting the returned values from the databse
           // into an object key => value
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

    public function getVideoUploadDate(){
        return $this->sqlData["uploadDate"];
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
        $videoId = $this->getVideoId();

        $query = $this->con->prepare("UPDATE videos SET views=views+1 WHERE id=:id");
        $query->bindParam("id", $videoId);
        $query->execute();

        $this->sqlData["views"] = $this->sqlData["views"] + 1;
    }

    public function getVideoLikes(){
        $videoId = $this->getVideoId();
        $query = $this->con->prepare("SELECT count(*) as 'count' FROM likes WHERE videoId= :videoId");

            $query->bindParam("videoId", $videoId);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data["count"];
    }

    public function getVideoDisLikes(){
        $videoId = $this->getVideoId();
        $query = $this->con->prepare("SELECT count(*) as 'count' FROM dislikes WHERE videoId= :videoId");
        $query->bindParam("videoId", $videoId);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data["count"];
    }

    public function like(){
        $id = $this->getVideoId();
        $username = $this->userLoggedInObj->getUserName();
        $query = $this->con->prepare("SELECT * FROM likes WHERE username=:username AND videoId=:videoId");
        $query->bindParam("username", $username);
        $query->bindParam("videoId", $id);
        $query->execute();

        if($this->wasLikedBy()){
            //DELETE FROM `likes` WHERE `likes`.`id` = 4
            $query = $this->con->prepare("DELETE FROM likes WHERE username=:username AND videoId=:videoId");
            $query->bindParam("username", $username);
            $query->bindParam("videoId", $id);
            $query->execute();

            $result = array(
                "likes" => -1,
                "dislikes" => 0
            );
            return json_encode($result);
        }else {
            $query = $this->con->prepare("INSERT INTO likes(username, videoId) VALUES (:username, :videoId)");
            $query->bindParam("username", $username);
            $query->bindParam("videoId", $id);
            $query->execute();

            $query = $this->con->prepare("DELETE FROM dislikes WHERE username=:username AND videoId=:videoId");
            $query->bindParam("username", $username);
            $query->bindParam("videoId", $id);
            $query->execute();


            $count = $query->rowCount();
            $result = array(
                "likes" => 1,
                "dislikes" => $count
            );
            return json_encode($result);
        }

    }

    public function wasLikedBy(){
        $id = $this->getVideoId();
        $username = $this->userLoggedInObj->getUserName();
        $query = $this->con->prepare("SELECT * FROM likes WHERE username=:username AND videoId=:videoId");
        $query->bindParam("username", $username);
        $query->bindParam("videoId", $id);
        $query->execute();

        return $query->rowCount() > 0;
    }

    public function disLike(){
        $id = $this->getVideoId();
        $username = $this->userLoggedInObj->getUserName();

        if($this->wasDisLikedBy()){
            // in this case the user is removing the dislike
            $query = $this->con->prepare("DELETE FROM dislikes WHERE username=:username AND videoId=:videoId");
            $query->bindParam("username", $username);
            $query->bindParam("videoId", $id);
            $query->execute();

            // remove 1=-1 from the dislike and keep the likes as it is
            $result = array(
                "likes" => 0,
                "dislikes" => -1
            );
            return json_encode($result);
        }

        else {
            // in this case the user is adding a dislike
            $query = $this->con->prepare("DELETE FROM likes WHERE username=:username AND videoId=:videoId");
            $query->bindParam("username", $username);
            $query->bindParam("videoId", $id);
            $query->execute();

            $count = $query->rowCount();

            $query = $this->con->prepare("INSERT INTO dislikes(username, videoId) VALUES (:username, :videoId)");
            $query->bindParam("username", $username);
            $query->bindParam("videoId", $id);
            $query->execute();


            $result = array(
                "likes" => 0 - $count,
                "dislikes" => 1
            );
            return json_encode($result);
        }


    }
    // to check is the user has disliked the video ?
    public function wasDisLikedBy(){

        $id = $this->getVideoId();
        $username = $this->userLoggedInObj->getUserName();
        $query = $this->con->prepare("SELECT * FROM dislikes WHERE username=:username AND videoId=:videoId");
        $query->bindParam("username", $username);
        $query->bindParam("videoId", $id);
        $query->execute();

        return $query->rowCount() > 0;
    }


}