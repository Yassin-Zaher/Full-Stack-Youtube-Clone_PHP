<?php

class VideoGrid {
    private $con, $userLoggedIn;
    private $largeMode = false;
    private $gridClass = "videoGrid";

    public function __construct($con, $userLoggedIn) {

    }

    public function create($video, $title, $showFilter): string
    {
        return "<div class='$this->gridClass'>
                   where the grid Items will go 
               </div>";
    }

}