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
<section class="article">
    <div class="wrapper">
        <div class="article__content"> 
            <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])) {?>
                <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
                    width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
                    height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
                    alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
                    title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>" 
                    />
                <?}?>
            <?if($arParams["DISPLAY_DETAIL_TEXT"]!="N" && $arResult["FIELDS"]["DETAIL_TEXT"]){?>
                <p><?=$arResult["FIELDS"]["DETAIL_TEXT"];unset($arResult["FIELDS"]["DETAIL_TEXT"]);?></p>
                <?}?>
        </div>
        <? if (!empty($arResult["PREV_ELEMENT"])){ ?>
            <div class="article__sidebar">
                <h3 class="article__sidebar-title"><?=GetMessage('ANOTHER_NEWS')?></h3>
                <?
                    foreach ($arResult["PREV_ELEMENT"] as $key => $arElement ){
                    ?>
                    <div class="article__other">
                        <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"> <img class="article__other-preview" src="<?=$arElement["PREVIEW_PICTURE_SRC"]["src"]?>" alt="<?=$arElement["NAME"]?>" /> </a>
                        <h4 class="article__other-title">
                            <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a>
                        </h4>
                    <p class="article__other-text"><?=$arElement["PREVIEW_TEXT"]?></p> <a class="article__other-detail btn btn--greenbg" href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=GetMessage('WATCH_FULL')?></a> </div>
                    <? }  ?>
            </div>
            <?}?>
    </div>
    <?
        include($_SERVER["DOCUMENT_ROOT"]."/include/social_block.php");
    ?>   
</section>
