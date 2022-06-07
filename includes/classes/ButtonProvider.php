<?php
include_once("UserInfo.php");
class ButtonProvider{
    public static function createButton($text, $imagSrc, $action, $class){
        $image = ($imagSrc == null) ? "" : "<img src='$imagSrc'>";

        //TODO: Handle the Action For Our button
        return "<button class='$class' onclick='$action'>
                    $image
                  <span class='text'>$text</span>
               </button>";
    }

    public static function createUserProfileButton($con, $username){
        $userObj = new UserInfo($con, $username);
        $profilePic = $userObj->profilePic();

        $link = "profile.php?username=$username";
        return "<a href=$link>
                  <img src='$profilePic' alt='profile picture' class='profilePicture'>
               </a>";
    }
}