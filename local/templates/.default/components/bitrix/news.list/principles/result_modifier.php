<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

    //get section list for iblock
    $sectionList = array();
    $sectionCodes = array();
    $section = CIBlockSection::GetList(array("SORT"=>"ASC"),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"]));
    while($arSection =$section->Fetch()) {
        $sectionList[] = $arSection;
        $sectionCodes[$arSection["ID"]] = $arSection;  
    }
    
    $arResult["SECTIONS"] = $sectionList;
    
    //add items structure
    foreach ($arResult["ITEMS"] as $arItem) {
      $arResult["ITEMS_BY_SECTIONS"][$arItem["IBLOCK_SECTION_ID"]][] = $arItem;  
    }

?>