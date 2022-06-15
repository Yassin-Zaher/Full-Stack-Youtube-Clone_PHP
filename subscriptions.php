<?php
include_once("includes/header.php");

$subscriptionsProvider = new SubscriptionsProvider($con, $user);
$subsVideos  = $subscriptionsProvider->getVideo();

$videoGrid = new VideoGrid($con, $user);



?>
    <div class="largeVideoGridContainer">
        <?php
        if(sizeof($subsVideos) > 0) {
            echo $videoGrid->createLarge($subsVideos, "subscriptions", false);
        } else {
            echo "No trending videos :)";
        }

        ?>
    </div>


<?php require_once("includes/footer.php")?>