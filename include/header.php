

<div id="panel"><?$APPLICATION->ShowPanel();?></div>  
<?$APPLICATION->IncludeComponent("altasib:altasib.geoip","empty",array())?>
<!--[if lte IE 8]>
<div class="old-browser js-old">
Вы используете старый браузер. Сайт может отображаться некорректно
</div>
<![endif]-->
<div class="burger js-burger"><i></i></div>
<nav class="menu js-menu">
    <div class="menu__center">
        <div class="menu__inner __left">
            <div class="menu__column">

                <div href="#!" class="menu__item __main __head js-burger ">Стили мебели</div>      
                <?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "styles_main_menu", Array(
                        "COMPONENT_TEMPLATE" => ".default",
                        "IBLOCK_TYPE" => "catalog",    // Тип инфоблока
                        "IBLOCK_ID" => "6",    // Инфоблок
                        "SECTION_ID" => "",    // ID раздела
                        "SECTION_CODE" => "",    // Код раздела
                        "COUNT_ELEMENTS" => "N",    // Показывать количество элементов в разделе
                        "TOP_DEPTH" => "2",    // Максимальная отображаемая глубина разделов
                        "SECTION_FIELDS" => array(    // Поля разделов
                            0 => "DESCRIPTION",
                            1 => "PICTURE",
                            2 => "DETAIL_PICTURE",
                            3 => "",
                        ),
                        "SECTION_USER_FIELDS" => array(    // Свойства разделов
                            0 => "",
                            1 => "",
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
            </div>
            <div class="menu__column">
                <div href="#!" class="menu__item __main __head js-burger ">о бренде</div>
                <div class="menu__hidden js-hidden-column"> 

                    <?$APPLICATION->IncludeComponent("bitrix:menu", "top_submenu", Array(
                            "ROOT_MENU_TYPE" => "brand",    // Тип меню для первого уровня
                            "MENU_CACHE_TYPE" => "A",    // Тип кеширования
                            "MENU_CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                            "MENU_CACHE_USE_GROUPS" => "N",    // Учитывать права доступа
                            "MENU_THEME" => "site",    // Тема меню
                            "CACHE_SELECTED_ITEMS" => "N",
                            "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                            "MAX_LEVEL" => "3",    // Уровень вложенности меню
                            "CHILD_MENU_TYPE" => "left",    // Тип меню для остальных уровней
                            "USE_EXT" => "Y",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                            "DELAY" => "N",    // Откладывать выполнение шаблона меню
                            "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                            ),
                            false
                        );?>

                </div>
            </div>
        </div>
        <div class="menu__logo js-down" data-dest="top">
            <?if ($APPLICATION->GetCurDir() != "/"){?>
                <a href="/">
                    <?}?>
                <?$APPLICATION->IncludeFile(SITE_DIR."include/logo.php", Array(),Array("MODE"=>"html"));?>
                <?if ($APPLICATION->GetCurDir() != "/"){?>
                </a>
                <?}?>                 
        </div>   
        <div class="menu__inner __right">
            <div class="menu__column">
                <div href="#!" class="menu__item __main __head js-burger ">покупателю</div>
                <div class="menu__hidden js-hidden-column">  

                    <?$APPLICATION->IncludeComponent("bitrix:menu", "top_submenu", array(
                            "ROOT_MENU_TYPE" => "buyer",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_TIME" => "36000000",
                            "MENU_CACHE_USE_GROUPS" => "N",
                            "MENU_THEME" => "site",
                            "CACHE_SELECTED_ITEMS" => "N",
                            "MENU_CACHE_GET_VARS" => array(
                            ),
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "left",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N",
                            ),
                            false
                        );?>                                        

                </div>
            </div>
            <div class="menu__column">

                <div href="#!" class="menu__item __main __head js-burger ">где купить?</div>

                <div class="menu__hidden js-hidden-column"> 

                    <?$APPLICATION->IncludeComponent("bitrix:menu", "top_submenu", array(
                            "ROOT_MENU_TYPE" => "where-to-buy",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_TIME" => "36000000",
                            "MENU_CACHE_USE_GROUPS" => "N",
                            "MENU_THEME" => "site",
                            "CACHE_SELECTED_ITEMS" => "N",
                            "MENU_CACHE_GET_VARS" => array(
                            ),
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "left",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N",
                            ),
                            false
                        );?>


                    <div class="menu__item __main">партнёрство</div> 

                    <?$APPLICATION->IncludeComponent("bitrix:menu", "top_submenu", array(
                            "ROOT_MENU_TYPE" => "partnership",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_TIME" => "36000000",
                            "MENU_CACHE_USE_GROUPS" => "N",
                            "MENU_THEME" => "site",
                            "CACHE_SELECTED_ITEMS" => "N",
                            "MENU_CACHE_GET_VARS" => array(
                            ),
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "left",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N",
                            ),
                            false
                        );?>                                    

                </div>
            </div>
        </div>
    </div>
    <div class="menu-footer js-footer js-hidden-column">
        <div class="menu-footer__copyright">WELLIGE © <?=date("Y")?></div>                

        <?$APPLICATION->IncludeComponent("bitrix:menu", "top_menu_legal_info", Array(
                "ROOT_MENU_TYPE" => "legal-info",    // Тип меню для первого уровня
                "MENU_CACHE_TYPE" => "A",    // Тип кеширования
                "MENU_CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                "MENU_CACHE_USE_GROUPS" => "N",    // Учитывать права доступа
                "MENU_THEME" => "site",    // Тема меню
                "CACHE_SELECTED_ITEMS" => "N",
                "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                "MAX_LEVEL" => "3",    // Уровень вложенности меню
                "CHILD_MENU_TYPE" => "left",    // Тип меню для остальных уровней
                "USE_EXT" => "Y",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                "DELAY" => "N",    // Откладывать выполнение шаблона меню
                "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                ),
                false
            );?>     

        <div class="menu-footer__social">
            <a href="#!" class="footer__social-link __fb js-fb-link"></a>
            <a href="#!" class="footer__social-link __vk js-vk-link"></a>
        </div>
    </div>
    </nav>
