<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

    $sections = CIBlockSection::GetList(array(),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"]),false,false);
    while($arSection = $sections->Fetch()) {
        $arResult["SECTIONS"][$arSection["ID"]] = $arSection;
    }

    foreach($arResult["ITEMS"] as $arItem) {
        if ($arItem["IBLOCK_SECTION_ID"]) {
            $arResult["SECTIONS"][$arItem["IBLOCK_SECTION_ID"]]["ITEMS"][] = $arItem;
        }
    }

?>