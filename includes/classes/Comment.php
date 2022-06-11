<?php
require_once("ButtonProvider.php");
require_once("CommentControls.php");
class Comment {

    private $con, $sqlData, $userLoggedInObj, $videoId;

    public function __construct($con, $input, $userLoggedInObj, $videoId) {

        if(!is_array($input)) {
            $query = $con->prepare("SELECT * FROM comments where id=:id");
            $query->bindParam(":id", $input);
            $query->execute();

            $input = $query->fetch(PDO::FETCH_ASSOC);
        }

        $this->sqlData = $input;
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
        $this->videoId = $videoId;
    }

    public function create() {
        //getting comment info
        $id = $this->sqlData["id"];
        $videoId = $this->getVideoId();
        $body = $this->sqlData["body"];
        $postedBy = $this->sqlData["postedBy"];
        $profileButton = ButtonProvider::createUserProfileButton($this->con, $postedBy);
        $timespan = $this->time_elapsed_string($this->sqlData["datePosted"]);

        $commentControlsObj = new CommentControls($this->con, $this, $this->userLoggedInObj);
        $commentControls = $commentControlsObj->create();

        //handle the number of replies
        $numResponses = $this->getNumberOfRelies();


        if($numResponses > 0){
            $viewRepliesText = "<span class='repliesSection viewReplies' onclick='getReplies($id, this, $videoId)'>
                                    View all $numResponses replies
                                 </span>";
        } else {
            $viewRepliesText = "<div class='repliesSection'></div>";
        }
        return "<div class='itemContainer'>
                    <div class='comment'>
                        $profileButton

                        <div class='mainContainer'>

                            <div class='commentHeader'>
                                <a href='profile.php?username=$postedBy'>
                                    <span class='username'>$postedBy</span>
                                </a>
                                <span class='timestamp'>$timespan</span>
                            </div>

                            <div class='body'>
                                $body
                            </div>
                            <div class='body'>
                                $commentControls
                                $viewRepliesText
                            </div>
                        </div>
         
                    </div>
                </div>";


    }

    private function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    public function getId() {
        return $this->sqlData["id"];
    }

    public function wasDisLikedBy(){

        $id = $this->getId();
        $username = $this->userLoggedInObj->getUserName();
        $query = $this->con->prepare("SELECT * FROM dislikes WHERE username=:username AND commentId=:commentId");
        $query->bindParam("username", $username);
        $query->bindParam("commentId", $id);
        $query->execute();

        return $query->rowCount() > 0;
    }

    public function wasLikedBy(){
        $id = $this->getId();
        $username = $this->userLoggedInObj->getUserName();
        $query = $this->con->prepare("SELECT * FROM likes WHERE username=:username AND commentId=:commentId");
        $query->bindParam("username", $username);
        $query->bindParam("commentId", $id);
        $query->execute();

        return $query->rowCount() > 0;
    }

    public function getVideoId() {
        return $this->videoId;
    }

    public function getLikes() {
        $query = $this->con->prepare("SELECT count(*) as 'count' FROM likes WHERE commentId=:commentId");
        $query->bindParam(":commentId", $commentId);
        $commentId = $this->getId();
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);
        $numLikes = $data["count"];

        $query = $this->con->prepare("SELECT count(*) as 'count' FROM dislikes WHERE commentId=:commentId");
        $query->bindParam(":commentId", $commentId);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);
        $numDislikes = $data["count"];

        return $numLikes - $numDislikes;
    }

    public function getNumberOfRelies(){
        $commentId = $this->sqlData["id"];
        $query = $this->con->prepare("SELECT count(*) FROM comments WHERE responseTo=:responseTo");
        $query->bindParam(":responseTo", $commentId);
        $query->execute();

        return $query->fetchColumn();
    }

    public function like(){
        $id = $this->getId();
        $username = $this->userLoggedInObj->getUserName();

        if($this->wasLikedBy()){
            //DELETE FROM `likes` WHERE `likes`.`id` = 4
            $query = $this->con->prepare("DELETE FROM likes WHERE username=:username AND commentId=:commentId");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $id);
            $query->execute();

            $result = array(
                "likes" => -1,
                "dislikes" => 0
            );
            return json_encode($result);


        }else {
            $query = $this->con->prepare("DELETE FROM dislikes WHERE username=:username AND commentId=:commentId");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $id);
            $query->execute();

            $query = $this->con->prepare("INSERT INTO likes(username, commentId) VALUES (:username, :commentId)");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $id);
            $query->execute();

            $count = $query->rowCount();
            $result = array(
                "likes" => 1,
                "dislikes" => $count - 1
            );
            return json_encode($result);
        }

    }


    public function disLike(){
        $id = $this->getId();
        $username = $this->userLoggedInObj->getUserName();

        if($this->wasDisLikedBy()){
            // in this case the user is removing the dislike
            $query = $this->con->prepare("DELETE FROM dislikes WHERE username=:username AND commentId=:commentId");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $id);
            $query->execute();

            $result = array(
                "likes" => 0,
                "dislikes" => -1
            );
            return json_encode($result);
        }

        else {
            // in this case the user is adding a dislike
            $query = $this->con->prepare("DELETE FROM likes WHERE username=:username AND commentId=:commentId");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $id);
            $query->execute();

            $count = $query->rowCount();

            $query = $this->con->prepare("INSERT INTO dislikes(username, commentId) VALUES (:username, :commentId)");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $id);
            $query->execute();


            $result = array(
                "likes" => 0 - $count,
                "dislikes" => 1
            );
            return json_encode($result);
        }


    }

    public function getReplies() {
        $id = $this->getId();
        $query = $this->con->prepare("SELECT * FROM comments WHERE responseTo=:commentId ORDER BY datePosted ASC");
        $query->bindParam(":commentId", $id);



        $query->execute();

        $comments = "";
        $videoId = $this->getVideoId();
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $comment = new Comment($this->con, $row, $this->userLoggedInObj, $videoId);
            $comments .= $comment->create();
        }

        return $comments;
    }




}
?>