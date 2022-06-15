<?php require_once("includes/header.php") ?>

<div class='videoSection'>
    <?php
    //get the sub video
    $subscriptionsProvider = new SubscriptionsProvider($con, $user);
    $subscriptionsVideos = $subscriptionsProvider->getVideo();

    $videoGrid = new VideoGrid($con, $userLoggedIn);

    if(UserInfo::isLoggedIn() && sizeof($subscriptionsVideos) > 0) {
        echo $videoGrid->create($subscriptionsVideos,"Subscriptions", false);
    }

    echo $videoGrid->create(null, "Recommended", false);
    ?>

</div>



<?php require_once("includes/footer.php")?>