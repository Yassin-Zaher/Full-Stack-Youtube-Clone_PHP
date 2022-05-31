<?php require_once("includes/header.php") ?>

<?php
if(isset($_SESSION["userLoggedIn"])){
    echo "user Logged in : " . $user->getFullName();
} else {
    echo "No One is Here Baby ?";
}

?>



<?php require_once("includes/footer.php")?>