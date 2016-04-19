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
<div class="wrapper">
    <div class="franchise-label">
        <h2 class="franchise-label__title">Wellige сотрудничает с дизайнерами и студиями</h2>
        <div class="franchise-label__text"><?=$arResult["DESCRIPTION"]?></div>
    </div>
</div>
<section class="designerhelp-profits">
    <div class="wrapper">
        <div class="designerhelp-profits__list">          
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>                          
                <div class="designerhelp-profits__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="designerhelp-profits__image"> <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt=""> </div>
                    <h3 class="designerhelp-profits__item-title"><?=$arItem["NAME"]?></h3>
                    <div class="designerhelp-profits__item-text"><?=$arItem["PREVIEW_TEXT"]?></div>
                </div>  
                <?endforeach;?>
        </div>
    </div>
</section>   
<div class="designerhelp-conditions">
    <div class="wrapper">
        <h2 class="designerhelp-conditions__title">Условия предоставления консультации</h2>
        <div class="designerhelp-conditions__text">
        <?$APPLICATION->IncludeFile(SITE_DIR."include/designer_help.php", Array(),Array("MODE"=>"html"));?>
        </div>
    </div>
</div>
                    
                        
                    

