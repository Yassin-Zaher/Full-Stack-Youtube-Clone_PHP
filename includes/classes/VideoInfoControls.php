<?php
require_once("ButtonProvider.php");
class VideoInfoControls{
    public $video, $userLoggedInObj;
    public function __construct($video, $userLoggedInObj){
        $this->video = $video;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create(){
        $likeButton = $this->createLikeButton();
        $dislikeButton = $this->createDisLikeButton();

        return "<div> 
                   $likeButton
                   $dislikeButton
                </div>";
    }

    private function createLikeButton() {
        //$text = $this->getVideoLikes();
        $videoId = $this->video->getVideoId();
        $class = "likeButton";
        $imageSrc = "assets/images/icons/thumb-up.png";

        $button = ButtonProvider::createButton("5", $imageSrc, "", $class);
        return $button;
    }

    private function createDisLikeButton() {
        $button = ButtonProvider::createButton("DesLikess", "", "", "");
        return $button;
    }

}