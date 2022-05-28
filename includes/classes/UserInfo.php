<?php

class UserInfo
{
        private $fname, $lname, $email, $pass, $username;
        public function __construct($fname, $lname, $email, $pass, $username){
            $this->fname = $fname;
            $this->fname = $lname;
            $this->email = $email;
            $this->pass = $pass;
            $this->username = $username;
        }

        public function insertUser($con){
            $query = $con->prepare("INSERT INTO videos(firstName, lastName, email, password, userName)
                                        VALUES(:firstName, :lastName, :email, :password, :userName)");
            $query->bindParam(":firstName", $this->fname);
            $query->bindParam(":lastName", $this->lname);
            $query->bindParam(":email", $this->email);
            $query->bindParam(":password", $this->pass);
            $query->bindParam(":userName", $this->username);
            return $query->execute();

        }

}