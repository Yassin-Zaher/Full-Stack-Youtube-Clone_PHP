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
        return  "<ul class='nav nav-tabs'>
                      <li class='nav-item'>
                        <a id='videos-tab' class='nav-link active' data-toggle='tab' href='#videos'>Active</a>
                      </li>
                      <li class='nav-item'>
                        <a class='nav-link' href='#'>Link</a>
                      </li>
                      <li class='nav-item'>
                        <a class='nav-link' href='#'>Link</a>
                      </li>
                    <ul";
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


}