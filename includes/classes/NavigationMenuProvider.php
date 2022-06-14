<?php

class NavigationMenuProvider{

    private $con, $userLoggedInObj;
    public function __construct($con, $userLoggedInObj){
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }


    public function create() {
        $menuHtml = $this->createNavItem("Home","assets/images/icons/home.png", "index.php");
        $menuHtml .= $this->createNavItem("Trending","assets/images/icons/trending.png", "trending.php");
        $menuHtml .= $this->createNavItem("Subscription","assets/images/icons/subscriptions.png", "subscriptions.php");
        $menuHtml .= $this->createNavItem("Liked Videos","assets/images/icons/thumb-up.png", "likedVideos.php");

        if(UserInfo::isLoggedIn()){
            $menuHtml .= $this->createNavItem("Settings","assets/images/icons/settings.png", "settings.php");
            $menuHtml .= $this->createNavItem("Log Out","assets/images/icons/logout.png", "logout.php");
        }

        $menuHtml .= $this->createSubsSection();


        return "<div class='navigationItems'>
                 $menuHtml
                </div>";

    }
    private function createNavItem($text, $icon, $link){
        return "<div class='navigationItem'>
                   <a href='$link'>
                      <img class='navItemIcon' src='$icon'>
                      <span class='navItemLabel'>$text</span>
                    </a>
               </div>";
    }

    private function createSubsSection(){
        $subs = $this->userLoggedInObj->getVideoSubscriptions();
        $html = "<span class='heading'>Subscriptions</span>";
            foreach ($subs as $sub){
                $subUserName = $sub->getUserName();
                $html .= $this->createNavItem($subUserName,$sub->profilePic(), "profile.php?username=$subUserName");
            }
        return $html;
    }
}