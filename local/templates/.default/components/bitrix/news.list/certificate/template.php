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
<section class="certificates">
    <div class="certificates__title-wrap wrapper">
        <h4 class="certificates__title">
            <span>Продукция Wellige имеет все требуемые лицензии и&nbsp;сертификаты установленные законом Российской Федерации. Требуемая перертификация компании проходит ежегодно.</span>
        </h4> 
    </div>
    <div class="wrapper">                                      
        <div class="certificates__inner js-certificates">  

            <?foreach ($arResult["ITEMS"] as $i=>$arItem) {?>
                <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>                  
                <div class="certificates-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <?//$img = CFIle::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"],array("width"=>320, "height"=>220), BX_RESIZE_IMAGE_EXACT,true)?>
                    <a href="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" data-size="<?=$arItem["DETAIL_PICTURE"]["WIDTH"]?>x<?=$arItem["DETAIL_PICTURE"]["HEIGHT"]?>" class="certificates-item__img" data-gallery-id="0" data-photo-id="<?=$i?>">
                       <img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" /> 
                    </a>
                    <div class="certificates-item__text"><?=$arItem["DETAIL_TEXT"]?></div>
                </div>
                <?}?>  
        </div>
    </div>
</section>

<!-- Photoswipe -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" title="Share"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
            <div class="pswp__counter"></div>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
        </div>
<!-- /.pswp -->