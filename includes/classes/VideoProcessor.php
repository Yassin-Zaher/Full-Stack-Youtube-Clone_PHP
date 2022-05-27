<?php
define ('SITE_ROOT', realpath(dirname(__FILE__)));
class VideoProcessor {
    private $connection;
    private $maxFileSize = 50000000;
    private $allowedTypes = array("3GPP", "mp4", "AVI", "FLV", "MOV", "MPEG4", "MPEGPS", "WebM" ,"WMV");
    public function __construct($con) {
        $this->connection = $con;
    }

    public function upload($videoUploadData){
        $targetDir = "uploads/videos/";
        $videoData = $videoUploadData->videoDataArray;
        $tempFilePath = $targetDir . uniqid() . basename($videoData["name"]);

        $tempFilePath.str_replace(" ", "_", $tempFilePath);
        $isValidData = $this->processData($videoData,  SITE_ROOT.$tempFilePath);

        if(!$isValidData){
            return false;
        }

        if(move_uploaded_file($videoData["tmp_name"] , $tempFilePath)) {
            $finalFilePath = $targetDir . uniqid() . "mp4";

            //inset the video into the video table
            if(!$this->insertVideoData($videoUploadData, $finalFilePath)){
                echo "upload file failed :(";
                return false;
            }
        };



    }
    private function processData($videoData, $tempFilePath) {
        $videoType = pathinfo($tempFilePath, PATHINFO_EXTENSION);
        if(!$this->isValidSize($videoData)){
            echo "File too large Can't be more than ". $this->maxFileSize;
            return false;
        }
        elseif (!$this->isValidType($videoType)) {
            echo "This video format is not accepted :(";
            return false;
        }
        elseif ($this->hasError($videoData)){
            echo "Error Code" . $videoData["error"];
            return false;
        }

        return true;
    }

    private function isValidSize($data) {
        return $data["size"] <= $this->maxFileSize;
    }

    private function isValidType($type) {
            $lowerCased = strtolower($type);
            return in_array($lowerCased, $this->allowedTypes);

    }

    private function hasError($data){
        return $data["error"] != 0;
    }

    private function insertVideoData($uploadData, $filePath) {
        $query = $this->connection->prepare("INSERT INTO videos(title, uploadedBy, description, privacy, category, filePath)
                                          VALUES(:title, :uploadedBy, :description, :privacy, :category, :filePath)");
        $query->bindParam(":title", $uploadData->title);
        $query->bindParam(":uploadedBy", $uploadData->uploadedBy);
        $query->bindParam(":description", $uploadData->description);
        $query->bindParam(":privacy", $uploadData->privacy);
        $query->bindParam(":category", $uploadData->category);
        $query->bindParam(":filePath", $filePath);

        return $query->execute();
    }



}
