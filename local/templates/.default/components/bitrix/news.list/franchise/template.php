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
        <h2 class="franchise-label__title">Wellige — это доступная европейская мебель</h2>
        <div class="franchise-label__text"><?=$arResult["IBLOCK"]["DESCRIPTION"]?></div>
    </div>
</div>
<section class="franchise-worth">
    <div class="wrapper">
        <div class="franchise-list">
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                    if ($arItem["PROPERTIES"]["CONDITION"]["VALUE"]) {continue;}
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>  
                <div class="franchise-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="franchise-list__image"><img src="<?=CFIle::GetPath($arItem["PROPERTIES"]["IMAGE"]["VALUE"])?>" alt="<?=$arItem["NAME"]?>"></div>
                    <h2 class="franchise-list__title"><?=$arItem["NAME"]?></h2>
                    <div class="franchise-list__text"><?=$arItem["PREVIEW_TEXT"]?></div>
                </div>
                <?endforeach;?>
        </div>
    </div>
</section>        

<section class="franchise-conditions">
    <div class="wrapper">
        <h1 class="franchise-conditions__title">Условия предоставления</h1>
        <div class="franchise-list">
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                    if (!$arItem["PROPERTIES"]["CONDITION"]["VALUE"]) {continue;}
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>  
                <div class="franchise-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="franchise-list__image"><img src="<?=CFIle::GetPath($arItem["PROPERTIES"]["IMAGE"]["VALUE"])?>" alt="<?=$arItem["NAME"]?>"></div>
                    <h2 class="franchise-list__title"><?=$arItem["NAME"]?></h2>
                    <div class="franchise-list__text"><?=$arItem["PREVIEW_TEXT"]?></div>
                </div>                 
                <?endforeach;?>


        </div>
    </div>
</section>