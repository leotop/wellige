<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Дизайнерам о партнерстве");
?><?$APPLICATION->IncludeComponent(
        "bitrix:news.list", 
        "for_designers", 
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
            "COMPONENT_TEMPLATE" => "for_designers",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "N",
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
            "IBLOCK_ID" => "22",
            "IBLOCK_TYPE" => "content",
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
                1 => "IMAGE",
                2 => "",
            ),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "ID",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_ORDER2" => "ASC"
        ),
        false
    );?>
<?$APPLICATION->IncludeComponent("bitrix:iblock.element.add.form", "for_designers_short", Array(
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
<?$APPLICATION->IncludeComponent("bitrix:news.list", "partners", Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
        "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
        "AJAX_MODE" => "N",	// Включить режим AJAX
        "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
        "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
        "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
        "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
        "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
        "CACHE_GROUPS" => "N",	// Учитывать права доступа
        "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
        "CACHE_TYPE" => "A",	// Тип кеширования
        "CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
        "COMPONENT_TEMPLATE" => "for_designers",
        "DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
        "DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
        "DISPLAY_DATE" => "Y",	// Выводить дату элемента
        "DISPLAY_NAME" => "Y",	// Выводить название элемента
        "DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
        "DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
        "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
        "FIELD_CODE" => array(	// Поля
            0 => "DETAIL_PICTURE",
            1 => "",
        ),
        "FILTER_NAME" => "",	// Фильтр
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
        "IBLOCK_ID" => "23",	// Код информационного блока
        "IBLOCK_TYPE" => "content",	// Тип информационного блока (используется только для проверки)
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
        "INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
        "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
        "NEWS_COUNT" => "20",	// Количество новостей на странице
        "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
        "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
        "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
        "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
        "PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
        "PAGER_TITLE" => "Новости",	// Название категорий
        "PARENT_SECTION" => "",	// ID раздела
        "PARENT_SECTION_CODE" => "",	// Код раздела
        "PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
        "PROPERTY_CODE" => array(	// Свойства
            0 => "LINK",
        ),
        "SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
        "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
        "SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
        "SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
        "SET_STATUS_404" => "N",	// Устанавливать статус 404
        "SET_TITLE" => "N",	// Устанавливать заголовок страницы
        "SHOW_404" => "N",	// Показ специальной страницы
        "SORT_BY1" => "ID",	// Поле для первой сортировки новостей
        "SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
        "SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
        "SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
        ),
        false
    );?>
<?$APPLICATION->IncludeComponent("bitrix:iblock.element.add.form", "for_designers", Array(
        "COMPONENT_TEMPLATE" => "contacts",
        "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",	// * дата начала *
        "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",	// * дата завершения *
        "CUSTOM_TITLE_DETAIL_PICTURE" => "",	// * подробная картинка *
        "CUSTOM_TITLE_DETAIL_TEXT" => "",	// * подробный текст *
        "CUSTOM_TITLE_IBLOCK_SECTION" => "",	// * раздел инфоблока *
        "CUSTOM_TITLE_NAME" => "Ваше имя",	// * наименование *
        "CUSTOM_TITLE_PREVIEW_PICTURE" => "",	// * картинка анонса *
        "CUSTOM_TITLE_PREVIEW_TEXT" => "Сообщение",	// * текст анонса *
        "CUSTOM_TITLE_TAGS" => "",	// * теги *
        "DEFAULT_INPUT_SIZE" => "30",	// Размер полей ввода
        "DETAIL_TEXT_USE_HTML_EDITOR" => "N",	// Использовать визуальный редактор для редактирования подробного текста
        "ELEMENT_ASSOC" => "CREATED_BY",	// Привязка к пользователю
        "GROUPS" => array(	// Группы пользователей, имеющие право на добавление/редактирование
            0 => "2",
        ),
        "IBLOCK_ID" => "11",	// Инфоблок
        "IBLOCK_TYPE" => "services",	// Тип инфоблока
        "LEVEL_LAST" => "Y",	// Разрешить добавление только на последний уровень рубрикатора
        "LIST_URL" => "",	// Страница со списком своих элементов
        "MAX_FILE_SIZE" => "0",	// Максимальный размер загружаемых файлов, байт (0 - не ограничивать)
        "MAX_LEVELS" => "100000",	// Ограничить кол-во рубрик, в которые можно добавлять элемент
        "MAX_USER_ENTRIES" => "100000",	// Ограничить кол-во элементов для одного пользователя
        "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",	// Использовать визуальный редактор для редактирования текста анонса
        "PROPERTY_CODES" => array(	// Свойства, выводимые на редактирование
            0 => "52",
            1 => "53",
            2 => "NAME",
            3 => "PREVIEW_TEXT",
        ),
        "PROPERTY_CODES_REQUIRED" => array(	// Свойства, обязательные для заполнения
            0 => "52",
            1 => "53",
            2 => "NAME",
            3 => "PREVIEW_TEXT",
        ),
        "RESIZE_IMAGES" => "N",	// Использовать настройки инфоблока для обработки изображений
        "SEF_MODE" => "N",	// Включить поддержку ЧПУ
        "STATUS" => "ANY",	// Редактирование возможно
        "STATUS_NEW" => "NEW",	// Деактивировать элемент
        "USER_MESSAGE_ADD" => "",	// Сообщение об успешном добавлении
        "USER_MESSAGE_EDIT" => "",	// Сообщение об успешном сохранении
        "USE_CAPTCHA" => "N",	// Использовать CAPTCHA
        ),
        false
    );?>
<?$APPLICATION->IncludeComponent(
    "bitrix:news.list", 
    "for_designers_media", 
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
        "COMPONENT_TEMPLATE" => "for_designers_media",
        "DETAIL_URL" => "/media/#ELEMENT_ID#/",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(
            0 => "DETAIL_PICTURE",
            1 => "",
        ),
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "5",
        "IBLOCK_TYPE" => "content",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "Y",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "4",
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
            0 => "LINK",
            1 => "MAIN_ARTICLE",
            2 => "BUTTON_TITLE" ,
            3 => "CATEGORY",
        ),
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SORT_BY1" => "PROPERTY_MAIN_ARTICLE",
        "SORT_BY2" => "ID",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC"
    ),
    false
    );?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>