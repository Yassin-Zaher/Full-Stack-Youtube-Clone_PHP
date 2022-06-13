<?php require_once("includes/header.php") ?>

<div class='videoSection'>
    <?php
    $username = $_SESSION["userLoggedIn"];
    //get the sub video

    // TODO::the user logged in Objects is  must fix

    $subscriptionsProvider = new SubscriptionsProvider($con, $userLoggedIn);
    $subscriptionsVideos = $subscriptionsProvider->getVideo();

    if(UserInfo::isLoggedIn() && sizeof($subscriptionsVideos) > 0) {
        echo $videoGrid->create("Subscriptions", $subscriptionsVideos, false);
    }
    $videoGrid = new VideoGrid($con, $username);
    echo $videoGrid->create(null, "Recommended", false);
    ?>

</div>



<?php require_once("includes/footer.php")?>