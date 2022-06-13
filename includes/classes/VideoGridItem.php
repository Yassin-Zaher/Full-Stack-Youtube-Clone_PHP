<?php
class VideoGridItem{
     private $video, $largeMode;
     public function __construct($video, $largeMode){
         $this->video = $video;
         $this->largeMode = $largeMode;
     }

     public function create(){
         $thumbnail = $this->getVideoThumbnail();
         $videoDetails = $this->getVideoDetails();

         $href = "watch.php?id=" . $this->video->getVideoId();
         return "<a href='$href'>
                    <div class='videoGridItem'>
                      $thumbnail
                      $videoDetails
                    </div>
                </a>";
     }

     public function getVideoThumbnail() {
         $thumbnail = $this->video->getThumbnails();;
         $duration = $this->video->getVideoDuration();

         return "<div class='thumbnail'>
                    <img src='$thumbnail'>
                    <div class='duration'>
                       <span>$duration</span>
                    </div>
                 </div>";
     }

    public function getVideoDetails() {
         $title = $this->video->getVideoTitle();
        $username = $this->video->getVideoUploadedBy();
        $views = $this->video->getVideoViews();
        $description = $this->createDescription();
        $uploadedDate = $this->video->getVideoUploadDateOriginal();
        $timespan = $this->time_elapsed_string($uploadedDate);

        $timespan = $this->time_elapsed_string($this->video->getVideoUploadDateOriginal());
        return "<div class='details'>
                    <p class='title'>$title</p>
                    <span class='username'>$username</span>
                    <div class='stats'>
                       <span class='viewCount'>$views views - </span>
           
                       <span class='timestamp'>$timespan ago</span>
                    </div>
                    $description
                </div>";
    }

    private function createDescription(){
         if(!$this->largeMode) {
             return "";
         } else {
             $description = $this->video->getVideoDescription();
             $description = (strlen($description) > 350) ? substr($description, 0 , 347) . "..." : $description;
             return "<span class='description'>$description</span>";
         }
    }

    private function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}