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
                        <span class='viewCount'>$views views</span>
                        $controls
                    </div>
                </div>";
    }

    private function createSecondaryInfo(){
       $description = $this->video->getVideoDescription();
       $uploadedBy = $this->video->getVideoUploadedBy();
       $uploadDate = $this->video->getVideoUploadDate();

       $profileButton = ButtonProvider::createUserProfileButton($this->con, $uploadedBy);

        return "<div class='secondaryInfo'>
                    <div class='topRow'>
                       $profileButton
                    </div>
                </div>";

    }


}