<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

    $cityList = array();
    //список разделов (городов)
    $sections = CIBLockSection::GetList(array(),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"]),false,array("UF_*"));
    while($arSection = $sections->Fetch()) {
        $arResult["SECTIONS"][$arSection["ID"]] = $arSection;
        $arResult["CITY_LIST"][] = $arSection["NAME"];
    }   
    //список регионов
    $region = CUserFieldEnum::GetList(array(),array("USER_FIELD_ID"=>30));
    while($arRegion = $region->Fetch()) {
        $arResult["REGION_LIST"][$arRegion["ID"]] = $arRegion["VALUE"];
    } 
    //проверяем принадлежность пользователя к одному из доступных регионов
    if (in_array($_SESSION["GEOIP"]["region"],$arResult["REGION_LIST"])) {
        $userCity = $_SESSION["GEOIP"]["city"];
        $userRegion = $_SESSION["GEOIP"]["region"]; 
    } 
    else {
        $userCity = "Москва";
        $userRegion = "Московская область";
    }
    
    
    $arResult["USER_CITY"]["NAME"] = $userCity;
    $arResult["USER_CITY"]["REGION"] = $userRegion;
    
    foreach ($arResult["SECTIONS"] as $section) {
        if ($arResult["REGION_LIST"][$section["UF_REGION"]] == $arResult["USER_CITY"]["REGION"]) {
            $arResult["USER_CITY"]["COORDS"]["LAT"] = $section["UF_COORD_LAT"];
            $arResult["USER_CITY"]["COORDS"]["LNG"] = $section["UF_COORD_LNG"];
        }
    }
