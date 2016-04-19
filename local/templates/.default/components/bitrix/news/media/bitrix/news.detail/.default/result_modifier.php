<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); 

    //Get list of two previous news for block another news
    $arSort = array(
        $arParams["SORT_BY1"]=>$arParams["SORT_ORDER1"],
        $arParams["SORT_BY2"]=>$arParams["SORT_ORDER2"],
    );
    $arSelect = array(
        "ID",
        "NAME",
        "DETAIL_PAGE_URL",
        "PREVIEW_TEXT",
        "PREVIEW_PICTURE",
        "PROPERTY_PREVIEW"
    );                          
    $arFilter = array (
        "IBLOCK_ID" => $arResult["IBLOCK_ID"],
        "ACTIVE" => "Y",
        "CHECK_PERMISSIONS" => "Y",
    );
    $arNavParams = array(
        "nPageSize" => 2,
        "nElementID" => $arResult["ID"],
    );
    
    $arItems = Array();
    $rsElement = CIBlockElement::GetList($arSort, $arFilter, false, $arNavParams, $arSelect);
    $rsElement->SetUrlTemplates($arParams["DETAIL_URL"]);
    while($obElement = $rsElement->GetNextElement()) {
        $arItem =  $obElement->GetFields();
//        $arItem["PREVIEW_PICTURE_SRC"]=CFile::GetPath($arItem["PREVIEW_PICTURE"]);
        $arItem["PREVIEW_PICTURE_SRC"] = CFile::ResizeImageGet(CFile::GetFileArray($arItem["PREVIEW_PICTURE"]), array("width" => 350, "height" => 230), BX_RESIZE_IMAGE_EXACT);
        $arItems[] =  $arItem;
        if($arResult["ID"]==$arItem["ID"]) {
            end($arItems);
            $currentElementPos =  key($arItems);
        }
    }

    $elCount =  count($arItems);
    $preElem = 1;
    for ($i = $currentElementPos+1; $i <= $elCount-1; $i++) {
       $arResult["PREV_ELEMENT"][$preElem]=$arItems[$i];
       $preElem++; 
    }
?>