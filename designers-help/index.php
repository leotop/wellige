<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Помощь дизайнера");
?><?$APPLICATION->IncludeComponent(
        "bitrix:news.list", 
        "designer_help", 
        array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "N",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "COMPONENT_TEMPLATE" => "designer_help",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "13",
            "IBLOCK_TYPE" => "-",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "Y",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "20",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array(
                0 => "",
                1 => "",
            ),
            "SET_BROWSER_TITLE" => "Y",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "Y",
            "SET_META_KEYWORDS" => "Y",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "Y",
            "SHOW_404" => "N",
            "SORT_BY1" => "ID",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_ORDER2" => "ASC"
        ),
        false
    );?>
<?$APPLICATION->IncludeComponent("bitrix:iblock.element.add.form", "for_dealers", Array(
    "COMPONENT_TEMPLATE" => "contacts",
    "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",    // * дата начала *
    "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",    // * дата завершения *
    "CUSTOM_TITLE_DETAIL_PICTURE" => "",    // * подробная картинка *
    "CUSTOM_TITLE_DETAIL_TEXT" => "",    // * подробный текст *
    "CUSTOM_TITLE_IBLOCK_SECTION" => "",    // * раздел инфоблока *
    "CUSTOM_TITLE_NAME" => "Ваше имя",    // * наименование *
    "CUSTOM_TITLE_PREVIEW_PICTURE" => "",    // * картинка анонса *
    "CUSTOM_TITLE_PREVIEW_TEXT" => "Сообщение",    // * текст анонса *
    "CUSTOM_TITLE_TAGS" => "",    // * теги *
    "DEFAULT_INPUT_SIZE" => "30",    // Размер полей ввода
    "DETAIL_TEXT_USE_HTML_EDITOR" => "N",    // Использовать визуальный редактор для редактирования подробного текста
    "ELEMENT_ASSOC" => "CREATED_BY",    // Привязка к пользователю
    "GROUPS" => array(    // Группы пользователей, имеющие право на добавление/редактирование
        0 => "2",
    ),
    "IBLOCK_ID" => "11",    // Инфоблок
    "IBLOCK_TYPE" => "services",    // Тип инфоблока
    "LEVEL_LAST" => "Y",    // Разрешить добавление только на последний уровень рубрикатора
    "LIST_URL" => "",    // Страница со списком своих элементов
    "MAX_FILE_SIZE" => "0",    // Максимальный размер загружаемых файлов, байт (0 - не ограничивать)
    "MAX_LEVELS" => "100000",    // Ограничить кол-во рубрик, в которые можно добавлять элемент
    "MAX_USER_ENTRIES" => "100000",    // Ограничить кол-во элементов для одного пользователя
    "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",    // Использовать визуальный редактор для редактирования текста анонса
    "PROPERTY_CODES" => array(    // Свойства, выводимые на редактирование
        0 => "52",
        1 => "53",
        2 => "NAME",
        3 => "PREVIEW_TEXT",
    ),
    "PROPERTY_CODES_REQUIRED" => array(    // Свойства, обязательные для заполнения
        0 => "52",
        1 => "53",
        2 => "NAME",
        3 => "PREVIEW_TEXT",
    ),
    "RESIZE_IMAGES" => "N",    // Использовать настройки инфоблока для обработки изображений
    "SEF_MODE" => "N",    // Включить поддержку ЧПУ
    "STATUS" => "ANY",    // Редактирование возможно
    "STATUS_NEW" => "NEW",    // Деактивировать элемент
    "USER_MESSAGE_ADD" => "",    // Сообщение об успешном добавлении
    "USER_MESSAGE_EDIT" => "",    // Сообщение об успешном сохранении
    "USE_CAPTCHA" => "N",    // Использовать CAPTCHA
    ),
    false
    );?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>