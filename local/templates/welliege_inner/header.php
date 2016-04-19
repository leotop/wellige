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

<div class="page page--white">  

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





          
