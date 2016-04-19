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
<div class="movie-popup js-movie-popup">
    <div class="wrapper">
        <div class="media-item__list movie-popup__list">

            <?foreach ($arResult['SECTIONS'] as $s=>$arSection) { ?>
                <a href="<?=$arSection["UF_VIDEO_LINK"]?>" class="movie-popup__item movie-popup__item--text js-video-popup">
                    <div class="media-item__image __video"> 
                    <?$preview = CFile::GetPath($arSection["UF_VIDEO_PREVIEW"])?>
                        <img src="<?=$preview?>" alt=""> 
                    </div> 
                    <span class="movie-popup__title" style="background-color: <?=$arSection["UF_VIDEO_LINK_COLOR"]?>"><?=$arSection["NAME"]?></span> 
                </a>    
                <?}?>     
        </div>

        <div class="btn btn--whitebg js-close-media-popup">Закрыть</div>

    </div>
</div>

