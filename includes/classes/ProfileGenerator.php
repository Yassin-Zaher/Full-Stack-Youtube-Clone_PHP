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
    }

    private function createContentSection()
    {
    }

    private function createHeaderSection()
    {
    }

}