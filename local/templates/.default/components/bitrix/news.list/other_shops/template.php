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
<?if (!empty($arResult["ITEMS"])){?>   

    <section class="more-stores">
        <div class="wrapper">
            <h2 class="more-stores__title">Другие салоны в Москве</h2>
            <div class="carousel__nav more-stores__nav"></div>
            <div class="more-stores__list js-carousel">

                <?foreach($arResult["ITEMS"] as $i=>$arItem):?>
                    <?  
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>                  

                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="more-stores__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">   

                        <style>
                            <?if ($arItem["PROPERTIES"]["METRO"]["VALUE"]["LINE_COLOR"]) {?>
                                .more-stores__name.other_store_<?=$i?>::before {
                                    background-color: #<?=$arItem["PROPERTIES"]["METRO"]["VALUE"]["LINE_COLOR"]?>;
                                }
                                <?} else {?>
                                 .more-stores__name.other_store_<?=$i?>::before {
                                     width:0 !important;
                                     margin:0 !important;
                                     content: none !important;
                                 }
                                 
                                 .more-stores__name.other_store_<?=$i?> {
                                     margin:0 !important;
                                 }
                                <?}?>
                        </style> 

                        <div class="more-stores__image">
                            <?$foto = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"],array("width"=>326,"height"=>210),BX_RESIZE_IMAGE_EXACT);?>
                            <img src="<?=$foto["src"]?>" alt="<?=$arItem["DETAIL_PICTURE"]["DESCRIPTION"]?>">
                        </div>
                        <div class="more-stores__name subway other_store_<?=$i?>">
                            <?if ($arItem["PROPERTIES"]["METRO"]["VALUE"]["NAME"]) {?>
                                м. <?=$arItem["PROPERTIES"]["METRO"]["VALUE"]["NAME"]?><br>
                                <?}?>
                            <?=$arItem["NAME"]?>
                        </div>
                    </a>   

                    <?endforeach;?>   

            </div>
        </div>
    </section> 
    <?}?>