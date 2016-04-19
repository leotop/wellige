<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

    foreach ($arResult["PROPERTIES"] as $pID=>$prop) {
        //получаем инфо о станциях метро
        if ($prop["CODE"] == "METRO" && is_array($prop["VALUE"]) && count($prop["VALUE"]) > 0) {
            unset($arResult["PROPERTIES"][$pID]["VALUE"]);
            $el = CIBLockElement::GetList(array(),array("ID"=>$prop["VALUE"]),false,false,array("PROPERTY_LINE_COLOR","NAME","ID"));
            while($arMetro = $el->Fetch()) {
                $arResult["PROPERTIES"][$pID]["VALUE"][] = array("NAME"=>$arMetro["NAME"],"LINE_COLOR"=>$arMetro["PROPERTY_LINE_COLOR_VALUE"],"ID"=>$arMetro["ID"]); 
            }
        }

        //получаем доп фото
        if ($prop["CODE"] == "MORE_FOTO" && is_array($prop["VALUE"]) && count($prop["VALUE"]) > 0) {   
            foreach ($prop["VALUE"] as $fID=>$foto) {
                $arFoto = CFile::ResizeImageGet($foto,array("width"=>446,"height"=>312),BX_RESIZE_IMAGE_EXACT);
                $arResult["PROPERTIES"][$pID]["VALUE"][$fID] = $arFoto;             
                $arResult["PROPERTIES"][$pID]["ORIGINAL_VALUE"][$fID] = CFile::GetFileArray($foto);
            }
        }
    }

    //собираем схемы проезда
    $arSelect = Array("ID","IBLOCK_ID","PROPERTY_SHOP","PROPERTY_METRO.NAME","PROPERTY_METRO.PROPERTY_LINE_COLOR", "PROPERTY_TEXT_AREA");
    $arFilter = Array("IBLOCK_CODE" => "route_schemes", "ACTIVE"=>"Y", "PROPERTY_SHOP"=>$arResult["ID"]);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->Fetch()){
        $arResult["METRO"][] = array("COLOR"=>$ob["PROPERTY_METRO_PROPERTY_LINE_COLOR_VALUE"],"NAME"=>$ob["PROPERTY_METRO_NAME"],"DESCRIPTION"=>$ob["PROPERTY_TEXT_AREA_VALUE"]); 
    }     