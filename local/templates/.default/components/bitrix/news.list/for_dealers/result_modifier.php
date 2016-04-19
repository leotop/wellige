<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//get iblock info
$iblock = CIBlock::GetList(array(),array("ID"=>$arParams["IBLOCK_ID"]))->Fetch();
$arResult["IBLOCK"] = $iblock; 

?>