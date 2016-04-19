<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
    $deliveryItems = CIBlockElement::GetList(array(),array("IBLOCK_CODE"=>"delivery"),false,false,array("ID","NAME","PREVIEW_TEXT","CODE"));
    while($arDelivery = $deliveryItems->Fetch()) {
        $arResult["DELIVERY"][$arDelivery["CODE"]] = $arDelivery;
    }
    
?>