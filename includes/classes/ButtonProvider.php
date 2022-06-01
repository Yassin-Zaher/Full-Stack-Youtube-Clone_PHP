<?php

class ButtonProvider{
    public static function createButton($text, $imagSrc, $action, $class){
        $image = ($imagSrc == null) ? "" : "<img src='$imagSrc'>";

        //TODO: Handle the Action For Our button
        return "<button class='$class' onclick='$action'>
                    $image
                  <span>$text</span>
               </button>";
    }

}