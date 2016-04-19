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

<header class="header js-lock-scroll js-header header--fixed js-fixed-head"> 
    <?include($_SERVER["DOCUMENT_ROOT"]."/include/header.php");?>
</header>

<div class="page">  

<div class="wrapper">
    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "nav-chain", array(
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => "-"
            ),
            false,
            Array('HIDE_ICONS' => 'Y')
        );?>   
    <h1><?=$APPLICATION->ShowTitle();?></h1> 
</div> 

<section class="contacts">
    <div class="wrapper">
        <div class="contacts__list">
            <div class="contacts__wrap">
                <div class="contacts__list-item">
                    <div class="contacts__phone-title">Прием заказов и консультирование</div>
                    <h2 class="contacts__phone contacts__phone--big"><?$APPLICATION->IncludeFile(SITE_DIR."include/phones/main_phone.php", Array(),Array("MODE"=>"html"));?></h2>
                    <div class="contacts__phone-title">Звоните ежедневно с 9 утра до 9 вечера</div>
                </div>
                <div class="contacts__list-item">
                    <div class="contacts__phone-title">Бесплатный звонок по России</div>
                <h3 class="contacts__phone"><?$APPLICATION->IncludeFile(SITE_DIR."include/phones/russian_phone.php", Array(),Array("MODE"=>"html"));?></h3> </div>
            </div>
            <div class="contacts__list-item">
                <div class="contacts__phone-title">Партнёрство</div>
                <h3 class="contacts__phone"><?$APPLICATION->IncludeFile(SITE_DIR."include/phones/partnership_phone.php", Array(),Array("MODE"=>"html"));?></h3>
                <div class="contacts__phone-title">По вопросам рекламы</div>
                <h3 class="contacts__phone"><?$APPLICATION->IncludeFile(SITE_DIR."include/phones/partnership_phone.php", Array(),Array("MODE"=>"html"));?></h3>
                <div class="contacts__phone-title">Ассортимент и работы ТЦ</div>
            <h3 class="contacts__phone"><?$APPLICATION->IncludeFile(SITE_DIR."include/phones/info_phone.php", Array(),Array("MODE"=>"html"));?></h3> 
            </div>
        </div>
    </div>
</section>  





          
