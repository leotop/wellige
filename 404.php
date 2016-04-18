<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");?>

<section class="not-found">
            <div class="not-found__image" style="margin-top: 50px;"> <img src="/img/not-found.png" alt=""> </div>
            <div class="not-found__inner">
                <div class="not-found__text" style="margin-top: 90px;">Возможно вы неверно набрали адрес или запрошенной страницы больше не существует.</div>
            </div>
        </section>
   
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>