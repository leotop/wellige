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
    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "nav-chain", array(
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => "-"
            ),
            false,
            Array('HIDE_ICONS' => 'Y')
        );?> 
    <h1><?=$arResult["NAME"]?></h1>
    <? if (!empty($arResult["PROPERTIES"]["VENDOR_CODE"]["VALUE"]) && ($arResult["PROPERTIES"]["VENDOR_CODE"]["VALUE"][0]!='*')){?>
        <div class="library-articul">Артикул <?=$arResult["PROPERTIES"]["VENDOR_CODE"]["VALUE"]?></div>
        <?}?>
</div>


<?if (is_array($arResult["OFFERS"]) && count($arResult["OFFERS"]) > 0) {//товар с торговыми предложениями?>
    <div class="product">
        <div class="wrapper cf">   


            <?foreach ($arResult["OFFERS"] as $o=>$offer) {?>

                <div class="product__image-wrap <?if($o == 0){?>__selected<?}?>" data-color="<?=$offer["ID"]?>">
                    <div class="product__image js-image-slider" data-offer="<?=$offer["ID"]?>"> 
                        <?if ($offer["DETAIL_PICTURE"]["SRC"]){?>
                            <img class="js-color-image "  src="<?=$offer["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$offer["DETAIL_PICTURE"]["DESCRIPTION"]?>" data-color="<?=$offer["ID"]?>" data-offer="<?=$offer["ID"]?>">
                            <?}?>
                        <?if (is_array($offer["PROPERTIES"]["MORE_FOTO"]["VALUE"]) && count($offer["PROPERTIES"]["MORE_FOTO"]["VALUE"]) > 0) {?>
                            <?foreach ($offer["PROPERTIES"]["MORE_FOTO"]["VALUE"] as $f=>$foto) {?>
                                <img class="js-color-image <?if($f == 0){?>__selected<?}?>" src="<?=$foto?>" alt="<?=$offer["DETAIL_PICTURE"]["DESCRIPTION"]?>" data-offer="<?=$offer["ID"]?>">
                                <?}?> 
                            <?}?>
                    </div>
                    <div class="product__thumbnails js-thumbnails" data-offer="<?=$offer["ID"]?>"></div>
                </div>  

                <?}?> 


            <div class="product__right">
                <div class="library-colors__list">
                    <?foreach ($arResult["OFFERS"] as $o=>$offer) {?>
                        <?//arshow($offer["PROPERTIES"]["COLOR"])?>
                        <div class="library-colors__item">
                            <div class="library-colors__item-color js-item-color <?if($o == 0){?>__selected<?}?>" data-color="<?=$offer["ID"]?>" style="background-image: url(<?=$arResult["COLORS_LIST"][$offer["PROPERTIES"]["COLOR"]["VALUE"]]["COLOR_TEMPLATE_PATH"]?>)"></div>
                        </div>
                        <?}?>                            
                </div>

                <div class="library-colors__description">
                    <?foreach ($arResult["OFFERS"] as $o=>$offer) {?> 

                        <div class="library-colors__current <?if($o == 0){?>__selected<?}?> js-color-text" data-color="<?=$offer["ID"]?>">
                            <h3 class="library-colors__current-title"><?=$arResult["COLORS_LIST"][$offer["PROPERTIES"]["COLOR"]["VALUE"]]["NAME"]?></h3>
                            <div class="library-colors__current-text"><?=$arResult["COLORS_LIST"][$offer["PROPERTIES"]["COLOR"]["VALUE"]]["DETAIL_TEXT"]?></div>

                            <div class="product__price">
                                <?foreach($arResult["CAT_PRICES"] as $code=>$arPrice){?>
                                    <?if($arPrice = $offer["PRICES"][$code]):?>
                                        <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                            <?=$arPrice["PRINT_DISCOUNT_VALUE"]?>
                                            <?else:?>
                                            <?=$arPrice["PRINT_VALUE"]?>
                                            <?endif?>                             
                                        <?endif;?>
                                    <?}?>
                            </div>
                        </div>
                        <?}?>      
                </div>

            </div>
            <div class="product__btns">     
                <div class="btn btn--whitebg js-show-hidden" data-target="stores" data-swap="свернуть">где посмотреть?</div>
                <?if ($arResult["PROPERTIES"]["LINK"]["VALUE"]) {?>
                    <a href="<?=$arResult["PROPERTIES"]["LINK"]["VALUE"]?>"><div class="btn btn--whitebg">купить в интернет-магазине</div></a>
                    <?}?>
            </div>

        </div>
    </div>

    <?} else { //товар без торговых предложений?>
    <div class="product __slider">
        <div class="wrapper cf">  
            <div class="product-top"> </div>

            <div class="product__image-wrap __selected" data-color="<?=$arResult["ID"]?>">
                <div class="product__image js-image-slider" data-offer="<?=$arResult["ID"]?>"> 
                    <?if ($arResult["DETAIL_PICTURE"]["SRC"]){?>
                        <img class="js-color-image "  src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["DESCRIPTION"]?>" data-color="<?=$arResult["ID"]?>" data-offer="<?=$arResult["ID"]?>">
                        <?}?>
                    <?if (is_array($arResult["PROPERTIES"]["MORE_FOTO"]["VALUE"]) && count($arResult["PROPERTIES"]["MORE_FOTO"]["VALUE"]) > 0) {?>
                        <?foreach ($arResult["PROPERTIES"]["MORE_FOTO"]["VALUE"] as $f=>$foto) {?>
                            <img class="js-color-image <?if($f == 0){?>__selected<?}?>" src="<?=$foto?>" alt="<?=$arResult["PROPERTIES"]["MORE_FOTO"]["ORIGINAL_VALUE"][$f]["DESCRIPTION"]?>" data-offer="<?=$arResult["ID"]?>">
                            <?}?> 
                        <?}?>
                </div>
                <div class="product__thumbnails js-thumbnails" data-offer="<?=$arResult["ID"]?>"></div>
            </div>

            <div class="product__right">
                <div class="product__title"><?=$arResult["NAME"]?></div>
                <div class="product__description"><?=$arResult["DETAIL_TEXT"]?></div>
                <div class="product__price">
                    <?foreach($arResult["CAT_PRICES"] as $code=>$arPrice){?>
                        <?if($arPrice = $arResult["PRICES"][$code]):?>
                            <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                <?=$arPrice["PRINT_DISCOUNT_VALUE"]?>
                                <?else:?>
                                <?=$arPrice["PRINT_VALUE"]?>
                                <?endif?>                             
                            <?endif;?>
                        <?}?>
                </div>
            </div>

            <div class="product__btns">
                <div class="btn btn--whitebg js-show-hidden" data-target="stores" data-swap="свернуть">где посмотреть?</div>

                <?if ($arResult["PROPERTIES"]["LINK"]["VALUE"]) {?>
                    <a href="<?=$arResult["PROPERTIES"]["LINK"]["VALUE"]?>"><div class="btn btn--whitebg">купить в интернет-магазине</div></a>
                    <?}?>

            </div>
        </div>
    </div>       
    <?}?>



<section class="library-stores js-hidden" data-target='stores'>
    <div class="library-stores__inner">
        <div class="wrapper">
            <h2 class="more-stores__title">где посмотреть</h2>
            <div class="carousel__nav more-stores__nav"> </div>
            <div class="more-stores__list js-carousel">
                <a href="#" class="more-stores__item">
                    <div class="more-stores__image"><img src="/img/pages/store/store_01.png" alt=""></div>
                    <div class="more-stores__name subway __lightgreen">м. Трубная
                        <br>ТЦ «Цветной»</div>
                </a>
                <a href="#" class="more-stores__item">
                    <div class="more-stores__image"><img src="/img/pages/store/store_02.png" alt=""></div>
                    <div class="more-stores__name subway __orange">м. Проспект Мира
                        <br>ТЦ «Олимпийский»</div>
                </a>
                <a href="#" class="more-stores__item">
                    <div class="more-stores__image"><img src="/img/pages/store/store_03.png" alt=""></div>
                    <div class="more-stores__name subway __purple">м. Тушинская
                        <br>ТЦ «Дорогие окраины»</div>
                </a>
                <a href="#" class="more-stores__item">
                    <div class="more-stores__image"><img src="/img/pages/store/store_04.png" alt=""></div>
                    <div class="more-stores__name subway __purple">м. Пролетарская
                        <br>ТЦ «Кристалл»</div>
                </a>
                <a href="#" class="more-stores__item">
                    <div class="more-stores__image"><img src="/img/pages/store/store_01.png" alt=""></div>
                    <div class="more-stores__name subway __lightgreen">м. Трубная
                        <br>ТЦ «Цветной»</div>
                </a>
                <a href="#" class="more-stores__item">
                    <div class="more-stores__image"><img src="/img/pages/store/store_02.png" alt=""></div>
                    <div class="more-stores__name subway __orange">м. Проспект Мира
                        <br>ТЦ «Олимпийский»</div>
                </a>
                <a href="#" class="more-stores__item">
                    <div class="more-stores__image"><img src="/img/pages/store/store_03.png" alt=""></div>
                    <div class="more-stores__name subway __purple">м. Тушинская
                        <br>ТЦ «Дорогие окраины»</div>
                </a>
                <a href="#" class="more-stores__item">
                    <div class="more-stores__image"><img src="/img/pages/store/store_04.png" alt=""></div>
                    <div class="more-stores__name subway __purple">м. Пролетарская
                        <br>ТЦ «Кристалл»</div>
                </a>
            </div>
        </div>
    </div>
</section>         

<?if(is_array($arResult["ATTENTION"]) && count($arResult["ATTENTION"]) > 0) {?>
    <section class="library-attention">
        <div class="wrapper">
            <h2 class="library-attention__title">Обратите внимание</h2>
            <div class="carousel__nav more-stores__nav"></div>
            <div class="library-attention__list js-carousel">

                <?foreach ($arResult["ATTENTION"] as $attentionItem) {?>
                    <div class="library-attention__item">
                        <a href="<?=$attentionItem["LINK"]?>" class="library-attention__image <?if ($attentionItem["PROPERTY_VIDEO_LINK_VALUE"]){?> __video js-video-popup<?} else {?> js-image-popup <?}?>"> 
                            <?if ($attentionItem["DETAIL_PICTURE"]["SRC"])?>
                            <img src="<?=$attentionItem["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$attentionItem["DETAIL_PICTURE"]["DESCRIPTION"]?>"> 
                        </a>
                        <h3 class="library-attention__item-title"><?=$attentionItem["NAME"]?></h3>
                        <div class="library-attention__text"><?=$attentionItem["DETAIL_TEXT"]?></div>
                    </div>
                    <?}?>     

            </div>
        </div>
    </section>
    <?}?>

<div class="product-features">
    <div class="wrapper">
        <h2 class="product-features__title">Технические характеристики</h2>
        <div class="product-features__list">
            <div class="product-features__column">
                <?if(is_array($arResult["PROPERTIES"]["MATERIALS"]["VALUE"]) && count($arResult["PROPERTIES"]["MATERIALS"]["VALUE"]) > 0) {?>
                    <div class="product-features__feature">
                        <div class="product-features__feature-title">Материал</div>
                        <div class="product-features__feature-text">
                            <?foreach ($arResult["PROPERTIES"]["MATERIALS"]["DISPLAY_VALUE"] as $i=>$value) {?>
                                <?=$value?><?if ($i < count($arResult["PROPERTIES"]["MATERIALS"]["VALUE"]) - 1) {?>, <?}?>
                                <?}?>
                        </div>
                    </div>
                    <?}?>

                <?if(is_array($arResult["PROPERTIES"]["IMPLEMENT"]["VALUE"])  && count($arResult["PROPERTIES"]["IMPLEMENT"]["VALUE"]) > 0){?>
                    <div class="product-features__feature">
                        <div class="product-features__feature-title">Фурнитура</div>
                        <div class="product-features__feature-text">
                            <?foreach ($arResult["PROPERTIES"]["IMPLEMENT"]["DISPLAY_VALUE"] as $i=>$value) {?>
                                <?=$value?><?if ($i < count($arResult["PROPERTIES"]["IMPLEMENT"]["VALUE"]) - 1) {?>, <?}?>
                                <?}?>
                        </div>
                    </div>
                    <?}?>

                <?if($arResult["PROPERTIES"]["COATING"]["VALUE"]){?>
                    <div class="product-features__feature">
                        <div class="product-features__feature-title">Покрытие</div>
                        <div class="product-features__feature-text"><?=$arResult["PROPERTIES"]["COATING"]["VALUE"]?></div>
                    </div>
                    <?}?>

                <?if($arResult["PROPERTIES"]["WARRANTY"]["VALUE"]){?>
                    <div class="product-features__feature">
                        <div class="product-features__feature-title">Гарантия</div>
                        <div class="product-features__feature-text"><?=$arResult["PROPERTIES"]["WARRANTY"]["VALUE"]?></div>
                    </div>
                    <?}?>

            </div>
            <div class="product-features__column">
                <div class="product-features__feature">

                    <div class="product-features__feature-title">Размеры</div>
                    <dl class="product-features__feature-text">

                        <?if($arResult["PROPERTIES"]["WIDTH"]["VALUE"]){?> 
                            <dt>Ширина, мм</dt><dd><?=$arResult["PROPERTIES"]["WIDTH"]["VALUE"]?></dd> 
                            <?}?>

                        <?if($arResult["PROPERTIES"]["HEIGHT"]["VALUE"]){?>
                            <dt>Высота, мм</dt><dd><?=$arResult["PROPERTIES"]["HEIGHT"]["VALUE"]?></dd> 
                            <?}?>

                        <?if($arResult["PROPERTIES"]["DEPTH"]["VALUE"]){?>
                            <dt>Глубина, мм</dt><dd><?=$arResult["PROPERTIES"]["DEPTH"]["VALUE"]?></dd>
                            <?}?>

                    </dl>

                    <dl class="product-features__feature-text"> 
                        <?if($arResult["PROPERTIES"]["VOLUME"]["VALUE"]){?>
                            <dt>Объём, м<sup>3</sup></dt><dd><?=$arResult["PROPERTIES"]["VOLUME"]["VALUE"]?></dd> 
                            <?}?>

                        <?if($arResult["PROPERTIES"]["WEIGHT"]["VALUE"]){?>
                            <dt>Вес, кг</dt><dd><?=$arResult["PROPERTIES"]["WEIGHT"]["VALUE"]?></dd>
                            <?}?>
                    </dl>

                    <?if ($arResult["PROPERTIES"]["DIMENSIONS"]["VALUE"]){?>
                        <dl class="product-features__feature-text"> <dt>(<?=$arResult["PROPERTIES"]["DIMENSIONS"]["VALUE"]?> товар)</dt> </dl>
                        <?}?>

                </div>
            </div>
            <div class="product-features__column">
                <div class="product-features__feature">
                    <div class="product-features__feature-title">Сборка</div>
                    <div class="product-features__feature-text">
                        <?if(!$arResult["PROPERTIES"]["ASSEMBLY_REQUIRED"]["VALUE"]){?>Не требуется<?} else {?>Требуется<?}?>
                    </div>
                </div>

                <?if(is_array($arResult["FURNITURE_CARE"]) && count($arResult["FURNITURE_CARE"]) > 0) {?>
                    <a href="#product-features-info" class="product-features-info js-scroll-link"> 
                        <span class="product-features-info__icon icon icon-info"></span> 
                        <span class="product-features-info__text">
                            Как ухаживать за мебелью?
                        </span> 
                    </a>
                    <?}?>

            </div>
        </div>
    </div>
</div>

<div class="library-help">
    <div class="wrapper cf">
        <div class="library-help__title">Не можете определиться какая мебель подойдет? Нужна помощь дизайнера?</div>
        <a href="/designers-help/"><div class="btn btn--greenbg">получить помощь</div></a>
    </div>
</div>

<?if(is_array($arResult["FURNITURE_CARE"]) && count($arResult["FURNITURE_CARE"]) > 0) {?>
    <section class="product-care" id="product-features-info">
        <div class="wrapper">
            <h2 class="product-care__title">Уход за мебелью</h2>
            <div class="product-care__list care__inner">

                <?foreach ($arResult["FURNITURE_CARE"] as $item){?>
                    <div class="care-item">
                        <div class="care-item__icon"> 
                            <img src="<?=$item["PICTURE"]?>" alt="<?=$item["NAME"]?>" /> 
                        </div>
                        <div class="care-item__text"><?=$item["PREVIEW_TEXT"]?></div>
                    </div>
                    <?}?>

            </div>
        </div>
    </section>
    <?}?>

<?if(is_array($arResult["OTHER_PRODUCTS"])) {?>
    <section class="product-similar">
        <div class="wrapper">
            <h2 class="library-attention__title">другие товары из этой категории</h2>
            <div class="carousel__nav more-stores__nav"></div>
            <div class="library-сost__list js-carousel">
                <?foreach ($arResult["OTHER_PRODUCTS"] as $item) {?>
                    <a href="<?=$item["DETAIL_PAGE_URL"]?>" class="library-cost__item">
                        <div class="library-cost__item-image">
                            <img src="<?=$item["PICTURE"]?>" alt="<?=$item["NAME"]?>" />
                        </div>
                        <div class="library-cost__item-desc">
                            <div class="library-cost__item-title"><?=$item["NAME"]?></div>
                        </div>
                    </a>
                    <?}?>
            </div>
        </div>
    </section>           
    <?}?>          

<script>
    $(function(){            
        //  $("body").addClass("collection-page");
        $("header").removeClass("header--transparent");
        $("header").addClass("header--fixed");
        $("header").addClass("js-fixed-head");
        $(".js-fullpage").removeAttr("class").addClass("page");
        $(".page").addClass("__product");    
    })
</script>