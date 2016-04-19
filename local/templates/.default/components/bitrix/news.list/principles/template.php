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

<section class="js-slide slide slide--principles js-bright-bg" data-anchor="principles" data-color="white">
    <div class="slide__wrap">
        <div class="slide__bg" data-mobile-bg='/img/bg-slide_main_2_m.jpg' style="background-image: url('/img/bg-slide_main_2.jpg')"></div>
        <div class="wrapper">
            <h1 class="slide__title"><span class="slide__title-number"><?=count($arResult["SECTIONS"])?></span><span class="slide__title-text">принципа</span></h1>

            <div class="principles__list">
                <?foreach($arResult["SECTIONS"] as $arSection) {
                        $imgSrc = CFile::GetPath($arSection["PICTURE"]);
                    ?>
                    <div class="principles__item js-principles-more" data-dest="<?=$arSection["CODE"]?>">
                        <div class="principles__img">
                            <?if ($imgSrc) {?>
                                <img src="<?=$imgSrc?>" alt="">
                                <?}?>
                        </div>
                        <div class="principles__title"><?=$arSection["NAME"]?></div>
                        <div class="principles__text"><?=$arSection["DESCRIPTION"]?></div>
                        <div class="principles__more js-principles-more"></div>
                    </div>
                    <?}?>                  
            </div>

        </div>
    </div>
</section>    

<?
    $cectionCount = 1;
    foreach ($arResult["SECTIONS"] as $section) {?>
    <section class="js-slide slide  slide--eco" data-anim="parallax" data-type="sliderTextNav" data-anchor="<?=$section["CODE"]?>">
        <div class="slide__wrap">
            <?foreach ($arResult["ITEMS_BY_SECTIONS"][$section["ID"]] as $i=>$sItem) {
                ?>              
                <div class="slide__bg slide__bg--brown <?if ($i==0){?>__active<?}?>" data-mobile-bg='<?=$sItem["PREVIEW_PICTURE"]["SRC"]?>' style="background-image: url('<?=$sItem["DETAIL_PICTURE"]["SRC"]?>')"></div>
                <?}?>
            <h1 class="slide__title"><span class="slide__title-number"><?=$cectionCount?></span><span class="slide__title-text"><?=$section["NAME"]?></span></h1>
            <div>
                <?foreach ($arResult["ITEMS_BY_SECTIONS"][$section["ID"]] as $i=>$sItem) {?>
                    <div class="js-slider-item">
                        <h2 class="slide__subtitle"><?=$sItem["NAME"]?></h2>
                        <div class="slide__text"><?=$sItem["PREVIEW_TEXT"]?></div>
                    </div>
                    <?}?>                  

            </div>
            <div class="slide__nav">
                <div class="js-nav-frame slide__nav-frame"></div>
                <div class="slide__nav-wrap">
                    <?foreach ($arResult["ITEMS_BY_SECTIONS"][$section["ID"]] as $i=>$sItem) {?>
                        <div class="js-slide-nav slide__nav-item <?if ($i==0){?>__active<?}?>"><?=$sItem["NAME"]?></div>
                        <?}?>                       

                </div>
            </div>
        </div>
    </section>
    <?$cectionCount++;?>
<?}?>          