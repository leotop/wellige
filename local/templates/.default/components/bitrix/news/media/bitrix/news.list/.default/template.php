<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    /** @var array $arParams */
    /** @var array $arResult */
    /** @global CMain $APPLICATION */
    /** @global CUser $USER */
    /** @global CDatabase $DB */
    /** @var CBitrixComponentTemplate $this */
    /** @var string $templateName */
    /** @var string $templateFile */
    /** @var string $templateFolder */
    /** @var string $componentPath */
    /** @var CBitrixComponent $component */
    $this->setFrameMode(true);
?>

<div class="media">
    <div class="wrapper">

        <?$APPLICATION->IncludeComponent("unisender.integration.custom:subscribe", "", Array(
                "AJAX_MODE" => "Y",    // Загрузка через AJAX
                "LIST_ID" => "6619594",    // Список контактов
                "USE_CACHE" => "Y",    // Кешировать компонент (3600 секунд)
                "WEB_FORM_ID" => "2",    // Форма подписки
                "COMPONENT_TEMPLATE" => ".default"
                ),
                false
            );?>

        <div class="media-section">

            <?
                $this->AddEditAction($arResult["FIRST_BLOCK"][0]['ID'], $arResult["FIRST_BLOCK"][0]['EDIT_LINK'], CIBlock::GetArrayByID($arResult["FIRST_BLOCK"][0]["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arResult["FIRST_BLOCK"][0]['ID'], $arResult["FIRST_BLOCK"][0]['DELETE_LINK'], CIBlock::GetArrayByID($arResult["FIRST_BLOCK"][0]["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>  
            <div class="media-item--main cf" id="<?=$this->GetEditAreaId($arResult["FIRST_BLOCK"][0]['ID']);?>">   

                <?if ($arResult["FIRST_BLOCK"][0]["PREVIEW_PICTURE"]["ID"]){?>
                    <a href="<?=$arResult["FIRST_BLOCK"][0]["DETAIL_PAGE_URL"]?>" class="media-item__image"> 
                        <?$img = CFIle::ResizeImageGet($arResult["FIRST_BLOCK"][0]["PREVIEW_PICTURE"]["ID"],array("width"=>700,"height"=>390),BX_RESIZE_IMAGE_EXACT)?>
                        <img src="<?=$img["src"]?>" alt=""> 
                    </a>
                    <?}?>
                <div class="media-item__body">
                    <?if ($arResult["FIRST_BLOCK"][0]["PROPERTIES"]["CATEGORY"]["VALUE"]){?>
                        <div class="media-item__source"><?=$arResult["FIRST_BLOCK"][0]["PROPERTIES"]["CATEGORY"]["VALUE"]?></div>
                        <?}?>
                    <div class="media-item__title"><?=$arResult["FIRST_BLOCK"][0]["NAME"]?></div>
                    <div class="media-item__text"><?=$arResult["FIRST_BLOCK"][0]["PREVIEW_TEXT"]?></div>     
                    <a href="<?=$arResult["FIRST_BLOCK"][0]["DETAIL_PAGE_URL"]?>" class="media-item__btn btn btn--greenbg"><?=$arResult["FIRST_BLOCK"][0]["PROPERTIES"]["BUTTON_TITLE"]["VALUE"]?></a> 

                </div>
            </div>

            <div class="media-item__list">
                <?foreach ($arResult["FIRST_BLOCK"] as $i=>$arItem) {
                        if ($i == 0) {continue;}
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>     
                    <div class="media-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <?if ($arItem["PREVIEW_PICTURE"]["SRC"]) {?>
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="media-item__image"> 
                                <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>">  
                            </a>
                            <?}?> 
                        <div class="media-item__body">
                            <div class="media-item__title"><?=$arItem["NAME"]?></div>
                            <div class="media-item__text"><?=$arItem["PREVIEW_TEXT"]?></div> 
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="media-item__btn btn btn--greenbg"><?=$arItem["PROPERTIES"]["BUTTON_TITLE"]["VALUE"]?></a> 
                        </div>
                    </div>
                    <?}?>   
            </div>

        </div>

        <?
            include($_SERVER["DOCUMENT_ROOT"]."/include/social_block.php");
        ?>

        <?if (is_array($arResult["ITEMS_BLOCKS"]) && count($arResult["ITEMS_BLOCKS"]) > 0) {?>
            <?foreach ($arResult["ITEMS_BLOCKS"] as $items) {?>

                <div class="media-section clear-padding">  
                    <?
                        $this->AddEditAction($items[0]['ID'], $arResult["FIRST_BLOCK"][0]['EDIT_LINK'], CIBlock::GetArrayByID($items[0]["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($items[0]['ID'], $arResult["FIRST_BLOCK"][0]['DELETE_LINK'], CIBlock::GetArrayByID($items[0]["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>  
                    <div class="media-item--main cf" id="<?=$this->GetEditAreaId($items[0]['ID']);?>">   

                        <?if ($items[0]["PREVIEW_PICTURE"]["ID"]){?>
                            <a href="<?=$items[0]["DETAIL_PAGE_URL"]?>" class="media-item__image"> 
                                <?$img = CFIle::ResizeImageGet($items[0]["PREVIEW_PICTURE"]["ID"],array("width"=>700,"height"=>390),BX_RESIZE_IMAGE_EXACT)?>
                                <img src="<?=$img["src"]?>" alt=""> 
                            </a>
                            <?}?>
                        <div class="media-item__body">
                            <?if ($items[0]["PROPERTIES"]["CATEGORY"]["VALUE"]){?>
                                <div class="media-item__source"><?=$items[0]["PROPERTIES"]["CATEGORY"]["VALUE"]?></div>
                                <?}?>
                            <div class="media-item__title"><?=$items[0]["NAME"]?></div>
                            <div class="media-item__text"><?=$items[0]["PREVIEW_TEXT"]?></div>     
                            <a href="<?=$items[0]["DETAIL_PAGE_URL"]?>" class="media-item__btn btn btn--greenbg"><?=$items[0]["PROPERTIES"]["BUTTON_TITLE"]["VALUE"]?></a> 

                        </div>
                    </div>

                    <div class="media-item__list">
                        <?foreach ($items as $i=>$arItem) {
                                if ($i == 0) {continue;}
                                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>     
                            <div class="media-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                <?if ($arItem["PREVIEW_PICTURE"]["SRC"]) {?>
                                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="media-item__image"> 
                                        <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>">  
                                    </a>
                                    <?}?> 
                                <div class="media-item__body">
                                    <div class="media-item__title"><?=$arItem["NAME"]?></div>
                                    <div class="media-item__text"><?=$arItem["PREVIEW_TEXT"]?></div> 
                                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="media-item__btn btn btn--greenbg"><?=$arItem["PROPERTIES"]["BUTTON_TITLE"]["VALUE"]?></a> 
                                </div>
                            </div>
                            <?}?>   
                    </div>  
                </div>  
                <?}?>
            <?}?>     

    </div>
</div>