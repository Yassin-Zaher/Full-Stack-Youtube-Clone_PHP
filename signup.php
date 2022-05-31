<?php
include_once("includes/head.php");
require_once("includes/classes/FormCleaner.php");
require_once("includes/classes/Account.php");
include_once("includes/config.php");
require_once("includes/classes/Constants.php");

$account = new Account($con);

if(isset($_POST["signupButton"])){
    $firstName = FormCleaner::cleanFormString($_POST["firstName"]);
    $lastName = FormCleaner::cleanFormString($_POST["lastName"]);
    $email = FormCleaner::cleanEmail($_POST["email"]);
    $email2= FormCleaner::cleanEmail($_POST["email2"]);
    $password = FormCleaner::cleanPassword($_POST["password"]);
    $password2 = FormCleaner::cleanPassword($_POST["password2"]);
    $userName = FormCleaner::cleanUserName($_POST["userName"]);

    $wasSuccessful = $account->register($firstName, $lastName, $userName, $email, $email2, $password, $password2);

    if($wasSuccessful) {
        $_SESSION["userLoggedIn"] = $userName;
        header("Location: index.php");
    }

}

//remember the data function
function keepData($input){
    if(isset($_POST[$input])){
        echo $_POST[$input];
    }

}
?>


<body class="d-flex justify-content-center">

<!-- Email input -->
<div class="mt-5 shadow-lg p-3 mb-5 bg-white rounded overflow-auto" style="width: 30rem;" >
    <form method="POST">
        <div class="text-center mb-5" >
            <img style="width: 80px; height: 40px" src="assets/images/youtube-logo.png" alt="youtube-logo" class="img-thumbnail h-2 mb-2">
            <h3>Sign Up</h3>
            <p>to continue in to youtube</p>
        </div>

        <?php echo $account->displayError(Constants::$firstNameChars)?>
        <div class="form-outline mb-4 mt-3">
            <input type="text" name="firstName" id="email" value="<?php keepData('firstName');?>" class="form-control" placeholder="First name" />
        </div>

        <?php echo $account->displayError(Constants::$lastNameChars)?>
        <div class="form-outline mb-4">
            <input  type="text" name="lastName" id="form2Example2" value="<?php keepData('lastName');?>" class="form-control" placeholder="Last name"/>
        </div>
        <?php echo $account->displayError(Constants::$userNameChars)?>
        <?php echo $account->displayError(Constants::$userNameTaken)?>
        <div class="form-outline mb-4 mt-3">
            <input  type="text"  name="userName" value="<?php keepData('userName');?>" class="form-control" placeholder="username" />
        </div>

        <?php echo $account->displayError(Constants::$emailNotMatch)?>
        <?php echo $account->displayError(Constants::$emailInvalid)?>
        <?php echo $account->displayError(Constants::$emailTaken)?>
        <div class="form-outline mb-4">
            <input  type="email" name="email"  value="<?php keepData('email');?>"  class="form-control" placeholder="email"/>
        </div>

        <div class="form-outline mb-4 mt-3">
            <input type="email" name="email2" value="<?php keepData('email2');?>" class="form-control" placeholder="Confirm email" />
        </div>




        <?php echo $account->displayError(Constants::$passwordNotMatch)?>
        <?php echo $account->displayError(Constants::$passwordNotAlphaNumeric)?>
        <?php echo $account->displayError(Constants::$passwordLength)?>
        <div class="form-outline mb-4">
            <input  type="password" value="<?php keepData('password');?>" name="password" class="form-control" placeholder="password"/>
        </div>

        <div class="form-outline mb-4">
            <input type="password" value="<?php keepData('password2');?>" name="password2" class="form-control" placeholder="Confirm password"/>
        </div>



        <div class="row mb-4">
            <div class="col d-flex justify-content-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" checked />
                    <label class="form-check-label" for="form2Example31"> Remember me </label>
                </div>
            </div>

        </div>
        <button type="submit" name="signupButton" class="btn btn-primary btn-block btn-large mb-4">Sign Up</button>
        <div>
            <span>Have an account ? </span> <a href="signin.php" class="link-primary">Login</a>
        </div>
</div>
</form>
</body>


