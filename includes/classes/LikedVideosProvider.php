<?php

class LikedVideosProvider{
    private $con, $userLoggedInObj;

    public function __construct($con, $userLoggedInObj){
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }
    public function getVideos() {
        $videos = array();
        $username = $this->userLoggedInObj->getUserName();
        $query = $this->con->prepare("SELECT * FROM likes WHERE username=:username AND commentId=0
                                      ORDER BY id DESC");
        $query->bindParam(":username", $username);
        $query->execute();

        while ($raw =  $query->fetch(PDO::FETCH_ASSOC)) {
            $videos[] = new Video($this->con, $raw["videoId"], $this->userLoggedInObj);

        }

        return $videos;



        return $videos;
    }

}