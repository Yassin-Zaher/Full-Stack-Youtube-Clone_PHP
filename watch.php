<?php require_once("includes/header.php") ?>


<?php
if(isset($_GET["id"])){
    echo "video uploaded";
}
?>

<div>
    <div class="row">
        <div class="col-8 border">
            <div class="embed-responsive embed-responsive-21by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/watch?v=yvloCylg2FE"></iframe>
            </div>
        </div>
    </div>

</div>





<?php require_once("includes/footer.php")?>