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
        $text = $this->video->getVideoLikes();
        $videoId = $this->video->getVideoId();
        $class = "likeButton";
        $action = "likeVideo(this, $videoId)";
        $imageSrc = "assets/images/icons/thumb-up.png";

        $button = ButtonProvider::createButton($text, $imageSrc, $action, $class);
        return $button;
    }

    private function createDisLikeButton() {
        $button = ButtonProvider::createButton("DesLikes", "", "", "");
        return $button;
    }

}