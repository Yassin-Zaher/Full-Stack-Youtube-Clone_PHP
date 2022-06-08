<?php

class UserInfo{

    public $con, $sqlData;
    public function __construct($con, $userName) {
            $this->con = $con;

            $query = $this->con->prepare("SELECT * FROM user WHERE userName=:un");
            $query->bindParam(":un", $userName);
            $query->execute();

            $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
        }

    public function getUserName(){
          return $this->sqlData["userName"];
     }

    public function getFullName(){
        return $this->sqlData["firstName"] . " " . $this->sqlData["lastName"];
    }

    public function getFirstName(){
        return $this->sqlData["firstName"];
    }

    public function getLastName(){
        return $this->sqlData["lastName"];
    }

    public function getEmail(){
        return $this->sqlData["email"];
    }

    public function profilePic(){
        return $this->sqlData["profilePicture"];
    }

    public function isSubscribedTo($userTo){
        $query = $this->con->prepare("SELECT * FROM subscribers WHERE userTo=:userTo AND userFrom=:userFrom");
        //the username of the user LoggedIn

        $username = $this->getUserName();
        $query->bindParam(":userTo", $userTo);
        $query->bindParam(":userFrom", $username);
        $query->execute();

        // will return true if the user is subscribed
        return $query->rowCount() > 0;
    }

    public function getSubscribeCount(){
        $query = $this->con->prepare("SELECT * FROM subscribers WHERE userTo=:userTo");
        $username = $this->getUserName();
        $query->bindParam(":userTo", $username);

        $query->execute();

        return $query->rowCount();

    }




}