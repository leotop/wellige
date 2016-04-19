<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
    foreach ($arResult["ITEMS"] as $id=>$item) {
        foreach ($item["PROPERTIES"] as $pID=>$prop) {
            //получаем инфо о станции метро
            if ($prop["CODE"] == "METRO" && $prop["VALUE"]) {
                $el = CIBLockElement::GetList(array(),array("ID"=>$prop["VALUE"]),false,false,array("PROPERTY_LINE_COLOR","NAME"))->Fetch();
                $arResult["ITEMS"][$id]["PROPERTIES"][$pID]["VALUE"] = array("NAME"=>$el["NAME"],"LINE_COLOR"=>$el["PROPERTY_LINE_COLOR_VALUE"]); 
            }   
          
        }
    }

?>
