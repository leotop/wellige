<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();



foreach ($arResult["ITEMS"] as $i=>$arItem) {
   if ($arItem["PREVIEW_PICTURE"]["ID"]) {
       $pic = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"],array("width"=>446,"height"=>312), BX_RESIZE_IMAGE_EXACT);
       $arResult["ITEMS"][$i]["PREVIEW_PICTURE"]["SRC"] = $pic["src"];
   } 
   if ($arItem["PROPERTIES"]["LINK"]["VALUE"]) {
      $arResult["ITEMS"][$i]["DETAIL_PAGE_URL"] = $arItem["PROPERTIES"]["LINK"]["VALUE"]; 
   }
}

//собираем статьи в блоки по 4 штуки
$i=0;
$itemsBlocks = array();
foreach ($arResult["ITEMS"] as $arItem) {
  if (count($itemsBlocks[$i]) < 4 || !$itemsBlocks[$i]) {
     $itemsBlocks[$i][] = $arItem; 
  }  
  else {
     $itemsBlocks[$i+1][] = $arItem;
     $i++; 
  }
}   
 
$arResult["FIRST_BLOCK"] = $itemsBlocks[0];
unset($itemsBlocks[0]);
$arResult["ITEMS_BLOCKS"] = $itemsBlocks;

?>