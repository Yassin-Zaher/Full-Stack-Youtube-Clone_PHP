<?php include_once("includes/head.php") ?>

<body class="d-flex justify-content-center">

<!-- Email input -->
<div class="mt-5 shadow-lg p-3 mb-5 bg-white rounded overflow-auto" style="width: 30rem;" >
    <form>
        <div class="text-center mb-5" >
            <img style="width: 20rem;" src="assets/images/youtube-logo.png" alt="youtube-logo" class="img-thumbnail h-2 mb-2">
            <h3>Sign Up</h3>
            <p>to continue in to youtube</p>
        </div>
        <div class="form-outline mb-4 mt-3">
            <input type="text" id="email" class="form-control" placeholder="First name" />
        </div>
        <div class="form-outline mb-4">
            <input type="text" id="form2Example2" class="form-control" placeholder="Last name"/>
        </div>

        <div class="form-outline mb-4 mt-3">
            <input type="text" id="email" class="form-control" placeholder="username" />
        </div>

        <div class="form-outline mb-4">
            <input type="email" id="form2Example2" class="form-control" placeholder="email"/>
        </div>

        <div class="form-outline mb-4 mt-3">
            <input type="email" id="email" class="form-control" placeholder="Confirm email" />
        </div>

        <div class="form-outline mb-4">
            <input type="password" id="form2Example2" class="form-control" placeholder="password"/>
        </div>

        <div class="form-outline mb-4">
            <input type="password" id="form2Example2" class="form-control" placeholder="Confirm password"/>
        </div>



        <div class="row mb-4">
            <div class="col d-flex justify-content-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                    <label class="form-check-label" for="form2Example31"> Remember me </label>
                </div>
            </div>

        </div>
        <button type="button" class="btn btn-primary btn-block btn-large mb-4">Sign Up</button>
        <div>
            <span>Have an account ? </span> <a href="signin.php" class="link-primary">Login</a>
        </div>
</div>
</form>
</body>


