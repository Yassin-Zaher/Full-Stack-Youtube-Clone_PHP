<?php
include_once("UserInfo.php");

class ProfileData{
    private $con, $profileUserObj;

    public function __construct($con, $profileUsername){
        $this->con = $con;
        $this->profileUserObj = new UserInfo($con, $profileUsername);

    }

    public function getProfileUserObj(): UserInfo{
        return $this->profileUserObj;
    }

    public function getProfileUsername() {
        return $this->profileUserObj->getUserName();
    }

    public function userExist(): bool {
        $reqUserName = $this->getProfileUsername();
        $query = $this->con->prepare("SELECT * FROM user WHERE userName=:username");
        $query->bindParam(":username", $reqUserName);
        return $query->rowCount() != 0;
    }

    public function getCoverPhoto(): string
    {
        return "assets/images/coverPhotos/yt-banner.jpg";
    }

    public function getProfileUserFullName(): string{
        return $this->profileUserObj->getFullName();
    }

    public function getUserProfilePic () {
        return $this->profileUserObj->profilePic();
    }

    public function getUserSubsCount () {
        return $this->profileUserObj->getSubscribeCount();
    }

    public function getSignUpDate(){
        return $this->profileUserObj->getSignUpDate();
    }

    public function getNumberOfViews(){
        $username = $this->profileUserObj->getUserName();
        $query = $this->con->prepare("SELECT SUM(views) AS numViews FROM videos WHERE uploadedBy=:uploadedBy");
        $query->bindParam(":uploadedBy", $username);
        $query->execute();

        $views = $query->fetch(PDO::FETCH_ASSOC);
        return $views["numViews"];
    }

    public function getUserVideos($userLoggedInObj){
        $uploadedBy =  $this->profileUserObj->getUserName();
        $query = $this->con->prepare("SELECT * FROM videos WHERE uploadedBy=:uploadedBy");
        $query->bindParam(":uploadedBy", $uploadedBy);
        $query->execute();

        $videos = array();

        while ($row = $query->fetch(PDO::FETCH_ASSOC)){
            $video = new Video($this->con, $row, $userLoggedInObj);
            array_push($videos, $video);
        }
        return $videos;
    }

}