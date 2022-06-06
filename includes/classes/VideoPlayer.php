<?php

class VideoPlayer {
    public $video;
    public function __construct($video){
        $this->video = $video;
    }

    public function create(){
//        if($autoPlay){
//            $autoPlay = "autoPlay";
//        }else{
//            $autoPlay = "";
//        }

        $filePath = $this->video->getVideoPath();


        //<img src="{{ asset('uploads/joew.png') }}" />
        return "<video class='videoPlayer' controls>
                    <source src='$filePath' type='video/mp4'>
                </video>";
    }

}