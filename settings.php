<?php
require_once("includes/header.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/FormCleaner.php");
require_once("includes/classes/Constants.php");

//TODO : GETTING USER INFO
if(!UserInfo::isLoggedIn()){
    header("location: signin.php");
}

$firstName = $user->getFirstName();
$lastName = $user->getLastName();
$email = $user->getEmail();

$oldPassword = $user->getPassword();

$detailsMsg = "";
$passwordMsg = "";
if(isset($_POST["changeUserInfo"])){
    $account = new Account($con);
    $firstName = FormCleaner::cleanFormString($_POST["firstName"]);
    $lastName = FormCleaner::cleanFormString($_POST["lastName"]);
    $email = FormCleaner::cleanFormString($_POST["email"]);

    if($account->updateDetails($firstName, $lastName, $email, $user->getUserName())){
        $detailsMsg = "<div class='alert alert-success'>
                            <strong>SUCCESS !</strong> Details updated successfully !
                        </div>";
    } else {
        $errorMessage = $account->getFirstError();
        if($errorMessage == "") $errorMessage = "Something went wrong!";

        $detailsMsg = "<div class='alert alert-danger'>
                            <strong>ERROR !</strong> $errorMessage
                        </div>";

    }
}

if(isset($_POST["changeUserPassword"])){
    $account = new Account($con);
    $oldPass = FormCleaner::cleanFormString($_POST["oldPass"]);
    $newPass = FormCleaner::cleanFormString($_POST["newPass"]);
    $newPassConfirm = FormCleaner::cleanFormString($_POST["newPassConfirm"]);

    if($account->updatePassword($oldPass, $newPass, $newPassConfirm, $user->getUserName())){
        $passwordMsg = "<div class='alert alert-success'>
                            <strong>SUCCESS !</strong> password updated successfully !
                        </div>";
    } else {
        $passwordMsg = $account->getFirstError();
        if($passwordMsg == "") $passwordMsg = "Something went wrong!";

        $passwordMsg = "<div class='alert alert-danger'>
                            <strong>ERROR !</strong> $passwordMsg
                        </div>";

    }
}





?>


<div class="settings-container">
    <div class="settings-header">
        <div class="header-text">
            <h4>Settings</h4>
            <h3>Set up YouTube exactly how you want it</h3>
        </div>
        <div class="header-assets">
            <h5>Powered By</h5>
            <img src="assets/images/icons/icons8-google-100.png">
        </div>

    </div>

    <hr>

    <div class="settings-body">
        <?php echo $detailsMsg?>
        <h5 class="mb-3">User details</h5>
        <form action="settings.php" method="post">
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" name="email" id="staticEmail" value="<?php echo $email?>">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="inputPassword" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="firstName" id="inputPassword" placeholder="First name..."
                    value="<?php echo $firstName?>">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="inputPassword" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="lastName" id="inputPassword" placeholder="Last name..."
                    value="<?php echo $lastName?>">
                </div>
            </div>
                <input type="submit" name="changeUserInfo" class="mt-3 changeUserInfo" value="SAVE">

        </form>
        <hr>

        <h5 class="mb-3">Update password</h5>

        <form action="settings.php" method="post">
            <?php echo $passwordMsg?>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Old password</label>
                <div class="col-sm-10">
                    <input type="password" name="oldPass"  class="form-control" id="staticEmail" placeholder="Old password">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="inputPassword" class="col-sm-2 col-form-label">New password</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="newPass" id="inputPassword" placeholder="New password">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="inputPassword" class="col-sm-2 col-form-label">Confirm new password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="newPassConfirm" id="inputPassword" placeholder="Confirm new password">
                </div>
            </div>

            <input type="submit" name="changeUserPassword" class="changeUserPassword mt-3" value="SAVE">
        </form>


    </div>

</div>
