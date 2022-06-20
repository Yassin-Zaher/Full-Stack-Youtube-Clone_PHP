<?php
include_once("ProfileData.php");
class ProfileGenerator{
    private $con, $userLoggedInObj, $profileData;

    public function __construct($con, $userLoggedInObj, $username){
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
        $this->profileData = new ProfileData($this->con, $username);
    }
    public function create() {

       $coverPhotoSection = $this->createCoverPhotoSection();
       $headerSection = $this->createHeaderSection();
       $tabsSection = $this->createTabsSection();
       $contentSection = $this->createContentSection();

       return "<div class='profileContainer'>
                 $coverPhotoSection
                 $headerSection
                 $tabsSection
                 $contentSection
                </div>";
    }

    private function createCoverPhotoSection()
    {
        $coverPhoto =  $this->profileData->getCoverPhoto();
        $name = $this->profileData->getProfileUserFullName();

        return "<div class='coverContainer'>
                    <img class='coverPhoto' src='$coverPhoto' alt='cover-photo' >
                    <span class='channelName'>$name</span>
               </div>";

    }

    private function createTabsSection()
    {
        $videosHtml = $this->createProfileVideos();
        $detail = $this->createProfileDetails();

        return  "<div>
                    <!-- Tabs navs -->
                    <ul class='nav nav-tabs' role='tablist'>
                        <li class='nav-item'>
                            <a class='nav-link active' id='videos-tab' data-toggle='tab' 
                            href='#videos' role='tab' aria-controls='videos' aria-selected='true'>VIDEOS</a>
                        </li>
                        <li class='nav-item'>
                             <a class='nav-link' id='about-tab' data-toggle='tab' href='#about' role='tab' 
                            aria-controls='about' aria-selected='false'>ABOUT</a>
                        </li>
                </ul>
                    <!-- Tabs navs -->
                    
                    <!-- Tabs content -->
                    <div class='tab-content channelContent'>
                    <div class='tab-pane fade show active' id='videos' role='tabpanel' aria-labelledby='videos-tab'>
                        $videosHtml
                    </div>
                    <div class='tab-pane fade' id='about' role='tabpanel' aria-labelledby='about-tab'>
                        $detail
                    </div>
                </div>
<!-- Tabs content -->
               </div>";
    }

    private function createContentSection()
    {
    }

    private function createHeaderSection(){

        $profilePic = $this->profileData->getUserProfilePic();
        $fullName = $this->profileData->getProfileUserFullName();
        $subsCount = $this->profileData->getUserSubsCount();
        $button = $this->createSubscribeButton();

        return "<div class='profileHeader'>
                   <div class='userInfoContainer'>
                     <img class='profileImage' src='$profilePic' alt='profile-pic'>
                     <div class='userInfo'>
                       <span class='title'>$fullName</span>
                       <span class='subsCount'>$subsCount subscribers</span>
                      </div>
                     
                     
                     <div class='ButtonContainer'>
                        $button
                      </div>
                      </div>
                </div>";

    }


    public function createSubscribeButton() {
        if($this->userLoggedInObj->getUserName() == $this->profileData->getProfileUsername()) {
            return "";
        } else {
            return ButtonProvider::createProfileButtons($this->con,
                                                        $this->profileData->getProfileUserObj(),
                                                        $this->userLoggedInObj);
        }

    }

    public function createProfileVideos() {
        $userVideosArray = $this->profileData->getUserVideos($this->userLoggedInObj);

        $videosHtml = "";
        // check if the user has any videos
        if(sizeof($userVideosArray) > 0) {
            $videoGrid = new VideoGrid($this->con, $this->userLoggedInObj);
            $videosHtml = $videoGrid->create($userVideosArray, null, false);
        } else {
            $videosHtml =  "this user has no videos :(";
        }

        return $videosHtml;
    }

    public function createProfileDetails() {
        $user = $this->profileData->getProfileUserObj();
        $sqldate = $user->getSignUpDate();
        $date = strtotime($sqldate);
        $finalDate =  date("j F Y", $date);
        $numOfViews = $this->profileData->getNumberOfViews();
        $username = $user->getUserName();
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();



        return "<div class='row container details-profile-section'>
                      <div class='col-8 profile-description-section'>
                         <p>General Info</p> 
                         <span> first Name : $firstName</span> <br>
                         <span> last Name : $lastName</span> <br>
                         <span> user name : $username</span> <br>
                         
                         
                      </div>
                      <div class='col-2 profile-stats-section'>
                         <p>stats</p> <hr>
                         <span>Joined $finalDate</span> <hr>
                         <span>$numOfViews Views</span>
                      </div>
                      
                </div>";
    }



}