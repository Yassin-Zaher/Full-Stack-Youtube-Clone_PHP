<?php

class SelectThumbnail{
    private $con, $video;
    public function __construct($con, $video){
        $this->con = $con;
        $this->video = $video;
    }

    public function create(){
        $thumbnailData = $this->getThumbnailData();

        $html = "";
        foreach ($thumbnailData as $data) {
            $html.=$this->createThumbnailItem();


        }

        return "<div class='thumbnailItemContainer'>
                    $html
                </div>";
    }

    private function createThumbnailItem($data){
        $id = $data["id"];
        $filePath = $data["filePath"];
        $videoId = $data["videoId"];
        $selected = $data["selected"];

        return "<div class='thumbnailItem $selected' onclick='setThumnail($id, $videoId, this)'>
    
             </div>";
    }

    private function getThumbnailData(){
        $data = array();

        $query = $this->con->prepare("SELECT * FROM thumnails WHERE videoId=:videoId");
        $videoId = $this->video->getVideoId();
        $query->bindParam(":videoId", $videoId);
        $query->execute();

        while ($row = $query->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }

        return $data;
    }

}