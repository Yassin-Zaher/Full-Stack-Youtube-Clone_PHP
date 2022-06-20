<?php

class VideoGrid {
    private $con, $userLoggedInObj;
    private $largeMode = false;
    private $gridClass = "videoGrid";

    public function __construct($con, $userLoggedInObj) {
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create($videos, $title, $showFilter): string{

        if($videos == null) {
            $gridItems = $this->generateItems();
        }else {
            $gridItems = $this->generateItemsFromVideos($videos);
        }
        $header = $this->createHeader($title, $showFilter);

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

            $video = new Video($this->con, $row, $this->userLoggedInObj);
            $item = new VideoGridItem($video, $this->largeMode);
            $htmlElement .= $item->create($this->con);
        }
        return $htmlElement;
    }

    public function generateItemsFromVideos($videos){
        $htmlElement = "";
        foreach ($videos as $video) {
            $item = new VideoGridItem($video, $this->largeMode);
            $htmlElement .= $item->create($this->con);
        }
        return $htmlElement;
    }

    public function createHeader($title, $showFilter){
        $filter = "";
        if($showFilter) {
            $link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $urlArray = parse_url($link);
            $query = $urlArray["query"];

            parse_str($query, $params);

            unset($params["orderBy"]);

            $newQuery = http_build_query($params);

            $newUrl = $_SERVER["PHP_SELF"] . "?" . $newQuery;

            $filter = "<div class='right'>
                         <span>Order by</span>
                         <a href='$newUrl&orderBy=uploadDate'>Upload date</a>
                         <a href='$newUrl&orderBy=views'>Most viewed</a>
                        </div>";

        }

        if(!$title == null) {
            return "<div class='videoGridHeader'>
                <div class='left'>
                  $title
                </div>
                   $filter 
               </div>";
        } else {
            return "";
        }
    }

    public function createLarge($videos, $title, $showFilter) {
        $this->gridClass .= " large";
        $this->largeMode = true;

        return $this->create($videos, $title, $showFilter);

    }

}