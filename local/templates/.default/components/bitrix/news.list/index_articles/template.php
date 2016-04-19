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
<div class="media-section">  

    <?//main article?>
    <?
        $this->AddEditAction($arResult["MAIN_ARTICLE"]['ID'], $arResult["MAIN_ARTICLE"]['EDIT_LINK'], CIBlock::GetArrayByID($arResult["MAIN_ARTICLE"]["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arResult["MAIN_ARTICLE"]['ID'], $arResult["MAIN_ARTICLE"]['DELETE_LINK'], CIBlock::GetArrayByID($arResult["MAIN_ARTICLE"]["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="media-item--main cf" id="<?=$this->GetEditAreaId($arResult["MAIN_ARTICLE"]['ID']);?>">   
        <?if ($arResult["MAIN_ARTICLE"]["PREVIEW_PICTURE"]["ID"]){?>
            <a href="<?=$arResult["MAIN_ARTICLE"]["DETAIL_PAGE_URL"]?>" class="media-item__image"> 
            <?$img = CFIle::ResizeImageGet($arResult["MAIN_ARTICLE"]["PREVIEW_PICTURE"]["ID"],array("width"=>700,"height"=>390),BX_RESIZE_IMAGE_EXACT)?>
                <img src="<?=$img["src"]?>" alt=""> 
            </a>
            <?}?>
        <div class="media-item__body">        
            <div class="media-item__title"><?=$arResult["MAIN_ARTICLE"]["NAME"]?></div>
            <div class="media-item__text"><?=$arResult["MAIN_ARTICLE"]["PREVIEW_TEXT"]?></div> 
            <a href="<?=$arResult["MAIN_ARTICLE"]["DETAIL_PAGE_URL"]?>" class="media-item__btn btn btn--greenbg"><?=$arResult["MAIN_ARTICLE"]["PROPERTIES"]["BUTTON_TITLE"]["VALUE"]?></a> 
        </div>
    </div>
    <?//main article end?>


    <div class="media-item__list">
        <?foreach ($arResult["ITEMS"] as $arItem) {?>
            <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="media-item media-item--hover" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="media-item__image"> 
                    <?if ($arItem["PREVIEW_PICTURE"]["SRC"]) {?>
                        <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt=""> 
                        <?}?>
                </div>
                <div class="media-item__body">
                    <div class="media-item__title"><?=$arItem["NAME"]?></div>
                    <div class="media-item__text"><?=$arItem["PREVIEW_TEXT"]?></div>
                </div>
            </a>
            <?}?> 
    </div>

</div>

