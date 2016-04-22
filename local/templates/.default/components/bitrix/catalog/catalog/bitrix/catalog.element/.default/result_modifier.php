<?
    use Bitrix\Main\Type\Collection;
    use Bitrix\Currency\CurrencyTable;
    use Bitrix\Iblock;

    if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
    /** @var CBitrixComponentTemplate $this */
    /** @var array $arParams */
    /** @var array $arResult */
    $displayPreviewTextMode = array(
        'H' => true,
        'E' => true,
        'S' => true
    );
    $detailPictMode = array(
        'IMG' => true,
        'POPUP' => true,
        'MAGNIFIER' => true,
        'GALLERY' => true
    );

    $arDefaultParams = array(
        'TEMPLATE_THEME' => 'blue',
        'ADD_PICT_PROP' => '-',
        'LABEL_PROP' => '-',
        'OFFER_ADD_PICT_PROP' => '-',
        'OFFER_TREE_PROPS' => array('-'),
        'DISPLAY_NAME' => 'Y',
        'DETAIL_PICTURE_MODE' => 'IMG',
        'ADD_DETAIL_TO_SLIDER' => 'N',
        'DISPLAY_PREVIEW_TEXT_MODE' => 'E',
        'PRODUCT_SUBSCRIPTION' => 'N',
        'SHOW_DISCOUNT_PERCENT' => 'N',
        'SHOW_OLD_PRICE' => 'N',
        'SHOW_MAX_QUANTITY' => 'N',
        'SHOW_BASIS_PRICE' => 'N',
        'ADD_TO_BASKET_ACTION' => array('BUY'),
        'SHOW_CLOSE_POPUP' => 'N',
        'MESS_BTN_BUY' => '',
        'MESS_BTN_ADD_TO_BASKET' => '',
        'MESS_BTN_SUBSCRIBE' => '',
        'MESS_BTN_COMPARE' => '',
        'MESS_NOT_AVAILABLE' => '',
        'USE_VOTE_RATING' => 'N',
        'VOTE_DISPLAY_AS_RATING' => 'rating',
        'USE_COMMENTS' => 'N',
        'BLOG_USE' => 'N',
        'BLOG_URL' => 'catalog_comments',
        'BLOG_EMAIL_NOTIFY' => 'N',
        'VK_USE' => 'N',
        'VK_API_ID' => '',
        'FB_USE' => 'N',
        'FB_APP_ID' => '',
        'BRAND_USE' => 'N',
        'BRAND_PROP_CODE' => ''
    );
    $arParams = array_merge($arDefaultParams, $arParams);

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

    $arParams['ADD_PICT_PROP'] = trim($arParams['ADD_PICT_PROP']);
    if ('-' == $arParams['ADD_PICT_PROP'])
        $arParams['ADD_PICT_PROP'] = '';
    $arParams['LABEL_PROP'] = trim($arParams['LABEL_PROP']);
    if ('-' == $arParams['LABEL_PROP'])
        $arParams['LABEL_PROP'] = '';
    $arParams['OFFER_ADD_PICT_PROP'] = trim($arParams['OFFER_ADD_PICT_PROP']);
    if ('-' == $arParams['OFFER_ADD_PICT_PROP'])
        $arParams['OFFER_ADD_PICT_PROP'] = '';
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
    if ('N' != $arParams['DISPLAY_NAME'])
        $arParams['DISPLAY_NAME'] = 'Y';
    if (!isset($detailPictMode[$arParams['DETAIL_PICTURE_MODE']]))
        $arParams['DETAIL_PICTURE_MODE'] = 'IMG';
    if ('Y' != $arParams['ADD_DETAIL_TO_SLIDER'])
        $arParams['ADD_DETAIL_TO_SLIDER'] = 'N';
    if (!isset($displayPreviewTextMode[$arParams['DISPLAY_PREVIEW_TEXT_MODE']]))
        $arParams['DISPLAY_PREVIEW_TEXT_MODE'] = 'E';
    if ('Y' != $arParams['PRODUCT_SUBSCRIPTION'])
        $arParams['PRODUCT_SUBSCRIPTION'] = 'N';
    if ('Y' != $arParams['SHOW_DISCOUNT_PERCENT'])
        $arParams['SHOW_DISCOUNT_PERCENT'] = 'N';
    if ('Y' != $arParams['SHOW_OLD_PRICE'])
        $arParams['SHOW_OLD_PRICE'] = 'N';
    if ('Y' != $arParams['SHOW_MAX_QUANTITY'])
        $arParams['SHOW_MAX_QUANTITY'] = 'N';
    if ($arParams['SHOW_BASIS_PRICE'] != 'Y')
        $arParams['SHOW_BASIS_PRICE'] = 'N';
    if (!is_array($arParams['ADD_TO_BASKET_ACTION']))
        $arParams['ADD_TO_BASKET_ACTION'] = array($arParams['ADD_TO_BASKET_ACTION']);
    $arParams['ADD_TO_BASKET_ACTION'] = array_filter($arParams['ADD_TO_BASKET_ACTION'], 'CIBlockParameters::checkParamValues');
    if (empty($arParams['ADD_TO_BASKET_ACTION']) || (!in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']) && !in_array('BUY', $arParams['ADD_TO_BASKET_ACTION'])))
        $arParams['ADD_TO_BASKET_ACTION'] = array('BUY');
    if ($arParams['SHOW_CLOSE_POPUP'] != 'Y')
        $arParams['SHOW_CLOSE_POPUP'] = 'N';

    $arParams['MESS_BTN_BUY'] = trim($arParams['MESS_BTN_BUY']);
    $arParams['MESS_BTN_ADD_TO_BASKET'] = trim($arParams['MESS_BTN_ADD_TO_BASKET']);
    $arParams['MESS_BTN_SUBSCRIBE'] = trim($arParams['MESS_BTN_SUBSCRIBE']);
    $arParams['MESS_BTN_COMPARE'] = trim($arParams['MESS_BTN_COMPARE']);
    $arParams['MESS_NOT_AVAILABLE'] = trim($arParams['MESS_NOT_AVAILABLE']);
    if ('Y' != $arParams['USE_VOTE_RATING'])
        $arParams['USE_VOTE_RATING'] = 'N';
    if ('vote_avg' != $arParams['VOTE_DISPLAY_AS_RATING'])
        $arParams['VOTE_DISPLAY_AS_RATING'] = 'rating';
    if ('Y' != $arParams['USE_COMMENTS'])
        $arParams['USE_COMMENTS'] = 'N';
    if ('Y' != $arParams['BLOG_USE'])
        $arParams['BLOG_USE'] = 'N';
    if ('Y' != $arParams['VK_USE'])
        $arParams['VK_USE'] = 'N';
    if ('Y' != $arParams['FB_USE'])
        $arParams['FB_USE'] = 'N';
    if ('Y' == $arParams['USE_COMMENTS'])
    {
        if ('N' == $arParams['BLOG_USE'] && 'N' == $arParams['VK_USE'] && 'N' == $arParams['FB_USE'])
            $arParams['USE_COMMENTS'] = 'N';
    }
    if ('Y' != $arParams['BRAND_USE'])
        $arParams['BRAND_USE'] = 'N';
    if ($arParams['BRAND_PROP_CODE'] == '')
        $arParams['BRAND_PROP_CODE'] = array();
    if (!is_array($arParams['BRAND_PROP_CODE']))
        $arParams['BRAND_PROP_CODE'] = array($arParams['BRAND_PROP_CODE']);

    $arEmptyPreview = false;
    $strEmptyPreview = $this->GetFolder().'/images/no_photo.png';
    if (file_exists($_SERVER['DOCUMENT_ROOT'].$strEmptyPreview))
    {
        $arSizes = getimagesize($_SERVER['DOCUMENT_ROOT'].$strEmptyPreview);
        if (!empty($arSizes))
        {
            $arEmptyPreview = array(
                'SRC' => $strEmptyPreview,
                'WIDTH' => (int)$arSizes[0],
                'HEIGHT' => (int)$arSizes[1]
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

        if ($boolSKU && !empty($arParams['OFFER_TREE_PROPS']))
        {
            $arSKUPropList = CIBlockPriceTools::getTreeProperties(
                $arSKU,
                $arParams['OFFER_TREE_PROPS'],
                array(
                    'PICT' => $arEmptyPreview,
                    'NAME' => '-'
                )
            );
            $arSKUPropIDs = array_keys($arSKUPropList);
        }
    }

    $arResult['CHECK_QUANTITY'] = false;
    if (!isset($arResult['CATALOG_MEASURE_RATIO']))
        $arResult['CATALOG_MEASURE_RATIO'] = 1;
    if (!isset($arResult['CATALOG_QUANTITY']))
        $arResult['CATALOG_QUANTITY'] = 0;
    $arResult['CATALOG_QUANTITY'] = (
        0 < $arResult['CATALOG_QUANTITY'] && is_float($arResult['CATALOG_MEASURE_RATIO'])
        ? (float)$arResult['CATALOG_QUANTITY']
        : (int)$arResult['CATALOG_QUANTITY']
    );
    $arResult['CATALOG'] = false;
    if (!isset($arResult['CATALOG_SUBSCRIPTION']) || 'Y' != $arResult['CATALOG_SUBSCRIPTION'])
        $arResult['CATALOG_SUBSCRIPTION'] = 'N';

    CIBlockPriceTools::getLabel($arResult, $arParams['LABEL_PROP']);

    $productSlider = CIBlockPriceTools::getSliderForItem($arResult, $arParams['ADD_PICT_PROP'], 'Y' == $arParams['ADD_DETAIL_TO_SLIDER']);
    if (empty($productSlider))
    {
        $productSlider = array(
            0 => $arEmptyPreview
        );
    }
    $productSliderCount = count($productSlider);
    $arResult['SHOW_SLIDER'] = true;
    $arResult['MORE_PHOTO'] = $productSlider;
    $arResult['MORE_PHOTO_COUNT'] = count($productSlider);

    if ($arResult['MODULES']['catalog'])
    {
        $arResult['CATALOG'] = true;
        if (!isset($arResult['CATALOG_TYPE']))
            $arResult['CATALOG_TYPE'] = CCatalogProduct::TYPE_PRODUCT;
        if (
            (CCatalogProduct::TYPE_PRODUCT == $arResult['CATALOG_TYPE'] || CCatalogProduct::TYPE_SKU == $arResult['CATALOG_TYPE'])
            && !empty($arResult['OFFERS'])
        )
        {
            $arResult['CATALOG_TYPE'] = CCatalogProduct::TYPE_SKU;
        }
        switch ($arResult['CATALOG_TYPE'])
        {
            case CCatalogProduct::TYPE_SET:
                $arResult['OFFERS'] = array();
                $arResult['CHECK_QUANTITY'] = ('Y' == $arResult['CATALOG_QUANTITY_TRACE'] && 'N' == $arResult['CATALOG_CAN_BUY_ZERO']);
                break;
            case CCatalogProduct::TYPE_SKU:
                break;
            case CCatalogProduct::TYPE_PRODUCT:
            default:
                $arResult['CHECK_QUANTITY'] = ('Y' == $arResult['CATALOG_QUANTITY_TRACE'] && 'N' == $arResult['CATALOG_CAN_BUY_ZERO']);
                break;
        }
    }
    else
    {
        $arResult['CATALOG_TYPE'] = 0;
        $arResult['OFFERS'] = array();
    }

    if ($arResult['CATALOG'] && isset($arResult['OFFERS']) && !empty($arResult['OFFERS']))
    {
        $boolSKUDisplayProps = false;

        $arResultSKUPropIDs = array();
        $arFilterProp = array();
        $arNeedValues = array();
        foreach ($arResult['OFFERS'] as &$arOffer)
        {
            foreach ($arSKUPropIDs as &$strOneCode)
            {
                if (isset($arOffer['DISPLAY_PROPERTIES'][$strOneCode]))
                {
                    $arResultSKUPropIDs[$strOneCode] = true;
                    if (!isset($arNeedValues[$arSKUPropList[$strOneCode]['ID']]))
                        $arNeedValues[$arSKUPropList[$strOneCode]['ID']] = array();
                    $valueId = (
                        $arSKUPropList[$strOneCode]['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_LIST
                        ? $arOffer['DISPLAY_PROPERTIES'][$strOneCode]['VALUE_ENUM_ID']
                        : $arOffer['DISPLAY_PROPERTIES'][$strOneCode]['VALUE']
                    );
                    $arNeedValues[$arSKUPropList[$strOneCode]['ID']][$valueId] = $valueId;
                    unset($valueId);
                    if (!isset($arFilterProp[$strOneCode]))
                        $arFilterProp[$strOneCode] = $arSKUPropList[$strOneCode];
                }
            }
            unset($strOneCode);
        }
        unset($arOffer);

        CIBlockPriceTools::getTreePropertyValues($arSKUPropList, $arNeedValues);
        $arSKUPropIDs = array_keys($arSKUPropList);
        $arSKUPropKeys = array_fill_keys($arSKUPropIDs, false);


        $arMatrixFields = $arSKUPropKeys;
        $arMatrix = array();

        $arNewOffers = array();

        $arIDS = array($arResult['ID']);
        $arOfferSet = array();
        $arResult['OFFER_GROUP'] = false;
        $arResult['OFFERS_PROP'] = false;

        $arDouble = array();
        foreach ($arResult['OFFERS'] as $keyOffer => $arOffer)
        {
            $arOffer['ID'] = (int)$arOffer['ID'];
            if (isset($arDouble[$arOffer['ID']]))
                continue;
            $arIDS[] = $arOffer['ID'];
            $boolSKUDisplayProperties = false;
            $arOffer['OFFER_GROUP'] = false;
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
                        $arCell['VALUE'] = (int)$arOffer['DISPLAY_PROPERTIES'][$strOneCode]['VALUE_ENUM_ID'];
                    }
                    elseif ('E' == $arSKUPropList[$strOneCode]['PROPERTY_TYPE'])
                    {
                        $arCell['VALUE'] = (int)$arOffer['DISPLAY_PROPERTIES'][$strOneCode]['VALUE'];
                    }
                    $arCell['SORT'] = $arSKUPropList[$strOneCode]['VALUES'][$arCell['VALUE']]['SORT'];
                }
                $arRow[$strOneCode] = $arCell;
            }
            $arMatrix[$keyOffer] = $arRow;

            CIBlockPriceTools::setRatioMinPrice($arOffer, false);

            $arOffer['MORE_PHOTO'] = array();
            $arOffer['MORE_PHOTO_COUNT'] = 0;
            $offerSlider = CIBlockPriceTools::getSliderForItem($arOffer, $arParams['OFFER_ADD_PICT_PROP'], $arParams['ADD_DETAIL_TO_SLIDER'] == 'Y');
            if (empty($offerSlider))
            {
                $offerSlider = $productSlider;
            }
            $arOffer['MORE_PHOTO'] = $offerSlider;
            $arOffer['MORE_PHOTO_COUNT'] = count($offerSlider);

            if (CIBlockPriceTools::clearProperties($arOffer['DISPLAY_PROPERTIES'], $arParams['OFFER_TREE_PROPS']))
            {
                $boolSKUDisplayProps = true;
            }

            $arDouble[$arOffer['ID']] = true;
            $arNewOffers[$keyOffer] = $arOffer;
        }
        $arResult['OFFERS'] = $arNewOffers;
        $arResult['SHOW_OFFERS_PROPS'] = $boolSKUDisplayProps;

        $arUsedFields = array();
        $arSortFields = array();

        foreach ($arSKUPropIDs as $propkey => $strOneCode)
        {
            $boolExist = $arMatrixFields[$strOneCode];
            foreach ($arMatrix as $keyOffer => $arRow)
            {
                if ($boolExist)
                {
                    if (!isset($arResult['OFFERS'][$keyOffer]['TREE']))
                        $arResult['OFFERS'][$keyOffer]['TREE'] = array();
                    $arResult['OFFERS'][$keyOffer]['TREE']['PROP_'.$arSKUPropList[$strOneCode]['ID']] = $arMatrix[$keyOffer][$strOneCode]['VALUE'];
                    $arResult['OFFERS'][$keyOffer]['SKU_SORT_'.$strOneCode] = $arMatrix[$keyOffer][$strOneCode]['SORT'];
                    $arUsedFields[$strOneCode] = true;
                    $arSortFields['SKU_SORT_'.$strOneCode] = SORT_NUMERIC;
                }
                else
                {
                    unset($arMatrix[$keyOffer][$strOneCode]);
                }
            }
        }
        $arResult['OFFERS_PROP'] = $arUsedFields;
        $arResult['OFFERS_PROP_CODES'] = (!empty($arUsedFields) ? base64_encode(serialize(array_keys($arUsedFields))) : '');

        Collection::sortByColumn($arResult['OFFERS'], $arSortFields);

        $offerSet = array();
        if (!empty($arIDS) && CBXFeatures::IsFeatureEnabled('CatCompleteSet'))
        {
            $offerSet = array_fill_keys($arIDS, false);
            $rsSets = CCatalogProductSet::getList(
                array(),
                array(
                    '@OWNER_ID' => $arIDS,
                    '=SET_ID' => 0,
                    '=TYPE' => CCatalogProductSet::TYPE_GROUP
                ),
                false,
                false,
                array('ID', 'OWNER_ID')
            );
            while ($arSet = $rsSets->Fetch())
            {
                $arSet['OWNER_ID'] = (int)$arSet['OWNER_ID'];
                $offerSet[$arSet['OWNER_ID']] = true;
                $arResult['OFFER_GROUP'] = true;
            }
            if ($offerSet[$arResult['ID']])
            {
                foreach ($offerSet as &$setOfferValue)
                {
                    if ($setOfferValue === false)
                    {
                        $setOfferValue = true;
                    }
                }
                unset($setOfferValue);
                unset($offerSet[$arResult['ID']]);
            }
            if ($arResult['OFFER_GROUP'])
            {
                $offerSet = array_filter($offerSet);
                $arResult['OFFER_GROUP_VALUES'] = array_keys($offerSet);
            }
        }

        $arMatrix = array();
        $intSelected = -1;
        $arResult['MIN_PRICE'] = false;
        $arResult['MIN_BASIS_PRICE'] = false;
        foreach ($arResult['OFFERS'] as $keyOffer => $arOffer)
        {
            if (empty($arResult['MIN_PRICE']) && $arOffer['CAN_BUY'])
            {
                $intSelected = $keyOffer;
                $arResult['MIN_PRICE'] = (isset($arOffer['RATIO_PRICE']) ? $arOffer['RATIO_PRICE'] : $arOffer['MIN_PRICE']);
                $arResult['MIN_BASIS_PRICE'] = $arOffer['MIN_PRICE'];
            }
            $arSKUProps = false;
            if (!empty($arOffer['DISPLAY_PROPERTIES']))
            {
                $boolSKUDisplayProps = true;
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
            if (isset($arOfferSet[$arOffer['ID']]))
            {
                $arOffer['OFFER_GROUP'] = true;
                $arResult['OFFERS'][$keyOffer]['OFFER_GROUP'] = true;
            }
            reset($arOffer['MORE_PHOTO']);
            $firstPhoto = current($arOffer['MORE_PHOTO']);
            $arOneRow = array(
                'ID' => $arOffer['ID'],
                'NAME' => $arOffer['~NAME'],
                'TREE' => $arOffer['TREE'],
                'PRICE' => (isset($arOffer['RATIO_PRICE']) ? $arOffer['RATIO_PRICE'] : $arOffer['MIN_PRICE']),
                'BASIS_PRICE' => $arOffer['MIN_PRICE'],
                'DISPLAY_PROPERTIES' => $arSKUProps,
                'PREVIEW_PICTURE' => $firstPhoto,
                'DETAIL_PICTURE' => $firstPhoto,
                'CHECK_QUANTITY' => $arOffer['CHECK_QUANTITY'],
                'MAX_QUANTITY' => $arOffer['CATALOG_QUANTITY'],
                'STEP_QUANTITY' => $arOffer['CATALOG_MEASURE_RATIO'],
                'QUANTITY_FLOAT' => is_double($arOffer['CATALOG_MEASURE_RATIO']),
                'MEASURE' => $arOffer['~CATALOG_MEASURE_NAME'],
                'OFFER_GROUP' => (isset($offerSet[$arOffer['ID']]) && $offerSet[$arOffer['ID']]),
                'CAN_BUY' => $arOffer['CAN_BUY'],
                'SLIDER' => $arOffer['MORE_PHOTO'],
                'SLIDER_COUNT' => $arOffer['MORE_PHOTO_COUNT'],
            );
            $arMatrix[$keyOffer] = $arOneRow;
        }
        if (-1 == $intSelected)
            $intSelected = 0;
        $arResult['JS_OFFERS'] = $arMatrix;
        $arResult['OFFERS_SELECTED'] = $intSelected;
        if ($arMatrix[$intSelected]['SLIDER_COUNT'] > 0)
        {
            $arResult['MORE_PHOTO'] = $arMatrix[$intSelected]['SLIDER'];
            $arResult['MORE_PHOTO_COUNT'] = $arMatrix[$intSelected]['SLIDER_COUNT'];
        }

        $arResult['OFFERS_IBLOCK'] = $arSKU['IBLOCK_ID'];
    }

    if ($arResult['MODULES']['catalog'] && $arResult['CATALOG'])
    {
        if ($arResult['CATALOG_TYPE'] == CCatalogProduct::TYPE_PRODUCT || $arResult['CATALOG_TYPE'] == CCatalogProduct::TYPE_SET)
        {
            CIBlockPriceTools::setRatioMinPrice($arResult, false);
            $arResult['MIN_BASIS_PRICE'] = $arResult['MIN_PRICE'];
        }
        if (CBXFeatures::IsFeatureEnabled('CatCompleteSet') && $arResult['CATALOG_TYPE'] == CCatalogProduct::TYPE_PRODUCT)
        {
            $rsSets = CCatalogProductSet::getList(
                array(),
                array(
                    '@OWNER_ID' => $arResult['ID'],
                    '=SET_ID' => 0,
                    '=TYPE' => CCatalogProductSet::TYPE_GROUP
                ),
                false,
                false,
                array('ID', 'OWNER_ID')
            );
            if ($arSet = $rsSets->Fetch())
            {
                $arResult['OFFER_GROUP'] = true;
            }
        }
    }

    if (!empty($arResult['DISPLAY_PROPERTIES']))
    {
        foreach ($arResult['DISPLAY_PROPERTIES'] as $propKey => $arDispProp)
        {
            if ('F' == $arDispProp['PROPERTY_TYPE'])
                unset($arResult['DISPLAY_PROPERTIES'][$propKey]);
        }
    }

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

    global $arWaterMark; //задается в init.php

    //собираем все материалы
    $materials = CIBlockElement::GetList(array("SORT"=>"ASC"),array("IBLOCK_CODE"=>"materials","ACTIVE"=>"Y"),false,false,array("ID","NAME"));
    while($arMaterial = $materials->Fetch()) {
        $arResult["MATERIALS"][$arMaterial["ID"]] = $arMaterial["NAME"];
    }

    //собираем все фурнитуру
    $findings = CIBlockElement::GetList(array("SORT"=>"ASC"),array("IBLOCK_CODE"=>"findings","ACTIVE"=>"Y"),false,false,array("ID","NAME"));
    while($arFindings = $findings->Fetch()) {
        $arResult["FINDINGS"][$arFindings["ID"]] = $arFindings["NAME"];
    }

    //собираем все разделы
    $allSections = CIBlockSection::GetList(array("LEFT_MARGIN"=>"ASC"),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"]),false,array("UF_*")); 
    while($arSection = $allSections->GetNext()) {
        //current section info
        if ($arSection["ID"] == $arResult["ID"]) {
            $arResult["SECTION_INFO"] = $arSection;  
        }
        //sections groups by depth level
        $arResult["SECTIONS"][$arSection["DEPTH_LEVEL"]][$arSection["ID"]] = $arSection;  
    }


    //собираем цвета
    $colorList = CIBLockELement::GetList(array(),array("IBLOCK_CODE"=>"colors"),false,false,array("PROPERTY_COLOR_TEMPLATE", "PROPERTY_SERVICE_NAME", "NAME","ID","DETAIL_PICTURE","DETAIL_TEXT"));
    while($arColor = $colorList->Fetch()) {
        $arColorPath = CFile::ResizeImageGet($arColor["PROPERTY_COLOR_TEMPLATE_VALUE"],array("width"=>85,"height"=>85),BX_RESIZE_IMAGE_EXACT);
        $arColor["COLOR_TEMPLATE_PATH"] = $arColorPath["src"];
        //если есть служебное название - выводим его вместо обычного названия
        if (!empty($arColor["PROPERTY_SERVICE_NAME_VALUE"])) {
            $arColor["NAME"] = $arColor["PROPERTY_SERVICE_NAME_VALUE"]; 
        }
        $arResult["COLORS_LIST"][$arColor["ID"]] = $arColor;
    }          


    //собираем элементы для блока "обрати внимание"
    if (is_array($arResult["PROPERTIES"]["ATTENTION"]["VALUE"]) && count($arResult["PROPERTIES"]["ATTENTION"]["VALUE"]) > 0) { 

        //получаем ID коллекции
        $roomID = $arResult["IBLOCK_SECTION_ID"];
        $roomTypeID = $arResult["SECTIONS"][4][$roomID]["IBLOCK_SECTION_ID"];
        $collectionID = $arResult["SECTIONS"][3][$roomTypeID]["IBLOCK_SECTION_ID"];

        $ids = $arResult["PROPERTIES"]["ATTENTION"]["VALUE"]; 
        //выбираем все элементы, привязанные к текущему разделу, а также элементы, относящиеся ко всем разделам (свойство FOR_ALL)
        $attention = CIBLockElement::GetList(array(), array("IBLOCK_CODE"=>"attention",array("LOGIC" => "OR",array("ID" => $ids),array("PROPERTY_FOR_ALL"=>$collectionID))),false,false,array("PROPERTY_VIDEO_LINK","NAME","ID","DETAIL_PICTURE","DETAIL_TEXT","PROPERTY_VISIBLE_NAME"));
        while($arAttentionItem = $attention->GetNext()) {
            if ($arAttentionItem["DETAIL_PICTURE"]) {

                $imgID = $arAttentionItem["DETAIL_PICTURE"];
                //накладываем водяной знак на детальную картинку
                $detailPictureSrc = CFile::ResizeImageGet($arAttentionItem["DETAIL_PICTURE"],array("width"=>920,"height"=>620),BX_RESIZE_IMAGE_PROPORTIONAL,true,$arWaterMark);

                $sourseImgLink = $detailPictureSrc["src"];
                $img = CFIle::ResizeImageGet($imgID,array("width"=>446,"height"=>312),BX_RESIZE_IMAGE_EXACT);
                $imgInfo = CFile::GetFileArray($imgID);
                $arAttentionItem["DETAIL_PICTURE"] = array();
                $arAttentionItem["DETAIL_PICTURE"]["ID"] = $arAttentionItem["DETAIL_PICTURE"];
                $arAttentionItem["DETAIL_PICTURE"]["SRC"] = $img["src"];
                $arAttentionItem["DETAIL_PICTURE"]["DESCRIPTION"] = $imgInfo["DESCRIPTION"]; 
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

    //собираем элементы для блока "уход за мебелью"
    if ($arResult["PROPERTIES"]["CARE"]["VALUE"]) {
        $careElements = CIBLockElement::GetList(array(),array("IBLOCK_CODE"=>"furniture_care","SECTION_ID"=>$arResult["PROPERTIES"]["CARE"]["VALUE"]),false,false,array("ID","NAME","PREVIEW_PICTURE","PREVIEW_TEXT"));
        while($arCareElement = $careElements->Fetch()) {
            $img = CFIle::ResizeImageGet($arCareElement["PREVIEW_PICTURE"],array("width"=>64,"height"=>64),BX_RESIZE_IMAGE_EXACT);
            $arCareElement["PICTURE"] = $img["src"];
            $arResult["FURNITURE_CARE"][] = $arCareElement;
        }
    }

    //собираем другие элементы данного раздела
    if(!$arResult["PROPERTIES"]["OTHER_PRODUCTS"]["VALUE"]){
        $otherItems_new = CIBLockElement::GetList(array("RAND"=>"ASC"),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"],"SECTION_ID"=>$arResult["IBLOCK_SECTION_ID"],"!ID"=>$arResult["ID"]),false,false,array("ID","NAME","DETAIL_PAGE_URL","DETAIL_PICTURE"));
        while($arItem = $otherItems_new->GetNext()) {
            $img = CFIle::ResizeImageGet($arItem["DETAIL_PICTURE"],array("width"=>446,"height"=>300),BX_RESIZE_IMAGE_EXACT);
            $arItem["PICTURE"] = $img["src"];
            $arResult["OTHER_PRODUCTS"][] = $arItem; 
        }
    }else{
        foreach($arResult["PROPERTIES"]["OTHER_PRODUCTS"]["VALUE"] as $item_id){  
            $otherItems = CIBLockElement::GetList(array("RAND"=>"ASC"),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"],"ID"=>$item_id),false,false,array("ID","NAME","DETAIL_PAGE_URL","DETAIL_PICTURE", "PICTURE"));
            while($arItem = $otherItems->GetNext()) {
                $img = CFIle::ResizeImageGet($arItem["DETAIL_PICTURE"],array("width"=>446,"height"=>300),BX_RESIZE_IMAGE_EXACT);
                $arItem["PICTURE"] = $img["src"];
                $arResult["OTHER_PRODUCTS"][] = $arItem; 
            }          
        } 
    }



    //заменяем основную картинку, доп картинки и картинки предложений
    //основная картинка
    $mainImg = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"],array("width"=>920,"height"=>620),BX_RESIZE_IMAGE_EXACT,true,$arWaterMark);
    $arResult["DETAIL_PICTURE"]["SRC"] = $mainImg["src"];
    //картинки предложений (основные и дополнительные)
    if (is_array($arResult["OFFERS"]) && count($arResult["OFFERS"]) > 0) {
        foreach ($arResult["OFFERS"] as $o=>$offer) {
            //основная картинка предложения
            $offerImg = CFile::ResizeImageGet($offer["DETAIL_PICTURE"]["ID"],array("width"=>920,"height"=>620),BX_RESIZE_IMAGE_EXACT,true,$arWaterMark);
            $arResult["OFFERS"][$o]["DETAIL_PICTURE"]["SRC"] = $offerImg["src"]; 
            //дополнительные
            if (is_array($offer["PROPERTIES"]["MORE_FOTO"]["VALUE"]) && count($offer["PROPERTIES"]["MORE_FOTO"]["VALUE"]) > 0) {
                foreach ($offer["PROPERTIES"]["MORE_FOTO"]["VALUE"] as $fID=>$foto) {
                    $imgAddFoto = CFile::ResizeImageGet($foto,array("width"=>920,"height"=>620),BX_RESIZE_IMAGE_EXACT,true,$arWaterMark);
                    $arResult["OFFERS"][$o]["PROPERTIES"]["MORE_FOTO"]["VALUE"][$fID] = $imgAddFoto["src"]; 
                    $arResult["OFFERS"][$o]["PROPERTIES"]["MORE_FOTO"]["ORIGINAL_VALUE"][$fID] = CFile::GetFileArray($foto);
                }   
            }
        }
    }

    //доп картинки для товара без предложений
    if (is_array($arResult["PROPERTIES"]["MORE_FOTO"]["VALUE"]) && count($arResult["PROPERTIES"]["MORE_FOTO"]["VALUE"]) > 0) {
        foreach ($arResult["PROPERTIES"]["MORE_FOTO"]["VALUE"] as $i=>$image) {
            $offerImg = CFile::ResizeImageGet($image,array("width"=>920,"height"=>620),BX_RESIZE_IMAGE_EXACT,true,$arWaterMark);
            $arResult["PROPERTIES"]["MORE_FOTO"]["VALUE"][$i] = $offerImg["src"]; 
            $arResult["PROPERTIES"]["MORE_FOTO"]["ORIGINAL_VALUE"][$i] = CFile::GetFileArray($image);
        }
    }       
    //материалы
    if (is_array($arResult["PROPERTIES"]["MATERIALS"]["VALUE"]) && count($arResult["PROPERTIES"]["MATERIALS"]["VALUE"]) > 0) {
        foreach ($arResult["PROPERTIES"]["MATERIALS"]["VALUE"] as $i=>$item) {
            $arResult["PROPERTIES"]["MATERIALS"]["DISPLAY_VALUE"][$i] = $arResult["MATERIALS"][$item]; 
        }
    }
    // фурнитура
    if (is_array($arResult["PROPERTIES"]["IMPLEMENT"]["VALUE"]) && count($arResult["PROPERTIES"]["IMPLEMENT"]["VALUE"]) > 0) {
        foreach ($arResult["PROPERTIES"]["IMPLEMENT"]["VALUE"] as $i=>$item) {
            $arResult["PROPERTIES"]["IMPLEMENT"]["DISPLAY_VALUE"][$i] = $arResult["FINDINGS"][$item]; 
        }
    }

    //Custom sorting
    function customSorting($key, $way) {
        return function ($a, $b) use ($key, $way) {
            if ($a[$key] == $b[$key]) {
                return 0;
            }
            if ($way=='desc') {
                return ($a[$key] > $b[$key]) ? -1 : 1;
            } else if ($way=='asc') {
                return ($a[$key] < $b[$key]) ? -1 : 1;
            }
        };
    }

    usort($arResult["OFFERS"], customSorting(strtoupper($arParams["OFFERS_SORT_FIELD"]), $arParams["OFFERS_SORT_ORDER"]));

    //проверяем наличие товара и ТП на складах
    $itemId = $arResult["ID"];

    //если у товара есть ТП? то проверяем их количество
    if (is_array($arResult["OFFERS"]) && count($arResult["OFFERS"]) > 0) {
        $itemId = array();
        foreach ($arResult["OFFERS"] as $offer) {
            $itemId[] = $offer["ID"]; 
        }
    }     

    //собираем склады, где товар в наличии
    $arStoresID = array();        
    $rsStore = CCatalogStoreProduct::GetList(array(), array("PRODUCT_ID" =>$itemId, ">AMOUNT"=>0), false, false, array("STORE_ID")); 
    while ($arStore = $rsStore->Fetch()) {
        $arStoresID[] = $arStore["STORE_ID"];
    }

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
    

?>