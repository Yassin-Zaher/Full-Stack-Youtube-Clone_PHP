<?php
require_once("VideoInfoControls.php");

class VideoInfo{

    public $video, $con, $userLoggedInObj;
    public function __construct( $con, $video, $userLoggedInObj){
        $this->video = $video;
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create(){
        return $this->createPrimaryInfo() . $this->createSecondaryInfo();

    }

    private function createPrimaryInfo(){
         $title =$this->video->getVideoTitle();
         $views = $this->video->getVideoViews();

         $videoControls = new VideoInfoControls($this->video, $this->userLoggedInObj);
         $controls = $videoControls->create();

         return "<div class='videoInfo'>
                    <h1>$title</h1>
                    <div class='bottomSection'>
                        <span>$views</span>
                        $controls
                    </div>
                </div>";
    }

    private function createSecondaryInfo(){

    }


}