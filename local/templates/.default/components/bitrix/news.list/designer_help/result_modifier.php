<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$iblock = CIBlock::GetList(array(),array("ID"=>$arParams["IBLOCK_ID"]))->Fetch();
$arResult["IBLOCK"] = $iblock;
?>