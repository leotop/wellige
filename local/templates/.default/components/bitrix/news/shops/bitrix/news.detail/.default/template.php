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

<style>
    .subway.main_metro::before {
        width:0 !important;
        margin:0 !important;
    }
    <?foreach ($arResult["PROPERTIES"]["METRO"]["VALUE"] as $metro) {?>
        .subway.main_metro_<?=$metro["ID"]?>::before {
            background-color: #<?=$metro["LINE_COLOR"]?>;
        }
        <?}?>
</style> 

<section class="store">
    <div class="store__inner wrapper">
        <?$img = CFIle::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"],array("width"=>446, "height"=>292), BX_RESIZE_IMAGE_EXACT)?>
        <div class="store__img"><img src="<?=$img["src"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["DESCRIPTION"]?>"></div>
        <div class="store__info">
            <div class="store__contacts">
                <p>Прием заказов и консультирование</p>
                <div class="store__phone"><?=$arResult["PROPERTIES"]["PHONE"]["VALUE"]?></div>
                <p><?=$arResult["PROPERTIES"]["REGIME"]["VALUE"]?></p>
            </div>
            <div class="store__way">

                <?if (is_array($arResult["PROPERTIES"]["METRO"]["VALUE"])) {?>
                    <?foreach ($arResult["PROPERTIES"]["METRO"]["VALUE"] as $metro) {?>
                        <div class="store__adress subway main_metro_<?=$metro["ID"]?>">м. <?=$metro["NAME"]?></div> 
                        <?}?>
                    <div class="store__adress subway main_metro"><?=$arResult["PROPERTIES"]["ADDRESS"]["VALUE"]?></div> 

                    <?} else {?>
                    <div class="store__adress subway main_metro"><?=$arResult["PROPERTIES"]["ADDRESS"]["VALUE"]?></div> 
                    <?}?>

                <?if ($arResult["PROPERTIES"]["SCHEME"]["VALUE"]) {?>
                    <a href="#boutique" class="btn btn--green js-scroll-link">как найти в здании</a> 
                    <?}?>
            </div>
        </div>
    </div>
</section>

<?if ($arResult["PROPERTIES"]["COORD_LAT"]["VALUE"] && $arResult["PROPERTIES"]["COORD_LNG"]["VALUE"]) {?>
    <section class="store-map">
        <div class="store-map js-store-map" id="map" data-lat="<?=$arResult["PROPERTIES"]["COORD_LAT"]["VALUE"]?>" data-lng="<?=$arResult["PROPERTIES"]["COORD_LNG"]["VALUE"]?>" data-name="<?=$arResult["NAME"]?>" data-address="<?=$arResult["PROPERTIES"]["ADDRESS"]["VALUE"]?>"></div>
    </section>
    <?}?>

<section class="howtoget">
    <div class="howtoget__inner wrapper">
        <h2 class="howtoget__title">как проехать</h2>

        <?if (is_array($arResult["METRO"]) && count ($arResult["METRO"]) > 0) {?>
        
            <div class="howtoget__column">  
                <h3 class="howtoget__subtitle">Общественным транспортом</h3>
                <?foreach ($arResult["METRO"] as $station){?> 
                    <div class="howtoget__text subway"><span style="background-color: #<?=$station["COLOR"]?>;"></span>м. <?=$station["NAME"]?>. <?=$station["DESCRIPTION"]["TEXT"]?></div>
                    <?}?>  
            </div>
            <?}?>

        <div class="howtoget__column">
            <?if (is_array($arResult["PROPERTIES"]["CAR"]["VALUE"]) && count($arResult["PROPERTIES"]["CAR"]["VALUE"]) > 0) {?>
                <h3 class="howtoget__subtitle">на автомобиле</h3>
                <?foreach ($arResult["PROPERTIES"]["CAR"]["VALUE"] as $value){?>
                    <div class="howtoget__text "><?=$value?></div>
                    <?}?>
                <?}?>

            <?if ($arResult["PROPERTIES"]["GPS"]["VALUE"] && $arResult["PROPERTIES"]["GPS_2"]["VALUE"]){?>
                <div class="howtoget__text">
                    <b>Координаты для GPS навигатора:</b><br>
                    Широта: <?=$arResult["PROPERTIES"]["GPS"]["VALUE"]?><br>
                    Долгота: <?=$arResult["PROPERTIES"]["GPS_2"]["VALUE"]?>
                </div>  
                <?}?>     
        </div>      

    </div>
</section>

<?if (is_array($arResult["PROPERTIES"]["MORE_FOTO"]["VALUE"]) && count($arResult["PROPERTIES"]["MORE_FOTO"]["VALUE"]) > 0) {?>
    <section class="store-images wrapper">    
        <div class="carousel__nav store-images__nav"></div>
        <div class="store-images__inner wrapper js-store-images">

            <?foreach ($arResult["PROPERTIES"]["MORE_FOTO"]["VALUE"] as $fID=>$foto) {?>
                <div class="store-images__item js-open-gallery" data-id="<?=$fID?>"><img src="<?=$foto["src"]?>" alt="<?=$arResult["PROPERTIES"]["MORE_FOTO"]["ORIGINAL_VALUE"][$fID]["DESCRIPTION"]?>"></div>                
                <?}?>               
                  
        </div>
    </section>
    <?}?>

<?if ($arResult["PROPERTIES"]["SCHEME"]["VALUE"]) {?>    
    <section class="boutique">

        <div class="wrapper" id="boutique" >
            <h2 class="boutique__title">как найти салон в здании</h2>
        </div>

        <div class="boutique__inner">
            <div class="wrapper">
                <div class="boutique__entry">
                    <img src="<?=CFIle::GetPath($arResult["PROPERTIES"]["SCHEME"]["VALUE"])?>" alt="как найти салон в здании"> 
                </div>
            </div> 
        </div>
    </section>
    <?}?>     