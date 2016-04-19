<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
    CJSCore::Init(array("fx"));
    $curPage = $APPLICATION->GetCurPage(true);
    $theme = COption::GetOptionString("main", "wizard_eshop_bootstrap_theme_id", "blue", SITE_ID);
?>
<!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>

    <?include($_SERVER["DOCUMENT_ROOT"]."/include/meta.php")?>

    <title><?$APPLICATION->ShowTitle()?></title>

</head>
<body>


<header class="header js-lock-scroll js-header header--small header--hidden header--transparent"> 
    <?include($_SERVER["DOCUMENT_ROOT"]."/include/header.php");?>
</header>

<div class="js-fullpage ">
<section class="js-slide slide slide--enter js-popup-parrent" data-anchor="top">

    <?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "styles_main_video", Array(
            "COMPONENT_TEMPLATE" => ".default",
            "IBLOCK_TYPE" => "catalog",    // Тип инфоблока
            "IBLOCK_ID" => "6",    // Инфоблок
            "SECTION_ID" => "",    // ID раздела
            "SECTION_CODE" => "",    // Код раздела
            "COUNT_ELEMENTS" => "N",    // Показывать количество элементов в разделе
            "TOP_DEPTH" => "1",    // Максимальная отображаемая глубина разделов
            "SECTION_FIELDS" => array(    // Поля разделов
                0 => "DESCRIPTION",
                1 => "PICTURE",
                2 => "DETAIL_PICTURE",
                3 => "",
            ),
            "SECTION_USER_FIELDS" => array(    // Свойства разделов
                0 => "UF_VIDEO_LINK",
                1 => "UF_VIDEO_LINK_COLOR",
                2 => "UF_VIDEO_PREVIEW",
                3 => "UF_VIDEO"
            ),
            "VIEW_MODE" => "LINE",    // Вид списка подразделов
            "SHOW_PARENT_NAME" => "Y",    // Показывать название раздела
            "SECTION_URL" => "/catalog/#SECTION_CODE_PATH#/",    // URL, ведущий на страницу с содержимым раздела
            "CACHE_TYPE" => "A",    // Тип кеширования
            "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
            "CACHE_GROUPS" => "N",    // Учитывать права доступа
            "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
            ),
            false
        );?>      



    <div class="slide__wrap">

        <div class="mainpage__videos slide__bg slide__bg--green js-anim-videos" data-bg='/img/bg-slide_main_1.jpg'>
            <video autoplay muted loop src="/video/film.mp4" class="mainpage__video js-anim-video" type="video/mp4"></video>
            <div class="film js-film" data-src="/video/film.mp4"></div>
        </div>

        <?$APPLICATION->IncludeFile(SITE_DIR."include/logo_hide.php", Array(),Array("MODE"=>"html"));?>            
        <h1 class="slide__title js-hide hide-scale">           
            <?$APPLICATION->IncludeFile(SITE_DIR."include/slogan.php", Array(),Array("MODE"=>"html"));?>
        </h1>
        <div class="btn btn--whitebg js-movie-popup-btn js-hide hide-bottom" data-dest="style">стили мебели</div>
        <div class="btn btn--whitebg js-hide js-movie-popup-btn js-movie-popup-btn--video hide-bottom" data-dest="style">смотреть видео</div>
        <div class="btn-arrow btn-arrow--down js-down hide-bottom" data-dest="principles"></div>
    </div>
</section>

<?$APPLICATION->IncludeComponent(
        "bitrix:news.list", 
        "principles", 
        array(
            "COMPONENT_TEMPLATE" => "principles",
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => "4",
            "NEWS_COUNT" => "99",
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => "NAME",
            "SORT_ORDER2" => "ASC",
            "FILTER_NAME" => "",
            "FIELD_CODE" => array(
                0 => "DETAIL_PICTURE",
                1 => "PREVIEW_PICTURE",
                2 => "PREVIEW_TEXT"
            ),
            "PROPERTY_CODE" => array(
                0 => "",
                1 => "",
            ),
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "N",
            "PREVIEW_TRUNCATE_LEN" => "",
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "SET_TITLE" => "N",
            "SET_BROWSER_TITLE" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_LAST_MODIFIED" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "INCLUDE_SUBSECTIONS" => "Y",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "PAGER_TEMPLATE" => ".default",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "PAGER_TITLE" => "Новости",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "SET_STATUS_404" => "N",
            "SHOW_404" => "N",
            "MESSAGE_404" => ""
        ),
        false
    );?>  

<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"styles_main", 
	array(
		"COMPONENT_TEMPLATE" => "styles_main",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "6",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS" => "N",
		"TOP_DEPTH" => "1",
		"SECTION_FIELDS" => array(
			0 => "DESCRIPTION",
			1 => "PICTURE",
			2 => "DETAIL_PICTURE",
			3 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "UF_STYLE_VIDEO",
			1 => "",
			2 => "",
		),
		"VIEW_MODE" => "LINE",
		"SHOW_PARENT_NAME" => "Y",
		"SECTION_URL" => "/catalog/#SECTION_CODE_PATH#/",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "N",
		"ADD_SECTIONS_CHAIN" => "N"
	),
	false
);?>      

<section class="js-slide slide slide--media js-bright-bg" data-anim="scale" data-anchor="media" data-color="white">
    <div class="slide__wrap">
        <div class="wrapper">

            <?$APPLICATION->IncludeComponent(
                    "bitrix:news.list", 
                    "index_articles", 
                    array(
                        "COMPONENT_TEMPLATE" => "index_articles",
                        "IBLOCK_TYPE" => "content",
                        "IBLOCK_ID" => "5",
                        "NEWS_COUNT" => "4",
                        "SORT_BY1" => "PROPERTY_MAIN_ARTICLE",
                        "SORT_ORDER1" => "DESC",
                        "SORT_BY2" => "ID",
                        "SORT_ORDER2" => "DESC",
                        "FILTER_NAME" => "",
                        "FIELD_CODE" => array(
                            0 => "DETAIL_PICTURE",
                            1 => "PREVIEW_PICTURE",
                            2 => "PREVIEW_TEXT"
                        ),
                        "PROPERTY_CODE" => array(
                            0 => "LINK",
                            1 => "MAIN_ARTICLE",
                            2 => "BUTTON_TITLE" ,
                            3 => "CATEGORY",
                        ),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "N",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "SET_TITLE" => "N",
                        "SET_BROWSER_TITLE" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "PAGER_TEMPLATE" => ".default",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "PAGER_TITLE" => "Новости",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "SET_STATUS_404" => "N",
                        "SHOW_404" => "N",
                        "MESSAGE_404" => ""
                    ),
                    false
                );?>               

        </div>
    </div>
</section>
