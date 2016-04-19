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
<div class="menu__hidden js-hidden-column">

    <?foreach ($arResult["ITEMS"] as $arItem) {?>

    <div class="dropdown">
        <div class="dropdown__title menu__item __sub js-dropdown-trigger"><a href="<?=$arItem["SECTION_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></div>

        <div class="dropdown__body js-dropdown"> 
            <?foreach ($arItem["SUBSECTIONS"] as $subSection){?>
            <a href="<?=$subSection["SECTION_PAGE_URL"]?>" class="menu__item __sub"><?=$subSection["NAME"]?></a> 
            <?}?>  
        </div>

    </div>
    
    <?}?>
    
</div> 


