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
<section class="payment-section">
    <div class="wrapper">
        <h2 class="payment-section__title">оплата</h2>
        <div class="payment-section__list">  
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>     
                <div class="payment-section__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="payment-section__item-image"> <img src="<?=CFile::GetPath($arItem["PROPERTIES"]["IMAGE"]["VALUE"])?>" alt="<?=$arItem["NAME"]?>"> </div>
                    <h3 class="payment-section__item-title"><?=$arItem["NAME"]?></h3>
                    <p class="payment-section__item-text"><?=$arItem["PREVIEW_TEXT"]?></p>
                </div>
                <?endforeach;?>              
        </div>
    </div>
</section>   

<section class="delivery-section">
    <div class="wrapper">
        <h2 class="delivery-section__title">доставка</h2>
        <div class="delivery-section__list cf">
            <a href="/shops-addresses/"><div class="btn btn--green">адреса магазинов</div></a>
            <?if (is_array($arResult["DELIVERY"]["moscow"])) {?>
            <div class="delivery-section__item">
                <h3><?=$arResult["DELIVERY"]["moscow"]["NAME"]?></h3>
                <p class="delivery-section__item-text">                        
                    <?=$arResult["DELIVERY"]["moscow"]["PREVIEW_TEXT"]?>
                </p>
            </div>
            <?}?>
           
           <?if (is_array($arResult["DELIVERY"]["russia"])) {?> 
            <div class="delivery-section__item">
                <h3><?=$arResult["DELIVERY"]["russia"]["NAME"]?></h3>
                <p class="delivery-section__item-text">
                    <?=$arResult["DELIVERY"]["russia"]["PREVIEW_TEXT"]?> 
                </p>
            </div>
            <?}?>
        </div> 
        <img class="delivery-section__image" src="/img/pages/payment/car.png" alt="">
        <?if (is_array($arResult["DELIVERY"]["delivery"])) {?>
        <div class="delivery-section__item">
            <h3><?=$arResult["DELIVERY"]["delivery"]["NAME"]?></h3>
            <p class="delivery-section__item-text">              
                <?=$arResult["DELIVERY"]["delivery"]["PREVIEW_TEXT"]?>
            </p>
        </div>
        <?}?>
    </div>
</section>
