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
        return "<a href='$link'>
                  <img src='$profilePic' alt='profile-pic' class='profilePicture'>
               </a>";
    }

    public static function createHyperButton($text, $imagSrc, $href, $class){
        $image = ($imagSrc == null) ? "" : "<img src='$imagSrc'>";

        //TODO: Handle the Action For Our button
        return "<a href='$href'>
               <button class='$class'>
                    $image
                  <span class='text'>$text</span>
               </button>
               </a>";
    }

    public static function createEditVideoButton($videoId){
        $href = "editVideo.php?videoId=$videoId";

        $button = ButtonProvider::createHyperButton("EDIT VIDEO", null, $href, "button edit");
        return "<div class='editVideoButtonContainer'>
                    $button
                </div>";
    }

    public static function createSubscribeButton($con, $userToObj, $userLoggedInObj){

        //this is the user who uploaded the video
        $userTo = $userToObj->getUserName();

        //this is me the user logged in and i'm trying to  watch others video : my username
        $userLoggedIn = $userLoggedInObj->getUserName();

        //this will return true if i'm subscribed to this user, false if not
        $isSubscribedTo = $userLoggedInObj->isSubscribedTo($userTo);

        $buttonText = $isSubscribedTo ? "SUBSCRIBED" : "SUBSCRIBE";
        $buttonText .= " " . $userToObj->getSubscribeCount();
        $buttonClass = $isSubscribedTo ? "unsubscribe button" : "subscribe button";

        $action = "subscribe(\"$userTo\", \"$userLoggedIn\", this)";



        $button = ButtonProvider::createButton($buttonText, null, $action, $buttonClass);

        return "<div class='subscribeButtonContainer'>
                    $button
                </div>";



    }

    public static function createSignInButton($con, $username){

        if(UserInfo::isLoggedIn()){
            return ButtonProvider::createUserProfileButton($con, $username);
        }else {
            $href="signin.php";

            return "<a href='$href' class='HeaderSignInButton'>
                 <img class='signInImg' src='assets/images/profilePictures/signinIcon.png'>
                 <span class='signInTxt'>SIGN IN</span>
               </a>";
        }

    }

    public static function createNotifyButton($con, $userToObj, $userLoggedInObj): string
    {
        $userTo = $userToObj->getUserName();
        $userFrom = $userLoggedInObj->getUserName();

        $action = "subscribe(this, \"$userTo\", \"$userFrom\")";

        if($userLoggedInObj->isNotifiedTo($userToObj->getUserName())) {
            return "<button class='notifyBtn' onclick='$action'>
                      <img class='notify-img' src='assets/images/notifications/active-notification.png'>
                    </button>";
        } else {
            return "<button class='notifyBtn' onclick='notify(this, \"$userTo\", \"$userFrom\")'>
                      <img src='assets/images/notifications/notification.png'>
                    </button>";
        }
    }

    public static function createProfileButtons($con, $userToObj, $userLoggedInObj) {
        $subBtn = ButtonProvider::createSubscribeButton($con, $userToObj, $userLoggedInObj);
        $notifyBtn = ButtonProvider::createNotifyButton($con, $userToObj, $userLoggedInObj);

        return "<div class='profile-buttons-section'> 
                    $subBtn
                    $notifyBtn
                </div>";

    }
}