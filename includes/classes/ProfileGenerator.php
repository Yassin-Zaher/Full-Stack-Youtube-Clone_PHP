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
                    <ul class='nav nav-tabs'>
                        <li class='nac-item' role='presentation'>
                            <button class='nav-link' data-bs-toggle='tab' id='videos-tab' type='button' data-bs-target='#videos'
                            role='tab' aria-controls='videos' aria-selected='true'>
                             Videos
                             </button>
                        </li>
                        
                        <li class='nac-item' role='presentation'>
                            <button class='nav-link' data-bs-toggle='tab' id='about-tab' type='button' data-bs-target='#about'
                            role='tab' aria-controls='about' aria-selected='true'>
                             About
                             </button>
                        </li>
                    </ul>
                    <div class='tab-content'>
                        <div class='tab-pane show fade' role='tabpanel' id='videos'>
                            $videosHtml
                        </div>
                        
                        <div class='tab-pane fade' role='tabpanel' id='about'>
                            $detail
                        </div>
                        
                        
                    </div>
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
        $user = $this->profileData->getProfileUserObj();
        $userVideosArray = $user->getUserVideos($this->userLoggedInObj);

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
        return "<div class='row container details-profile-section'>
                      <div class='col-8 profile-description-section'>
                         <p>Description</p> <hr>
                         <span>Bla bla bla</span>
                      </div>
                      <div class='col-4 profile-stats-section'>
                         <p>stats</p> <hr>
                         <span>Joined </span> <hr>
                         <span>Views</span>
                      </div>
                      
                </div>";
    }



}