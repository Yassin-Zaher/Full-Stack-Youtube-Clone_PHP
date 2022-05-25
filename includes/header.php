<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <!-- CSS only -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

          <link rel="stylesheet" href="assets/style.css">
          <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
          <!-- JavaSc ript Bundle with Popper -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
          <script src="./assets/js/commonActions.js"></script>
          <title>ME-TUBE</title>
</head>
<body>
          <div id="page-container">
                    <div id="mast-head-container">

                      <button class="navShowHide">
                              <img src="./assets/images/icons/menu.png">
                     </button>

                    <a href="index.php" class="logoContainer">
                        <img src="./assets/images/youtube-logo.png" title="logo" alt="site-logo">
                    </a>

                    <div class="searchBarContainer">
                              <form action="search.php" method="GET">
                                    <input type="text" class="searchBar" name="term" placeholder="Search..."> 
                                    <button class="searchButton">
                                       <img src="./assets/images/icons/search.png">
                                    </button>
                              </form>
                    </div>

                    <div class="rightIcon">
                              <a href="upload.php">
                                 <img class="upload" src="./assets/images/icons/upload.png">  
                              </a>
                              <a href="#">
                                 <img class="profile" src="./assets/images/profile.png">  
                              </a>
                    </div>

                    </div>
                    <div id="side-nav-container" style="display:none">
                         side nav container
                    </div>
                    <div id="main-section-container">
                              <div id="main-content-container">