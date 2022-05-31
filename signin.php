<?php include_once("includes/head.php");
require_once("includes/classes/Account.php");
include_once("includes/config.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/FormCleaner.php");

$account = new Account($con);
if(isset($_POST["loginButton"])){

    $userName = FormCleaner::cleanUserName($_POST["username"]);
    $password = FormCleaner::cleanPassword($_POST["password"]);

    $wasSuccessLogin = $account->login($userName, $password);

    if($wasSuccessLogin){
        $_SESSION["userLoggedIn"] = $userName;
        header("Location: index.php");
    }
}
function keepData($input){
    if(isset($_POST[$input])) {
        echo $_POST[$input];
    }
}

?>

<body class="d-flex justify-content-center">

    <!-- Email input -->
    <div class="mt-5 shadow-lg p-3 mb-5 bg-white rounded" style="width: 30rem;" >
    <form action="signin.php" method="POST" >
     <div class="text-center mb-5" >
         <img style="width: 80px; height: 40px" src="assets/images/youtube-logo.png" alt="youtube-logo" class="img-thumbnail h-2 mb-2">
         <h3>Sign In</h3>
         <p>to continue in to youtube</p>
     </div>
        <?php echo $account->displayError(Constants::$loginFailed)?>
    <div class="form-outline mb-4 mt-3">
        <label class="form-label" for="e1">username</label>
        <input type="text" name="username" value="<?php keepData('username');?>" id="e1" class="form-control" placeholder="Enter your userName.." />
    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="ex2">Password</label>
        <input type="password" name="password" value="<?php keepData('password');?>" id="ex2" class="form-control" placeholder="Enter your Password.."/>
    </div>

    <div class="row mb-4">
        <div class="col d-flex justify-content-center">
            <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                <label  class="form-check-label" for="form2Example31"> Remember me </label>
            </div>
        </div>

    </div>
    <button type="submit" name="loginButton"  class="btn btn-primary btn-block mb-4">Sign in</button>
        <div>
            <span>Don't Have an account ? </span> <a href="signup.php" class="link-primary">Sign Up</a>
        </div>
    </div>
</form>
</body>


