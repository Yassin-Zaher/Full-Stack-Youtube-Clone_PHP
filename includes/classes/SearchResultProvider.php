<?php

class SearchResultProvider{

    private $con, $userLoggedInObj;

    public function __construct($con, $userLoggedInObj){
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function getVideo($term, $orderBy){
        $searchResultVideos = array();
        $query = $this->con->prepare("SELECT * FROM videos WHERE title LIKE CONCAT('%', :term, '%')
                                      OR uploadedBy LIKE CONCAT('%', :term, '%') ORDER BY $orderBy DESC");
        $query->bindParam(":term", $term);
        $query->execute();

        while ($raw = $query->fetch(PDO::FETCH_ASSOC)){
            $video = new Video($this->con, $raw, $this->userLoggedInObj);
            array_push($searchResultVideos, $video);
        }

        return $searchResultVideos;
    }

}