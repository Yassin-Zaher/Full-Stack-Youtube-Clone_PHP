<?php
require_once("includes/header.php");
require_once("includes/classes/VideosDetailsFormProvider.php");
?>

<div class="column">
          <?php
          $formProvider = new VideoDeatailsFormProvider();
          echo $formProvider->createUploadForm();

          $query = $con->prepare("SELECT * FROM categories");
          $query->execute();

          while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    echo $row['name'];
          }

          ?>


</div>


<?php require_once("includes/footer.php") ?>