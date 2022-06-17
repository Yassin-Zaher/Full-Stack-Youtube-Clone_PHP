<?php
include_once("UserInfo.php");

class ProfileData{
    private $con, $profileUserObj;

    public function __construct($con, $profileUsername){
        $this->con = $con;
        $this->profileUserObj = new UserInfo($con, $profileUsername);

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
    public function getProfileUserFullName(): string
    {
        return $this->profileUserObj->getFullName();
    }




}