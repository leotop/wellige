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

<section class="js-slide slide slide--style" data-anim="scale" data-type="sliderTextArr" data-anchor="style">
    <div class="slide__wrap">

        <?foreach ($arResult['SECTIONS'] as $s=>$arSection) { ?>
            <?if ($arSection["UF_STYLE_VIDEO"]){//если есть видео  
                    $smallImg = CFile::GetPath($arSection["DETAIL_PICTURE"]);
                    $bigImg = $arSection["PICTURE"]["SRC"];?>
                <div class="mainpage__videos slide__bg--dark slide__bg js-anim-videos <?if ($s == 0) {?>__active<?}?>" data-bg='<?=$bigImg?>'>
                    <video autoplay muted loop src="<?=Cfile::GetPath($arSection["UF_STYLE_VIDEO"])?>" class="mainpage__video js-anim-video" type="video/mp4"></video>
                </div>
                <?} else {
                    $smallImg = CFile::GetPath($arSection["DETAIL_PICTURE"]);
                    $bigImg = $arSection["PICTURE"]["SRC"];
                ?>
                <div class="slide__bg  slide__bg--dark <?if ($s == 0) {?>__active<?}?>" data-mobile-bg='<?=$smallImg?>' style="background-image: url('<?=$bigImg?>')"></div>
                <?}?>    
            <?}?>

        <?foreach ($arResult['SECTIONS'] as $s=>$arSection) { ?>
            <div class="js-slider-item" data-title="<?=$arSection["NAME"]?>">
                <h1 class="slide__title"><?=$arSection["NAME"]?></h1>
                <div class="slide__text"><?=$arSection["DESCRIPTION"]?></div>
                <a href="<?=$arSection["SECTION_PAGE_URL"]?>"><div class="btn btn--whitebg slide__btn">посмотреть стиль</div></a>
            </div>
            <?}?>  

        <div class="slide__arrow-text slide__arrow-text--left js-arrow-prev"><?=$arResult['SECTIONS'][count($arResult['SECTIONS'])-1]["NAME"] //последний элемент?></div>
        <div class="slide__arrow-text slide__arrow-text--right js-arrow-next"><?=$arResult['SECTIONS'][1]["NAME"] //второй элемент?></div>   

    </div>
</section>




