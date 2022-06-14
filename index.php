<?php require_once("includes/header.php") ?>

<div class='videoSection'>
    <?php
    $username = $_SESSION["userLoggedIn"];
    //get the sub video

    // TODO::the user logged in Objects is  must fix

    $subscriptionsProvider = new SubscriptionsProvider($con, $user);
    $subscriptionsVideos = $subscriptionsProvider->getVideo();

    $videoGrid = new VideoGrid($con, $username);

    if(UserInfo::isLoggedIn() && sizeof($subscriptionsVideos) > 0) {
        echo $videoGrid->create($subscriptionsVideos,"Subscriptions", false);
    }

    echo $videoGrid->create(null, "Recommended", false);
    ?>

</div>



<?php require_once("includes/footer.php")?>