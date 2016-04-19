<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//set main article
$arResult["MAIN_ARTICLE"] = $arResult["ITEMS"][0];
unset($arResult["ITEMS"][0]);
if ($arResult["MAIN_ARTICLE"]["PROPERTIES"]["LINK"]["VALUE"]) {
   $arResult["MAIN_ARTICLE"]["DETAIL_PAGE_URL"] = $arResult["MAIN_ARTICLE"]["PROPERTIES"]["LINK"]["VALUE"]; 
}  


foreach ($arResult["ITEMS"] as $i=>$arItem) {
   if ($arItem["PREVIEW_PICTURE"]["ID"]) {
       $pic = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"],array("width"=>446,"height"=>312), BX_RESIZE_IMAGE_EXACT);
       $arResult["ITEMS"][$i]["PREVIEW_PICTURE"]["SRC"] = $pic["src"];
   } 
   if ($arItem["PROPERTIES"]["LINK"]["VALUE"]) {
      $arResult["ITEMS"][$i]["DETAIL_PAGE_URL"] = $arItem["PROPERTIES"]["LINK"]["VALUE"]; 
   }
}

?>