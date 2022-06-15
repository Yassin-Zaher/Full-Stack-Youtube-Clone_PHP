<?php
include_once("includes/header.php");
require_once("includes/classes/LikedVideosProvider.php");


$likedVideoProvider = new LikedVideosProvider($con, $user);
$likedVideos  = $likedVideoProvider->getVideos();

$videoGrid = new VideoGrid($con, $user);



?>
    <div class="largeVideoGridContainer">
        <?php
        if(sizeof($likedVideos) > 0) {
            echo $videoGrid->createLarge($likedVideos, "Liked videos", false);
        } else {
            echo "No video liked :)";
        }

        ?>
    </div>


<?php require_once("includes/footer.php")?>