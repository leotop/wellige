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
<script>   
    shopsAddresses = {"objects": [
        <?foreach($arResult["ITEMS"] as $arItem):?>
            {
                "name": "<?=$arItem["NAME"]?>",
                "url": "<?=$arItem["DETAIL_PAGE_URL"]?>",
                "address": "<?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"]?>",
                "lat": "<?=$arItem["PROPERTIES"]["COORD_LAT"]["VALUE"]?>",
                "lng": "<?=$arItem["PROPERTIES"]["COORD_LNG"]["VALUE"]?>"
            },
            <?endforeach;?>
        ]
    };   
</script>
<div class="wrapper contacts__rightsection">
	<div class="wheretobuy__contacts">
		<a href="tel:+74997053088"><div class="wheretobuy__phone">+7 (499) 705-30-88</div></a>
		<div class="wheretobuy__info">единая справочная</div>
	</div>
</div>
<section class="wheretobuy">
    <div class="wheretobuy__map js-stores-map" id="map" data-lat="55.584986" data-lng="37.721001" data-marker-url="/img/icons/pin.png" data-marker-hover="/img/icons/pin-hover.png" data-marker-group-url="/img/icons/pin-group.png"
        data-objects-url=""></div>
    <div class="wheretobuy__help">
        <div class="wrapper wheretobuy__help-inner">
            <div class="wheretobuy__help-text"> Не смогли найти салон в своем городе?
                <br> Мы осуществляем доставку по всей России! </div>
            <div class="btn btn--greenbg">интернет-магазин</div>
        </div>
    </div>
</section>  
<div class="city-popup mfp-hide js-city-popup" id="city-popup">
    <div class="city-popup__close js-close-popup"></div>         
    <div class="city-popup__inner js-city-popup-inner">   
        <div class="city-popup__title">Ваш город <?=$arResult["USER_CITY"]["NAME"]?>?</div>
        <div class="city-popup__btns">
            <div class="btn btn--greenbg js-close-popup js-go-to-map" data-lat="<?=$arResult["USER_CITY"]["COORDS"]["LAT"]?>" data-lng="<?=$arResult["USER_CITY"]["COORDS"]["LNG"]?>" data-zoom="9">да</div>
            <div class="btn btn--green js-select-city">выбрать другой город</div>
        </div>
    </div>        
    <div class="city-popup__select js-city-list">
        <div class="city-popup__title">Выберите ваш город</div>
        <div class="city-popup__list">
            <div class="city-popup__column">
                <?foreach ($arResult["SECTIONS"] as $section){?>
                    <div class="city-popup__city js-city-item js-go-to-map" data-lat="<?=$section["UF_COORD_LAT"]?>" data-lng="<?=$section["UF_COORD_LNG"]?>" data-zoom="10"> <a href="#!"><?=$section["NAME"]?></a> </div>
                    <?}?>                    
            </div>
        </div>
    </div>
</div>