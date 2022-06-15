<?php
include_once("includes/header.php");

$trendingProvider = new TrendingProvider($con, $user);
$trendingVideos  = $trendingProvider->getVideo();

$videoGrid = new VideoGrid($con, $user);



?>
<div class="largeVideoGridContainer">
    <?php
    if(sizeof($trendingVideos) > 0) {
        echo $videoGrid->createLarge($trendingVideos, "Trending videos uploaded last week", false);
    } else {
        echo "No trending videos :)";
    }

    ?>
</div>


<?php require_once("includes/footer.php")?>