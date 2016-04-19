<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

    /**
    * @global CMain $APPLICATION
    */

    global $APPLICATION;

    //delayed function must return a string
    if(empty($arResult))
        return "";

    $strReturn = '';


    $strReturn .= '<div class="breadcrumbs">';
    // т.к. битрикс не видит result_modifier для ХК, то придется фигачить здесь
    // удаляем из навигации тот раздел, на котором сейчас находимся
    //array_pop($arResult);
    $itemSize = count($arResult);
    for($index = 0; $index < $itemSize; $index++)
    {   // выкидываем раздел каталог из ХК, если он там есть
        if ($arResult[$index]["LINK"] == '/catalog/') {
            continue;
        }
        
        $title = htmlspecialcharsex($arResult[$index]["TITLE"]); 
        if ($index < $itemSize - 1){    
        $strReturn .= '<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" >'.$title.'</a>';
        } else {
          $strReturn .= '<span>'.$title.'</span>'; 
        }

    }

    $strReturn .= "</div>";

    return $strReturn;
?>