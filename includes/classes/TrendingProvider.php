<?php

class TrendingProvider{
    private $con, $userLoggedInObj;

    public function __construct($con, $userLoggedInObj){
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }


    public function getVideo(){
        $videos = array();

        $trendingQuery = $this->con->prepare("SELECT * FROM videos WHERE uploadDate >= now() - INTERVAL 7 DAY 
                                              ORDER BY views DESC LIMIT 15");
        $trendingQuery->execute();

        while ($row = $trendingQuery->fetch(PDO::FETCH_ASSOC)) {
            $video = new Video($this->con, $row, $this->userLoggedInObj);
            array_push($videos, $video);
        }

        return $videos;
    }

}