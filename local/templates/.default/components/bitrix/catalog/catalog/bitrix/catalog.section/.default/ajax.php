<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?  
    //arshow($_REQUEST);
    $ID = explode("-",$_REQUEST["id"]);
    $SECTION = $_REQUEST["section"];
    $type = $ID[0]; //r (rooms) or i (items)
    $value = $ID[1];
    
    //проверяем вложенность раздела. Если мы на 3 уровне - берем раздел-родитель
    $arSection = CIBlockSection::GetByID($SECTION)->Fetch();
    if ($arSection["DEPTH_LEVEL"] == 3) {
       $SECTION = $arSection["IBLOCK_SECTION_ID"]; 
    }
?>
<? if (is_array($ID) && ($type == "i" || $type == "r")) {

        switch ($type) {
            //rooms
            case "r": 
                $sections = CIBlockSection::GetList(array(),array("SECTION_ID"=>$value, "IBLOCK_ID"=>CATALOG_IBLOCK_ID));
                $sectionsCount = $sections->SelectedRowsCount();
                if (!$sectionsCount) {
                    $items = CIBlockElement::GetList(array(),array("SECTION_ID"=>$value,"IBLOCK_ID"=>CATALOG_IBLOCK_ID),false,false,array("ID","NAME","DETAIL_PICTURE","DETAIL_PAGE_URL"));    
                    $itemsCount = $items->SelectedRowsCount();
                }
                break;

                //items 
            case "i": 
                $items = CIBlockElement::GetList(array(),array("PROPERTY_PRODUCT_TYPE"=>$value,"SECTION_ID"=>$SECTION, "INCLUDE_SUBSECTIONS"=>"Y", "IBLOCK_ID"=>CATALOG_IBLOCK_ID),false,false,array("ID","NAME","DETAIL_PICTURE","DETAIL_PAGE_URL"));
                $itemsCount = $items->SelectedRowsCount();                   
                break;
        }       


        if ($itemsCount > 0 && !$sectionsCount) {
            while($arItem = $items->GetNext()) {?>
            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="collection-item js-filter-item">
                <?if ($arItem["DETAIL_PICTURE"]) {
                    $img = CFIle::ResizeImageGet($arItem["DETAIL_PICTURE"],array("width"=>685,"height"=>400),BX_RESIZE_IMAGE_PROPORTIONAL); 
                    $imgInfo = CFile::GetFileArray($arItem["DETAIL_PICTURE"]);               
                }?>
                <?if ($img["src"]) {?>
                    <img src="<?=$img["src"]?>" alt="<?=$imgInfo["DESCRIPTION"]?>"/>
                    <?}?>
                <span class="item-name"><?=$arItem["NAME"]?></span>
            </a>  
            <?}  
        }

        else if (!$itemsCount && $sectionsCount  > 0 ) {
            while($arSection = $sections->GetNext()) {?>
            <a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="collection-item collection-item--big js-filter-item">

                <?if ($arSection["PICTURE"]) {
                    $img = CFIle::ResizeImageGet($arSection["PICTURE"],array("width"=>685,"height"=>400),BX_RESIZE_IMAGE_PROPORTIONAL);
                    $imgInfo = CFile::GetFileArray($arSection["PICTURE"]);                
                }?>
                <?if ($img["src"]) {?>
                    <img src="<?=$img["src"]?>" alt="<?=$imgInfo["DESCRIPTION"]?>"/>
                    <?}?>
                <span class="item-name"><?=$arSection["NAME"]?></span>
            </a> 
            <?}
        }

    }
?>