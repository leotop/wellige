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

<?foreach($arResult["SECTIONS"] as $arSection):?>        

    <section class="care">
        <div class="care__title-wrap">
            <h4 class="wrapper care__title">
                <span>
                    <?=$arSection["NAME"]?>
                </span>
            </h4> 
        </div>

        <div class="wrapper">               
            <div class="care__inner">
                <?foreach ($arSection["ITEMS"] as $arItem) {?>
                    <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="care-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">                         
                        <div class="care-item__icon"> <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="" /> </div>
                        <div class="care-item__text"><?=$arItem["PREVIEW_TEXT"]?></div>
                    </div> 
                    <?}?>               
            </div>
        </div>
    </section>

    <?endforeach;?>    

          