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
                    <div>
                      $thumbnail
                      $videoDetails
                    </div>
                </a>";
     }

     public function getVideoThumbnail() {
         //$this->video->getTumbnails();
         return "<div>
                   <img src='assets/images/yt-thumb.png' />
                 </div>";
     }

    public function getVideoDetails() {
        $timespan = $this->time_elapsed_string($this->video->getVideoUploadDateOriginal());
        return "<div class='videoSuggestionDetails'>
                    <p>$this->video->getVideoTitle()</p>
                    <p class='text-muted'>$this->video->getVideoUploadedBy()</p>
                    <div class='d-flex w-100 justify-content-between'>
                       <span>$this->video->getVideoViews() views</span>
                       <span>.</span>
                       <span>$timespan ago</span>
                    </div>
                </div>";
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