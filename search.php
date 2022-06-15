<?php
require_once("includes/header.php");
require_once("includes/classes/SearchResultProvider.php");
?>

<?php
$term = $_GET["term"];
if(!isset($_GET["orderBy"]) || $_GET["orderBy"] == "views") {
    $orderBy = "views";
} else {
    $orderBy = "uploadDate";
}

$searchResultProvider = new SearchResultProvider($con, $user);
$searchVideosResult = $searchResultProvider->getVideo($term, $orderBy);
$searchCount = sizeof($searchVideosResult);

$videoGrid = new VideoGrid($con, $userLoggedIn);

?>

<div class="largeVideoGridContainer">
    <?php
    if($searchCount > 0) {
        echo $videoGrid->createLarge($searchVideosResult, "$searchCount results found", true);
    }else {
        echo "No results Found :)";
    }
    ?>
</div>









<?php require_once("includes/footer.php") ?>