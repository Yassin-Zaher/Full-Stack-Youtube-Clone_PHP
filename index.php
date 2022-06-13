<?php require_once("includes/header.php") ?>

<div class='videoSection'>
    <?php
    $username = $_SESSION["userLoggedIn"];
    $videoGrid = new VideoGrid($con, $username);
    echo $videoGrid->create(null, "Recommended", false);
    ?>

</div>



<?php require_once("includes/footer.php")?>