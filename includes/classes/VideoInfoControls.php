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

        return "<div class='controls'> 
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

        if ($this->video->wasLikedBy()){
            $imageSrc = "assets/images/icons/thumb-up-active.png";
        }

        $button = ButtonProvider::createButton($text, $imageSrc, $action, $class);
        return $button;
    }

    private function createDisLikeButton() {
        $text = $this->video->getVideoDisLikes();
        $videoId = $this->video->getVideoId();
        $class = "disLikeButton";
        $action = "disLikeVideo(this, $videoId)";
        $imageSrc = "assets/images/icons/thumb-down.png";

        if ($this->video->wasDisLikedBy()){
            $imageSrc = "assets/images/icons/thumb-down-active.png";
        }

        $button = ButtonProvider::createButton($text, $imageSrc, $action, $class);
        return $button;
    }

}