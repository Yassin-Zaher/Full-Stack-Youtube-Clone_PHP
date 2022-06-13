<?php

class VideoGrid {
    private $con, $userLoggedIn;
    private $largeMode = false;
    private $gridClass = "videoGrid";

    public function __construct($con, $userLoggedIn) {
        $this->con = $con;
        $this->userLoggedIn = $userLoggedIn;
    }

    public function create($videos, $title, $largeMode): string{

        if($videos == null) {
            $gridItems = $this->generateItems();
        }else {
            $gridItems = $this->generateItemsFromVideos($videos);
        }

        $gridItems = $this->generateItems();
        $header = $this->createHeader($title);

        return "$header
               <div class='$this->gridClass'>
                    
                   $gridItems 
               </div>";
    }
    public function generateItems(): string{

        $query = $this->con->prepare("SELECT * FROM videos ORDER BY RAND() LIMIT 15");
        $query->execute();

        $htmlElement = "";
        while($row = $query->fetch(PDO::FETCH_ASSOC) ) {

            $video = new Video($this->con, $row, $this->userLoggedIn);
            $item = new VideoGridItem($video, $this->largeMode);
            $htmlElement .= $item->create();
        }
        return $htmlElement;
    }

    public function generateItemsFromVideos($uploadedBy){

        $query = $this->con->prepare("SELECT * FROM videos WHERE uploadedBy=:uploadedBy");
        $query->bindParam(":uploadedBy", $uploadedBy);
        $query->execute();

        $htmlElement = "";
        while($row = $query->fetch(PDO::FETCH_ASSOC) ) {

            $video = new Video($this->con, $row, $this->userLoggedIn);
            $item = new VideoGridItem($video, $this->largeMode);
            $htmlElement .= $item->create();
        }
        return $htmlElement;
    }

    public function createHeader($title){
        //TODO : CREATE THE HEADER :)
        $filter = "";
        return "<div class='videoGridHeader'>
                <div class='left'>
                  $title
                </div>
                   $filter 
               </div>";
    }

}