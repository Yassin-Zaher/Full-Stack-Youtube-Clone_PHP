<?php include_once("includes/head.php") ?>

<body class="d-flex justify-content-center">

    <!-- Email input -->
    <div class="mt-5 shadow-lg p-3 mb-5 bg-white rounded" style="width: 30rem;" >
    <form>
     <div class="text-center mb-5" >
         <img style="width: 20rem;" src="assets/images/youtube-logo.png" alt="youtube-logo" class="img-thumbnail h-2 mb-2">
         <h3>Sign In</h3>
         <p>to continue in to youtube</p>
     </div>
    <div class="form-outline mb-4 mt-3">
        <label class="form-label" for="email">Email address</label>
        <input type="email" id="email" class="form-control" placeholder="Enter your Email.." />
    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example2">Password</label>
        <input type="password" id="form2Example2" class="form-control" placeholder="Enter your Password.."/>
    </div>

    <div class="row mb-4">
        <div class="col d-flex justify-content-center">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                <label class="form-check-label" for="form2Example31"> Remember me </label>
            </div>
        </div>

    </div>
    <a href="index.php" type="submit"  class="btn btn-primary btn-block mb-4">Sign in</a>
        <div>
            <span>Don't Have an account ? </span> <a href="signup.php" class="link-primary">Sign Up</a>
        </div>
    </div>
</form>
</body>


