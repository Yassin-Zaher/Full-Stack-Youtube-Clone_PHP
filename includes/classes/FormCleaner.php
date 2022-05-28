<?php
class FormCleaner{
    public static function cleanFormString($inputText){
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        $inputText = strtolower($inputText);
        return ucfirst($inputText);
    }

    public static function cleanUserName($inputText){

        return str_replace(" ", "", $inputText);
    }
    public static function cleanEmail($inputText){
        $inputText = strip_tags($inputText);
        return str_replace(" ", "", $inputText);

    }

    public static function cleanPassword($inputText){
        return strip_tags($inputText);
    }

}
