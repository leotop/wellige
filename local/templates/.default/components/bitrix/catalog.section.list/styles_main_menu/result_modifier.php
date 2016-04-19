<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
 
 $items = array();
 //set sections structure in result array
 foreach ($arResult["SECTIONS"] as $arSection) {
    if ($arSection["IBLOCK_SECTION_ID"]) {
       $items[$arSection["IBLOCK_SECTION_ID"]]["SUBSECTIONS"][$arSection["ID"]] = $arSection; 
    }
    else {
       $items[$arSection["ID"]] = $arSection; 
    }
 }
 
 $arResult["ITEMS"] = $items;
 
 
?>