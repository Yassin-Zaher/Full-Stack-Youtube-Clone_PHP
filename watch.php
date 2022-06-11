<?php
require_once("includes/header.php");
require_once("includes/classes/VideoPlayer.php");
require_once("includes/classes/VideoInfo.php");
require_once("includes/classes/CommentSection.php");


    if(!isset($_GET["id"])){
        echo "no video passed to this page :)";
        exit();
    }


$video = new Video($con, $_GET["id"], $user);
$video->IncrementView();
?>

<script src="assets/js/videoPlayerAction.js"></script>
    <script src="assets/js/commentAction.js"></script>

<div class="watchLeftColumn">
    <?php $videoPlayer = new VideoPlayer($video);
     echo $videoPlayer->create();

     $videoInfo = new VideoInfo($con, $video, $user);
     echo $videoInfo->create();

    $commentSection = new CommentSection($con, $video, $user);
    echo $commentSection->create();
    ?>
</div>

<div class="suggestion"></div>






<?php require_once("includes/footer.php")?>