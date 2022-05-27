<?php
require_once("includes/header.php");
require_once("includes/classes/VideosDetailsFormProvider.php");
?>

<div class="column">

          <?php
          // calling the form provider class and displaying html into the content
          $formProvider = new VideoDetailsFormProvider($con);
          echo $formProvider->createUploadForm();
          ?>


</div>


<?php require_once("includes/footer.php") ?>