<?php
require_once("includes/header.php");

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
        <h5 class="mb-3">User details</h5>
        <form>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="staticEmail" value="email@example.com">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="inputPassword" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword" placeholder="First name...">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="inputPassword" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword" placeholder="Last name...">
                </div>
            </div>
        </form>
        <hr>

        <h5 class="mb-3">Update password</h5>

        <form>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Old password</label>
                <div class="col-sm-10">
                    <input type="password"  class="form-control" id="staticEmail" value="email@example.com">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="inputPassword" class="col-sm-2 col-form-label">New password</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword" placeholder="Password">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="inputPassword" class="col-sm-2 col-form-label">Confirm new password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                </div>
            </div>
        </form>


    </div>

</div>
