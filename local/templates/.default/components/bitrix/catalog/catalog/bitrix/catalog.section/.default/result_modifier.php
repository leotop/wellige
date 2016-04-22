<?
    use Bitrix\Main\Type\Collection;
    use Bitrix\Currency\CurrencyTable;

    if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
    /** @var CBitrixComponentTemplate $this */
    /** @var array $arParams */
    /** @var array $arResult */
    $arDefaultParams = array(
        'TEMPLATE_THEME' => 'blue',
        'PRODUCT_DISPLAY_MODE' => 'N',
        'ADD_PICT_PROP' => '-',
        'LABEL_PROP' => '-',
        'OFFER_ADD_PICT_PROP' => '-',
        'OFFER_TREE_PROPS' => array('-'),
        'PRODUCT_SUBSCRIPTION' => 'N',
        'SHOW_DISCOUNT_PERCENT' => 'N',
        'SHOW_OLD_PRICE' => 'N',
        'ADD_TO_BASKET_ACTION' => 'ADD',
        'SHOW_CLOSE_POPUP' => 'N',
        'MESS_BTN_BUY' => '',
        'MESS_BTN_ADD_TO_BASKET' => '',
        'MESS_BTN_SUBSCRIBE' => '',
        'MESS_BTN_DETAIL' => '',
        'MESS_NOT_AVAILABLE' => '',
        'MESS_BTN_COMPARE' => ''
    );
    $arParams = array_merge($arDefaultParams, $arParams);

    if (!isset($arParams['LINE_ELEMENT_COUNT']))
        $arParams['LINE_ELEMENT_COUNT'] = 3;
    $arParams['LINE_ELEMENT_COUNT'] = intval($arParams['LINE_ELEMENT_COUNT']);
    if (2 > $arParams['LINE_ELEMENT_COUNT'] || 5 < $arParams['LINE_ELEMENT_COUNT'])
        $arParams['LINE_ELEMENT_COUNT'] = 3;

    $arParams['TEMPLATE_THEME'] = (string)($arParams['TEMPLATE_THEME']);
    if ('' != $arParams['TEMPLATE_THEME'])
    {
        $arParams['TEMPLATE_THEME'] = preg_replace('/[^a-zA-Z0-9_\-\(\)\!]/', '', $arParams['TEMPLATE_THEME']);
        if ('site' == $arParams['TEMPLATE_THEME'])
        {
            $templateId = COption::GetOptionString("main", "wizard_template_id", "eshop_bootstrap", SITE_ID);
            $templateId = (preg_match("/^eshop_adapt/", $templateId)) ? "eshop_adapt" : $templateId;
            $arParams['TEMPLATE_THEME'] = COption::GetOptionString('main', 'wizard_'.$templateId.'_theme_id', 'blue', SITE_ID);
        }
        if ('' != $arParams['TEMPLATE_THEME'])
        {
            if (!is_file($_SERVER['DOCUMENT_ROOT'].$this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
                $arParams['TEMPLATE_THEME'] = '';
        }
    }
    if ('' == $arParams['TEMPLATE_THEME'])
        $arParams['TEMPLATE_THEME'] = 'blue';
    $arResult['NAV_PARAM']['TEMPLATE_THEME'] = $arParams['TEMPLATE_THEME'];

    $arResult['NAV_STRING'] = $arResult['NAV_RESULT']->GetPageNavStringEx(
        $navComponentObject,
        $arParams['PAGER_TITLE'],
        $arParams['PAGER_TEMPLATE'],
        $arParams['PAGER_SHOW_ALWAYS'],
        $this->__component,
        $arResult['NAV_PARAM']
    );

    if ('Y' != $arParams['PRODUCT_DISPLAY_MODE'])
        $arParams['PRODUCT_DISPLAY_MODE'] = 'N';

    $arParams['ADD_PICT_PROP'] = trim($arParams['ADD_PICT_PROP']);
    if ('-' == $arParams['ADD_PICT_PROP'])
        $arParams['ADD_PICT_PROP'] = '';
    $arParams['LABEL_PROP'] = trim($arParams['LABEL_PROP']);
    if ('-' == $arParams['LABEL_PROP'])
        $arParams['LABEL_PROP'] = '';
    $arParams['OFFER_ADD_PICT_PROP'] = trim($arParams['OFFER_ADD_PICT_PROP']);
    if ('-' == $arParams['OFFER_ADD_PICT_PROP'])
        $arParams['OFFER_ADD_PICT_PROP'] = '';
    if ('Y' == $arParams['PRODUCT_DISPLAY_MODE'])
    {
        if (!is_array($arParams['OFFER_TREE_PROPS']))
            $arParams['OFFER_TREE_PROPS'] = array($arParams['OFFER_TREE_PROPS']);
        foreach ($arParams['OFFER_TREE_PROPS'] as $key => $value)
        {
            $value = (string)$value;
            if ('' == $value || '-' == $value)
                unset($arParams['OFFER_TREE_PROPS'][$key]);
        }
        if (empty($arParams['OFFER_TREE_PROPS']) && isset($arParams['OFFERS_CART_PROPERTIES']) && is_array($arParams['OFFERS_CART_PROPERTIES']))
        {
            $arParams['OFFER_TREE_PROPS'] = $arParams['OFFERS_CART_PROPERTIES'];
            foreach ($arParams['OFFER_TREE_PROPS'] as $key => $value)
            {
                $value = (string)$value;
                if ('' == $value || '-' == $value)
                    unset($arParams['OFFER_TREE_PROPS'][$key]);
            }
        }
    }
    else
    {
        $arParams['OFFER_TREE_PROPS'] = array();
    }
    if ('Y' != $arParams['PRODUCT_SUBSCRIPTION'])
        $arParams['PRODUCT_SUBSCRIPTION'] = 'N';
    if ('Y' != $arParams['SHOW_DISCOUNT_PERCENT'])
        $arParams['SHOW_DISCOUNT_PERCENT'] = 'N';
    if ('Y' != $arParams['SHOW_OLD_PRICE'])
        $arParams['SHOW_OLD_PRICE'] = 'N';
    if ($arParams['ADD_TO_BASKET_ACTION'] != 'BUY')
        $arParams['ADD_TO_BASKET_ACTION'] = 'ADD';
    if ($arParams['SHOW_CLOSE_POPUP'] != 'Y')
        $arParams['SHOW_CLOSE_POPUP'] = 'N';
    $arParams['MESS_BTN_BUY'] = trim($arParams['MESS_BTN_BUY']);
    $arParams['MESS_BTN_ADD_TO_BASKET'] = trim($arParams['MESS_BTN_ADD_TO_BASKET']);
    $arParams['MESS_BTN_SUBSCRIBE'] = trim($arParams['MESS_BTN_SUBSCRIBE']);
    $arParams['MESS_BTN_DETAIL'] = trim($arParams['MESS_BTN_DETAIL']);
    $arParams['MESS_NOT_AVAILABLE'] = trim($arParams['MESS_NOT_AVAILABLE']);
    $arParams['MESS_BTN_COMPARE'] = trim($arParams['MESS_BTN_COMPARE']);

    if (!empty($arResult['ITEMS']))
    {
        $arEmptyPreview = false;
        $strEmptyPreview = $this->GetFolder().'/images/no_photo.png';
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$strEmptyPreview))
        {
            $arSizes = getimagesize($_SERVER['DOCUMENT_ROOT'].$strEmptyPreview);
            if (!empty($arSizes))
            {
                $arEmptyPreview = array(
                    'SRC' => $strEmptyPreview,
                    'WIDTH' => intval($arSizes[0]),
                    'HEIGHT' => intval($arSizes[1])
                );
            }
            unset($arSizes);
        }
        unset($strEmptyPreview);

        $arSKUPropList = array();
        $arSKUPropIDs = array();
        $arSKUPropKeys = array();
        $boolSKU = false;
        $strBaseCurrency = '';
        $boolConvert = isset($arResult['CONVERT_CURRENCY']['CURRENCY_ID']);

        if ($arResult['MODULES']['catalog'])
        {
            if (!$boolConvert)
                $strBaseCurrency = CCurrency::GetBaseCurrency();

            $arSKU = CCatalogSKU::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
            $boolSKU = !empty($arSKU) && is_array($arSKU);
            if ($boolSKU && !empty($arParams['OFFER_TREE_PROPS']) && 'Y' == $arParams['PRODUCT_DISPLAY_MODE'])
            {
                $arSKUPropList = CIBlockPriceTools::getTreeProperties(
                    $arSKU,
                    $arParams['OFFER_TREE_PROPS'],
                    array(
                        'PICT' => $arEmptyPreview,
                        'NAME' => '-'
                    )
                );

                $arNeedValues = array();
                CIBlockPriceTools::getTreePropertyValues($arSKUPropList, $arNeedValues);
                $arSKUPropIDs = array_keys($arSKUPropList);
                if (empty($arSKUPropIDs))
                    $arParams['PRODUCT_DISPLAY_MODE'] = 'N';
                else
                    $arSKUPropKeys = array_fill_keys($arSKUPropIDs, false);
            }
        }

        $arNewItemsList = array();
        foreach ($arResult['ITEMS'] as $key => $arItem)
        {
            $arItem['CHECK_QUANTITY'] = false;
            if (!isset($arItem['CATALOG_MEASURE_RATIO']))
                $arItem['CATALOG_MEASURE_RATIO'] = 1;
            if (!isset($arItem['CATALOG_QUANTITY']))
                $arItem['CATALOG_QUANTITY'] = 0;
            $arItem['CATALOG_QUANTITY'] = (
                0 < $arItem['CATALOG_QUANTITY'] && is_float($arItem['CATALOG_MEASURE_RATIO'])
                ? floatval($arItem['CATALOG_QUANTITY'])
                : intval($arItem['CATALOG_QUANTITY'])
            );
            $arItem['CATALOG'] = false;
            if (!isset($arItem['CATALOG_SUBSCRIPTION']) || 'Y' != $arItem['CATALOG_SUBSCRIPTION'])
                $arItem['CATALOG_SUBSCRIPTION'] = 'N';

            CIBlockPriceTools::getLabel($arItem, $arParams['LABEL_PROP']);

            $productPictures = CIBlockPriceTools::getDoublePicturesForItem($arItem, $arParams['ADD_PICT_PROP']);
            if (empty($productPictures['PICT']))
                $productPictures['PICT'] = $arEmptyPreview;
            if (empty($productPictures['SECOND_PICT']))
                $productPictures['SECOND_PICT'] = $productPictures['PICT'];

            $arItem['PREVIEW_PICTURE'] = $productPictures['PICT'];
            $arItem['PREVIEW_PICTURE_SECOND'] = $productPictures['SECOND_PICT'];
            $arItem['SECOND_PICT'] = true;
            $arItem['PRODUCT_PREVIEW'] = $productPictures['PICT'];
            $arItem['PRODUCT_PREVIEW_SECOND'] = $productPictures['SECOND_PICT'];

            if ($arResult['MODULES']['catalog'])
            {
                $arItem['CATALOG'] = true;
                if (!isset($arItem['CATALOG_TYPE']))
                    $arItem['CATALOG_TYPE'] = CCatalogProduct::TYPE_PRODUCT;
                if (
                    (CCatalogProduct::TYPE_PRODUCT == $arItem['CATALOG_TYPE'] || CCatalogProduct::TYPE_SKU == $arItem['CATALOG_TYPE'])
                    && !empty($arItem['OFFERS'])
                )
                {
                    $arItem['CATALOG_TYPE'] = CCatalogProduct::TYPE_SKU;
                }
                switch ($arItem['CATALOG_TYPE'])
                {
                    case CCatalogProduct::TYPE_SET:
                        $arItem['OFFERS'] = array();
                        $arItem['CHECK_QUANTITY'] = ('Y' == $arItem['CATALOG_QUANTITY_TRACE'] && 'N' == $arItem['CATALOG_CAN_BUY_ZERO']);
                        break;
                    case CCatalogProduct::TYPE_SKU:
                        break;
                    case CCatalogProduct::TYPE_PRODUCT:
                    default:
                        $arItem['CHECK_QUANTITY'] = ('Y' == $arItem['CATALOG_QUANTITY_TRACE'] && 'N' == $arItem['CATALOG_CAN_BUY_ZERO']);
                        break;
                }
            }
            else
            {
                $arItem['CATALOG_TYPE'] = 0;
                $arItem['OFFERS'] = array();
            }

            if ($arItem['CATALOG'] && isset($arItem['OFFERS']) && !empty($arItem['OFFERS']))
            {
                if ('Y' == $arParams['PRODUCT_DISPLAY_MODE'])
                {
                    $arMatrixFields = $arSKUPropKeys;
                    $arMatrix = array();

                    $arNewOffers = array();
                    $boolSKUDisplayProperties = false;
                    $arItem['OFFERS_PROP'] = false;

                    $arDouble = array();
                    foreach ($arItem['OFFERS'] as $keyOffer => $arOffer)
                    {
                        $arOffer['ID'] = intval($arOffer['ID']);
                        if (isset($arDouble[$arOffer['ID']]))
                            continue;
                        $arRow = array();
                        foreach ($arSKUPropIDs as $propkey => $strOneCode)
                        {
                            $arCell = array(
                                'VALUE' => 0,
                                'SORT' => PHP_INT_MAX,
                                'NA' => true
                            );
                            if (isset($arOffer['DISPLAY_PROPERTIES'][$strOneCode]))
                            {
                                $arMatrixFields[$strOneCode] = true;
                                $arCell['NA'] = false;
                                if ('directory' == $arSKUPropList[$strOneCode]['USER_TYPE'])
                                {
                                    $intValue = $arSKUPropList[$strOneCode]['XML_MAP'][$arOffer['DISPLAY_PROPERTIES'][$strOneCode]['VALUE']];
                                    $arCell['VALUE'] = $intValue;
                                }
                                elseif ('L' == $arSKUPropList[$strOneCode]['PROPERTY_TYPE'])
                                {
                                    $arCell['VALUE'] = intval($arOffer['DISPLAY_PROPERTIES'][$strOneCode]['VALUE_ENUM_ID']);
                                }
                                elseif ('E' == $arSKUPropList[$strOneCode]['PROPERTY_TYPE'])
                                {
                                    $arCell['VALUE'] = intval($arOffer['DISPLAY_PROPERTIES'][$strOneCode]['VALUE']);
                                }
                                $arCell['SORT'] = $arSKUPropList[$strOneCode]['VALUES'][$arCell['VALUE']]['SORT'];
                            }
                            $arRow[$strOneCode] = $arCell;
                        }
                        $arMatrix[$keyOffer] = $arRow;

                        CIBlockPriceTools::clearProperties($arOffer['DISPLAY_PROPERTIES'], $arParams['OFFER_TREE_PROPS']);

                        CIBlockPriceTools::setRatioMinPrice($arOffer, false);

                        $offerPictures = CIBlockPriceTools::getDoublePicturesForItem($arOffer, $arParams['OFFER_ADD_PICT_PROP']);
                        $arOffer['OWNER_PICT'] = empty($offerPictures['PICT']);
                        $arOffer['PREVIEW_PICTURE'] = false;
                        $arOffer['PREVIEW_PICTURE_SECOND'] = false;
                        $arOffer['SECOND_PICT'] = true;
                        if (!$arOffer['OWNER_PICT'])
                        {
                            if (empty($offerPictures['SECOND_PICT']))
                                $offerPictures['SECOND_PICT'] = $offerPictures['PICT'];
                            $arOffer['PREVIEW_PICTURE'] = $offerPictures['PICT'];
                            $arOffer['PREVIEW_PICTURE_SECOND'] = $offerPictures['SECOND_PICT'];
                        }
                        if ('' != $arParams['OFFER_ADD_PICT_PROP'] && isset($arOffer['DISPLAY_PROPERTIES'][$arParams['OFFER_ADD_PICT_PROP']]))
                            unset($arOffer['DISPLAY_PROPERTIES'][$arParams['OFFER_ADD_PICT_PROP']]);

                        $arDouble[$arOffer['ID']] = true;
                        $arNewOffers[$keyOffer] = $arOffer;
                    }
                    $arItem['OFFERS'] = $arNewOffers;

                    $arUsedFields = array();
                    $arSortFields = array();

                    foreach ($arSKUPropIDs as $propkey => $strOneCode)
                    {
                        $boolExist = $arMatrixFields[$strOneCode];
                        foreach ($arMatrix as $keyOffer => $arRow)
                        {
                            if ($boolExist)
                            {
                                if (!isset($arItem['OFFERS'][$keyOffer]['TREE']))
                                    $arItem['OFFERS'][$keyOffer]['TREE'] = array();
                                $arItem['OFFERS'][$keyOffer]['TREE']['PROP_'.$arSKUPropList[$strOneCode]['ID']] = $arMatrix[$keyOffer][$strOneCode]['VALUE'];
                                $arItem['OFFERS'][$keyOffer]['SKU_SORT_'.$strOneCode] = $arMatrix[$keyOffer][$strOneCode]['SORT'];
                                $arUsedFields[$strOneCode] = true;
                                $arSortFields['SKU_SORT_'.$strOneCode] = SORT_NUMERIC;
                            }
                            else
                            {
                                unset($arMatrix[$keyOffer][$strOneCode]);
                            }
                        }
                    }
                    $arItem['OFFERS_PROP'] = $arUsedFields;
                    $arItem['OFFERS_PROP_CODES'] = (!empty($arUsedFields) ? base64_encode(serialize(array_keys($arUsedFields))) : '');

                    Collection::sortByColumn($arItem['OFFERS'], $arSortFields);

                    $arMatrix = array();
                    $intSelected = -1;
                    $arItem['MIN_PRICE'] = false;
                    $arItem['MIN_BASIS_PRICE'] = false;
                    foreach ($arItem['OFFERS'] as $keyOffer => $arOffer)
                    {
                        if (empty($arItem['MIN_PRICE']) && $arOffer['CAN_BUY'])
                        {
                            $intSelected = $keyOffer;
                            $arItem['MIN_PRICE'] = (isset($arOffer['RATIO_PRICE']) ? $arOffer['RATIO_PRICE'] : $arOffer['MIN_PRICE']);
                            $arItem['MIN_BASIS_PRICE'] = $arOffer['MIN_PRICE'];
                        }
                        $arSKUProps = false;
                        if (!empty($arOffer['DISPLAY_PROPERTIES']))
                        {
                            $boolSKUDisplayProperties = true;
                            $arSKUProps = array();
                            foreach ($arOffer['DISPLAY_PROPERTIES'] as &$arOneProp)
                            {
                                if ('F' == $arOneProp['PROPERTY_TYPE'])
                                    continue;
                                $arSKUProps[] = array(
                                    'NAME' => $arOneProp['NAME'],
                                    'VALUE' => $arOneProp['DISPLAY_VALUE']
                                );
                            }
                            unset($arOneProp);
                        }

                        $arOneRow = array(
                            'ID' => $arOffer['ID'],
                            'NAME' => $arOffer['~NAME'],
                            'TREE' => $arOffer['TREE'],
                            'DISPLAY_PROPERTIES' => $arSKUProps,
                            'PRICE' => (isset($arOffer['RATIO_PRICE']) ? $arOffer['RATIO_PRICE'] : $arOffer['MIN_PRICE']),
                            'BASIS_PRICE' => $arOffer['MIN_PRICE'],
                            'SECOND_PICT' => $arOffer['SECOND_PICT'],
                            'OWNER_PICT' => $arOffer['OWNER_PICT'],
                            'PREVIEW_PICTURE' => $arOffer['PREVIEW_PICTURE'],
                            'PREVIEW_PICTURE_SECOND' => $arOffer['PREVIEW_PICTURE_SECOND'],
                            'CHECK_QUANTITY' => $arOffer['CHECK_QUANTITY'],
                            'MAX_QUANTITY' => $arOffer['CATALOG_QUANTITY'],
                            'STEP_QUANTITY' => $arOffer['CATALOG_MEASURE_RATIO'],
                            'QUANTITY_FLOAT' => is_double($arOffer['CATALOG_MEASURE_RATIO']),
                            'MEASURE' => $arOffer['~CATALOG_MEASURE_NAME'],
                            'CAN_BUY' => $arOffer['CAN_BUY'],
                        );
                        $arMatrix[$keyOffer] = $arOneRow;
                    }
                    if (-1 == $intSelected)
                        $intSelected = 0;
                    if (!$arMatrix[$intSelected]['OWNER_PICT'])
                    {
                        $arItem['PREVIEW_PICTURE'] = $arMatrix[$intSelected]['PREVIEW_PICTURE'];
                        $arItem['PREVIEW_PICTURE_SECOND'] = $arMatrix[$intSelected]['PREVIEW_PICTURE_SECOND'];
                    }
                    $arItem['JS_OFFERS'] = $arMatrix;
                    $arItem['OFFERS_SELECTED'] = $intSelected;
                    $arItem['OFFERS_PROPS_DISPLAY'] = $boolSKUDisplayProperties;
                }
                else
                {
                    $arItem['MIN_PRICE'] = CIBlockPriceTools::getMinPriceFromOffers(
                        $arItem['OFFERS'],
                        $boolConvert ? $arResult['CONVERT_CURRENCY']['CURRENCY_ID'] : $strBaseCurrency
                    );
                }
            }

            if (
                $arResult['MODULES']['catalog']
                && $arItem['CATALOG']
                &&
                ($arItem['CATALOG_TYPE'] == CCatalogProduct::TYPE_PRODUCT
                    || $arItem['CATALOG_TYPE'] == CCatalogProduct::TYPE_SET)
            )
            {
                CIBlockPriceTools::setRatioMinPrice($arItem, false);
                $arItem['MIN_BASIS_PRICE'] = $arItem['MIN_PRICE'];
            }

            if (!empty($arItem['DISPLAY_PROPERTIES']))
            {
                foreach ($arItem['DISPLAY_PROPERTIES'] as $propKey => $arDispProp)
                {
                    if ('F' == $arDispProp['PROPERTY_TYPE'])
                        unset($arItem['DISPLAY_PROPERTIES'][$propKey]);
                }
            }
            $arItem['LAST_ELEMENT'] = 'N';
            $arNewItemsList[$key] = $arItem;
        }
        $arNewItemsList[$key]['LAST_ELEMENT'] = 'Y';
        $arResult['ITEMS'] = $arNewItemsList;
        $arResult['SKU_PROPS'] = $arSKUPropList;
        $arResult['DEFAULT_PICTURE'] = $arEmptyPreview;

        $arResult['CURRENCIES'] = array();
        if ($arResult['MODULES']['currency'])
        {
            if ($boolConvert)
            {
                $currencyFormat = CCurrencyLang::GetFormatDescription($arResult['CONVERT_CURRENCY']['CURRENCY_ID']);
                $arResult['CURRENCIES'] = array(
                    array(
                        'CURRENCY' => $arResult['CONVERT_CURRENCY']['CURRENCY_ID'],
                        'FORMAT' => array(
                            'FORMAT_STRING' => $currencyFormat['FORMAT_STRING'],
                            'DEC_POINT' => $currencyFormat['DEC_POINT'],
                            'THOUSANDS_SEP' => $currencyFormat['THOUSANDS_SEP'],
                            'DECIMALS' => $currencyFormat['DECIMALS'],
                            'THOUSANDS_VARIANT' => $currencyFormat['THOUSANDS_VARIANT'],
                            'HIDE_ZERO' => $currencyFormat['HIDE_ZERO']
                        )
                    )
                );
                unset($currencyFormat);
            }
            else
            {
                $currencyIterator = CurrencyTable::getList(array(
                    'select' => array('CURRENCY')
                ));
                while ($currency = $currencyIterator->fetch())
                {
                    $currencyFormat = CCurrencyLang::GetFormatDescription($currency['CURRENCY']);
                    $arResult['CURRENCIES'][] = array(
                        'CURRENCY' => $currency['CURRENCY'],
                        'FORMAT' => array(
                            'FORMAT_STRING' => $currencyFormat['FORMAT_STRING'],
                            'DEC_POINT' => $currencyFormat['DEC_POINT'],
                            'THOUSANDS_SEP' => $currencyFormat['THOUSANDS_SEP'],
                            'DECIMALS' => $currencyFormat['DECIMALS'],
                            'THOUSANDS_VARIANT' => $currencyFormat['THOUSANDS_VARIANT'],
                            'HIDE_ZERO' => $currencyFormat['HIDE_ZERO']
                        )
                    );
                }
                unset($currencyFormat, $currency, $currencyIterator);
            }
        }
    }


    global $arWaterMark;


    $allSections = CIBlockSection::GetList(array("LEFT_MARGIN"=>"ASC"),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"]),false,array("UF_*")); 
    while($arSection = $allSections->GetNext()) {
        //current section info
        if ($arSection["ID"] == $arResult["ID"]) {
            $arResult["SECTION_INFO"] = $arSection;  
        }
        //sections groups by depth level
        $arResult["SECTIONS"][$arSection["DEPTH_LEVEL"]][$arSection["ID"]] = $arSection;  
    }


    //style page
    if ($arResult["DEPTH_LEVEL"] == 1) {   

        foreach ($arResult["SECTIONS"] as $depthLvl=>$sections) {
            foreach ($sections as $section) {
                //1st level
                if ($section["ID"] == $arResult["ID"]) {
                    $arResult["SECTION_STRUCTURE"] = $section; 
                } 
                //2nd level
                if ($section["IBLOCK_SECTION_ID"] == $arResult["ID"]) {
                    $arResult["SECTION_STRUCTURE"]["COLLECTIONS"][$section["ID"]] = $section;  
                }
                //3rd level
                if (array_key_exists($section["IBLOCK_SECTION_ID"],$arResult["SECTION_STRUCTURE"]["COLLECTIONS"])) {
                    // style rooms
                    foreach ($arResult["SECTIONS"][4] as $room) {
                        if ($room["IBLOCK_SECTION_ID"] == $section["ID"]) {
                            $section["ITEMS"][] = $room; 
                        }
                    }  

                    $arResult["SECTION_STRUCTURE"]["COLLECTIONS"][$section["IBLOCK_SECTION_ID"]]["ROOMS"][$section["ID"]] = $section; 

                }                 
            }
        }         
    }        

    //collection page
    if ($arResult["DEPTH_LEVEL"] == 2) { 
        //items groups by product type
        foreach ($arResult["ITEMS"] as $item) {
            if ($item["PROPERTIES"]["PRODUCT_TYPE"]["VALUE_ENUM_ID"]) {
                $arResult["PRODUCTS_BY_TYPES"][$item["PROPERTIES"]["PRODUCT_TYPE"]["VALUE_ENUM_ID"]][] = $item;
            }
        }

        //room types
        $roomTypes = CIBlockSection::GetList(array(),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"],"SECTION_ID"=>$arResult["ID"]),true);
        while($arRoomType = $roomTypes->GetNext()) {
            $arRoomType["ROOMS"] = 0;
            //current type rooms
            foreach ($arResult["SECTIONS"][4] as $thirdLvlSection) {
                if ($thirdLvlSection["IBLOCK_SECTION_ID"] == $arRoomType["ID"]) {
                    $arRoomType["ROOMS"]++; 
                }
            }
            $arResult["ROOM_TYPES"][] = $arRoomType;
        } 

        shuffle($arResult["ROOM_TYPES"]);

        //item types
        $productTypes = CIBlockProperty::GetPropertyEnum("PRODUCT_TYPE",array("VALUE"=>"ASC"),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"]));
        while($arProductType = $productTypes->Fetch()) {
            //get product picture for this type
            foreach ($arResult["PRODUCTS_BY_TYPES"][$arProductType["ID"]] as $product) {
                if ($product["DETAIL_PICTURE"]["SRC"]) {
                    $arProductType["PICTURE"] = $product["DETAIL_PICTURE"];
                    break; 
                }
            }

            $arResult["PRODUCT_TYPES"][$arProductType["ID"]] = $arProductType; 
        }

        //current style other collection
        foreach ($arResult["SECTIONS"][2] as $secondLvlSection) {
            if ($secondLvlSection["IBLOCK_SECTION_ID"] == $arResult["IBLOCK_SECTION_ID"] && $secondLvlSection["ID"] != $arResult["ID"]) {
                $arResult["OTHER_SECTIONS"][] = $secondLvlSection; 
            }
        }  
    }


    //room type page
    if ($arResult["DEPTH_LEVEL"] == 3) { 
        //items groups by product type
        foreach ($arResult["ITEMS"] as $item) {
            if ($item["PROPERTIES"]["PRODUCT_TYPE"]["VALUE_ENUM_ID"]) {
                $arResult["PRODUCTS_BY_TYPES"][$item["PROPERTIES"]["PRODUCT_TYPE"]["VALUE_ENUM_ID"]][] = $item;
            }
        }

        //room types
        $roomTypes = CIBlockSection::GetList(array(),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"],"SECTION_ID"=>$arResult["IBLOCK_SECTION_ID"]),true);
        while($arRoomType = $roomTypes->GetNext()) {
            $arResult["ROOM_TYPES"][] = $arRoomType;
        } 

        shuffle($arResult["ROOM_TYPES"]);

        //item types
        $productTypes = CIBlockProperty::GetPropertyEnum("PRODUCT_TYPE",array("VALUE"=>"ASC"),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"]));
        while($arProductType = $productTypes->Fetch()) {
            //get product picture for this type
            foreach ($arResult["PRODUCTS_BY_TYPES"][$arProductType["ID"]] as $product) {
                if ($product["DETAIL_PICTURE"]["SRC"]) {
                    $arProductType["PICTURE"] = $product["DETAIL_PICTURE"];
                    break; 
                }
            }

            $arResult["PRODUCT_TYPES"][$arProductType["ID"]] = $arProductType; 
        }

        //current style other collection
        foreach ($arResult["SECTIONS"][2] as $secondLvlSection) {
            //выбираем другие коллекции данного стиля
            if (
                //для страницы "коллекция" 
                ($secondLvlSection["IBLOCK_SECTION_ID"] == $arResult["IBLOCK_SECTION_ID"] && $secondLvlSection["ID"] != $arResult["ID"] && $arResult["DEPTH_LEVEL"] == 2) || 
                //для страницы "тип комнат"
                ($secondLvlSection["IBLOCK_SECTION_ID"] == $arResult["SECTIONS"][2][$arResult["IBLOCK_SECTION_ID"]]["IBLOCK_SECTION_ID"] && $arResult["DEPTH_LEVEL"] > 2 && $secondLvlSection["ID"] != $arResult["IBLOCK_SECTION_ID"])) 
            {
                $arResult["OTHER_SECTIONS"][] = $secondLvlSection; 
            }
        }  
    }


    //room page
    if ($arResult["DEPTH_LEVEL"] == 4) {
        //собирае инфо о магазинах

        //собираем ID складов, на которых есть товары из данной комнаты, тобы отобразить соответствующие магазины
        $itemId = array(); //ID товаров/ТП
        foreach ($arResult["ITEMS"] as $arItem) {
            if (is_array($arItem["OFFERS"]) && count($arItem["OFFERS"]) > 0) {
                foreach ($arItem["OFFERS"] as $offer) {
                    $itemId[] = $offer["ID"]; 
                }
            } else {
                $itemId[] = $arItem["ID"]; 
            }
        } 

        $arStoresID = array();        
        $rsStore = CCatalogStoreProduct::GetList(array(), array("PRODUCT_ID" =>$itemId, ">AMOUNT"=>0), false, false, array("STORE_ID")); 
        while ($arStore = $rsStore->Fetch()) {
            $arStoresID[] = $arStore["STORE_ID"];
        }     

        $arStoresID = array_unique($arStoresID);        

        $arResult["ITEM_STORES"] = $arStoresID;
        
        //собираем станции метро
        $stations = CIBlockElement::GetList(array(),array("IBLOCK_CODE"=>"metro"),false,false,array("ID","NAME","PROPERTY_LINE_COLOR"));
        while($arStation = $stations->Fetch()) {
            $arResult["METRO"][$arStation["ID"]] = $arStation;
        }    
        //список магазинов
        $shops = CIBLockElement::GetList(array(), array("IBLOCK_CODE"=>"shops","PROPERTY_WAREHOUSE"=>$arResult["ITEM_STORES"]),false,false,array("PROPERTY_METRO","NAME","ID","DETAIL_PAGE_URL","DETAIL_PICTURE")) ;
        while($arShop = $shops->GetNext()) {
            $arShop["METRO"] = array("NAME"=>$arResult["METRO"][$arShop["PROPERTY_METRO_VALUE"]]["NAME"],"COLOR"=>$arResult["METRO"][$arShop["PROPERTY_METRO_VALUE"]]["PROPERTY_LINE_COLOR_VALUE"],"ID"=>$arResult["METRO"][$arShop["PROPERTY_METRO_VALUE"]]["ID"]);
            $arResult["SHOPS"][] = $arShop;  
        }


        //собираем элементы для блока "обрати внимание"
        if (is_array($arResult["SECTIONS"][4][$arResult["ID"]]["UF_ATTENTION"]) && count($arResult["SECTIONS"][4][$arResult["ID"]]["UF_ATTENTION"]) > 0) { 

            //получаем ID коллекции
            $roomTypeID = $arResult["IBLOCK_SECTION_ID"];
            $collectionID = $arResult["SECTIONS"][3][$roomTypeID]["IBLOCK_SECTION_ID"];

            $ids = $arResult["SECTIONS"][4][$arResult["ID"]]["UF_ATTENTION"]; 
            //выбираем все элементы, привязанные к текущему разделу, а также элементы, относящиеся ко всем разделам (свойство FOR_ALL)
            $attention = CIBLockElement::GetList(array(), array("IBLOCK_CODE"=>"attention",array("LOGIC" => "OR",array("ID" => $ids),array("PROPERTY_FOR_ALL"=>$collectionID))),false,false,array("PROPERTY_VIDEO_LINK","NAME","ID","DETAIL_PICTURE","DETAIL_TEXT","PROPERTY_VISIBLE_NAME"));
            while($arAttentionItem = $attention->GetNext()) {
                if ($arAttentionItem["DETAIL_PICTURE"]) {

                    $imgID = $arAttentionItem["DETAIL_PICTURE"];
                    //накладываем водяной знак на детальную картинку
                    $detailPictureSrc = CFile::ResizeImageGet($arAttentionItem["DETAIL_PICTURE"],array("width"=>1000,"height"=>1000),BX_RESIZE_IMAGE_PROPORTIONAL,true,$arWaterMark);

                    $sourseImgLink = $detailPictureSrc["src"];
                    $img = CFIle::ResizeImageGet($imgID,array("width"=>446,"height"=>312),BX_RESIZE_IMAGE_EXACT);
                    $arAttentionItem["DETAIL_PICTURE"] = array();
                    $arAttentionItem["DETAIL_PICTURE"]["ID"] = $arAttentionItem["DETAIL_PICTURE"];
                    $arAttentionItem["DETAIL_PICTURE"]["SRC"] = $img["src"];
                }

                $arAttentionItem["LINK"] = "";

                if ($arAttentionItem["PROPERTY_VIDEO_LINK_VALUE"]) {
                    $arAttentionItem["LINK"] = $arAttentionItem["PROPERTY_VIDEO_LINK_VALUE"]; 
                }
                else if ($sourseImgLink){
                    $arAttentionItem["LINK"] = $sourseImgLink; 
                }

                if ($arAttentionItem["PROPERTY_VISIBLE_NAME_VALUE"]) {
                    $arAttentionItem["NAME"] = $arAttentionItem["PROPERTY_VISIBLE_NAME_VALUE"]; 
                }

                $arResult["ATTENTION"][] = $arAttentionItem; 
            }

        }

        //собираем варианты цветов для комнаты
        if (is_array($arResult["SECTIONS"][4][$arResult["ID"]]["UF_COLOR_VARIANTS"]) && count($arResult["SECTIONS"][4][$arResult["ID"]]["UF_COLOR_VARIANTS"]) > 0) {
            //собираем образцы цветов
            $colorList = CIBLockELement::GetList(array(),array("IBLOCK_CODE"=>"colors"),false,false,array("PROPERTY_COLOR_TEMPLATE", "PROPERTY_SERVICE_NAME", "NAME","ID","DETAIL_PICTURE","DETAIL_TEXT"));
            while($arColor = $colorList->Fetch()) {
                $arColorPath = CFile::ResizeImageGet($arColor["PROPERTY_COLOR_TEMPLATE_VALUE"],array("width"=>130,"height"=>130),BX_RESIZE_IMAGE_EXACT);
                $arColor["COLOR_TEMPLATE_PATH"] = $arColorPath["src"];
                //если есть служебное название - выводим его вместо обычного названия
                if (!empty($arColor["PROPERTY_SERVICE_NAME_VALUE"])) {
                    $arColor["NAME"] = $arColor["PROPERTY_SERVICE_NAME_VALUE"]; 
                }
                $arResult["COLORS_LIST"][$arColor["ID"]] = $arColor;
            }
            //
            $ids = $arResult["SECTIONS"][4][$arResult["ID"]]["UF_COLOR_VARIANTS"];
            $sectionColors = CIBlockElement::GetList(array("SORT"=>"ASC"),array("IBLOCK_CODE"=>"rooms_colors","ID"=>$ids),false,false,array("ID","NAME","PROPERTY_COLOR","DETAIL_PICTURE","DETAIL_TEXT"));
            while($arSectionColor = $sectionColors->Fetch()) {
                $arResult["SECTION_COLORS"][] = $arSectionColor;
            }
        }

        /*
        //находим следующую и предыдущую комнату
        foreach ($arResult["SECTIONS"][4] as $section) {
        //соседние разделы (комнаты того же типа)
        if ($section["IBLOCK_SECTION_ID"] == $arResult["IBLOCK_SECTION_ID"]  && $section["ID"] != $arResult["ID"]) {
        $arResult["OTHER_ROOMS"][$section["ID"]] = $section; 
        }
        }

        ksort($arResult["OTHER_ROOMS"]);
        reset($arResult["OTHER_ROOMS"]);

        $prevRoom = 0;
        $nextRoom = 0;
        foreach ($arResult["OTHER_ROOMS"] as $otherRoom) {
        if ($otherRoom["ID"] < $arResult["ID"] && $otherRoom["ID"] > $prevRoom) {
        $prevRoom = $otherRoom["ID"]; 
        }

        if ($otherRoom["ID"] > $arResult["ID"] && $otherRoom["ID"] > $nextRoom) {
        $nextRoom = $otherRoom["ID"]; 
        }
        }

        if ($prevRoom > 0) {
        $arResult["PREV_ROOM"] = $otherRoom[$prevRoom];
        }

        if ($nextRoom > 0) {
        $arResult["NEXT_ROOM"] = $otherRoom[$nextRoom];
        } */ 

        //комнаты того же типа из данной коллекции
        foreach ($arResult["SECTIONS"][4] as $section) {
            //соседние разделы (комнаты того же типа)
            if ($section["IBLOCK_SECTION_ID"] == $arResult["IBLOCK_SECTION_ID"] && $section["ID"] != $arResult["ID"]) {
                $arResult["OTHER_ROOMS"][] = $section; 
            }
        }  

        shuffle($arResult["OTHER_ROOMS"]); 
    }


    //search result
    if ($_REQUEST["search"] && strlen($_REQUEST["search"]) > 0 && trim($_REQUEST["search"]) != "") {
        $search = trim($_REQUEST["search"]);
        $items =  CIBlockElement::GetList(array(),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE"=>"Y", "?NAME"=>$search, "SECTION_ID"=>$arResult["ID"],"INCLUDE_SUBSECTIONS"=>"Y"),false,false,array("ID","NAME","DETAIL_PICTURE","DETAIL_PAGE_URL"));
        while($arItem = $items->GetNext()) {
            $arResult["SEARCH_RESULT"]["ITEMS"][] = $arItem;
        }

        $sections =  CIBlockSection::GetList(array(),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE"=>"Y", "NAME"=>"%".$search."%", "SECTION_ID"=>$arResult["ID"],"INCLUDE_SUBSECTIONS"=>"Y"));
        while($arSection = $sections->GetNext()) {
            $arResult["SEARCH_RESULT"]["SECTIONS"][] = $arSection;
        }            
    }

    $arResult["TOTAL_PRICE"] = 0;
    foreach ($arResult["ITEMS"] as $i=>$item) {

        //ресайз изображений
        $img = CFIle::ResizeImageGet($item["DETAIL_PICTURE"]["ID"],array("width"=>446,"height"=>300),BX_RESIZE_IMAGE_EXACT);
        $arResult["ITEMS"][$i]["DETAIL_PICTURE"]["SRC"] = $img["src"];
        //если у товара есть предложения
        if (is_array($item["OFFERS"]) && count($item["OFFERS"]) > 0) {  

            $minOfferPrice = 0;     
            foreach ($item["OFFERS"] as $o=>$offer) {
                foreach($arResult["PRICES"] as $code=>$arPrice){                        
                    if($arPrice = $offer["PRICES"][$code]){
                        if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]){
                            $offerPrice = $arPrice["DISCOUNT_VALUE"];
                        } else {
                            $offerPrice = $arPrice["VALUE"];
                        }

                        if ($offerPrice < $minOfferPrice || $minOfferPrice == 0) {
                            $minOfferPrice = $offerPrice;
                            $arResult["ITEMS"][$i]["MIN_PRICE"] = number_format($minOfferPrice, 0 , "." , " ");;
                        }
                    }
                } 
            }

            $arResult["TOTAL_PRICE"] += $minOfferPrice;
            //если товар без торговых предложений    
        } else {
            foreach($arResult["PRICES"] as $code=>$arPrice){  
                if($arPrice = $item["PRICES"][$code]){
                    if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]){
                        $arResult["TOTAL_PRICE"] += $arPrice["DISCOUNT_VALUE"];
                    } else {
                        $arResult["TOTAL_PRICE"] += $arPrice["VALUE"];
                    }
                    break;
                }
            }
        }
    } 

    $arResult["TOTAL_PRICE"] = number_format($arResult["TOTAL_PRICE"], 0 , "." , " ");

    //проверяем наличие товаров каждого типа
    if (is_array($arResult["PRODUCT_TYPES"]) && count($arResult["PRODUCT_TYPES"]) > 0) {
        if ($arResult["DEPTH_LEVEL"] == 3) {
            $sectionID = $arResult["IBLOCK_SECTION_ID"];
        } else if ($arResult["DEPTH_LEVEL"] == 2) {
            $sectionID = $arResult["ID"];
        }                             

        //собираем ID типов товаров, которые есть в данной коллекции
        $sectionProductTypes = array(); //массив ID типов товаров в текущей коллекции
        $itemsCheck = CIBlockElement::GetList(array(),array("SECTION_ID"=>$sectionID, "INCLUDE_SUBSECTIONS"=>"Y"),false,false,array("ID","PROPERTY_PRODUCT_TYPE"));
        while($arItemsCheck = $itemsCheck->Fetch()) {
            $sectionProductTypes[$arItemsCheck["PROPERTY_PRODUCT_TYPE_ENUM_ID"]] = $arItemsCheck["PROPERTY_PRODUCT_TYPE_ENUM_ID"];
        }

        //проверяем, товары каких типов есть в коллекции. Если товаров какого-то типа нет - удаляем данный тип из списка
        foreach ($arResult["PRODUCT_TYPES"] as $tID => $type) {
            if (!in_array($type["ID"],$sectionProductTypes)) {
                unset($arResult["PRODUCT_TYPES"][$tID]);
            }
        }                
    }



?>