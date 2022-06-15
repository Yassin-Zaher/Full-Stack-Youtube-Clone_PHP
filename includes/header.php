<?php
include_once("config.php");
include_once ("head.php");
include_once("classes/UserInfo.php");
require_once("classes/Video.php");
require_once("classes/VideoGrid.php");
require_once("classes/VideoGridItem.php");
require_once("classes/SubscriptionsProvider.php");
require_once("classes/ButtonProvider.php");
require_once("classes/NavigationMenuProvider.php");
require_once("classes/TrendingProvider.php");




$userLoggedIn = isset($_SESSION["userLoggedIn"]) ? $_SESSION["userLoggedIn"] : "";

$user = new UserInfo($con, $userLoggedIn);

?>

<body>
          <div id="page-container">
                    <div id="mast-head-container">

                              <button class="navShowHide">
                                        <img src="./assets/images/icons/menu.png">
                              </button>

                              <a href="index.php" class="logoContainer">
                                        <img src="assets\images\icons\VideoTubeLogo.png" title="logo" alt="site-logo">
                              </a>

                              <div class="searchBarContainer">
                                        <form id="searchForm" action="search.php" method="GET">
                                                  <input type="text" class="searchBar" name="term" id="mySearchTerm" placeholder="Search...">
                                                  <button class="searchButton">
                                                            <img src="./assets/images/icons/search.png">
                                                  </button>
                                        </form>
                              </div>

                              <div class="rightIcon">
                                        <a href="upload.php" class="uploadImgContainer">
                                                  <img class="upload" src="assets/images/icons/upload.png">
                                        </a>
                                        <?php
                                        echo ButtonProvider::createSignInButton($con, $userLoggedIn);
                                        ?>
                              </div>

                    </div>
                    <div id="side-nav-container" style="display:none">
                              <?php

                              $navigationMenuProvider = new NavigationMenuProvider($con, $user);
                              echo $navigationMenuProvider->create();
                              ?>
                    </div>
                    <div id="main-section-container">
                              <div id="main-content-container">