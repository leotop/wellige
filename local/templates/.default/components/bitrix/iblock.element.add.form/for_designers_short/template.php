<?
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
    $this->setFrameMode(false);

    if (!empty($arResult["ERRORS"])):?>
    <?ShowError(implode("<br />", $arResult["ERRORS"]))?>
    <?endif;
    if (strlen($arResult["MESSAGE"]) > 0):?>
    <?ShowNote($arResult["MESSAGE"])?>
    <?endif?>

<div class="fordesigners-label">
    <div class="wrapper">
        <div class="media-label media-label--subscription">
            <div class="media-label__text">Запросить подробности о сотрудничестве</div>
            <form method="GET" action="<?=$templateFolder."/ajax/action.php"?>" class="subscription__form js-email-submit">
                <div class="input-field">
                <input type="email" id="EMAIL" name="EMAIL" placeholder="Введите вашу эл. почту" class="subscription__input" autocomplete="off"> </div>
                <button class="subscription__btn btn btn--greenbg">запросить</button>
                
                <div class="submit-message submit-message--mini js-success-message">
                    <div class="submit-message__title">Успешно</div>
                    <div class="submit-message__text">Ваше сообщение успешно отправлено. Мы свяжемся с вами сразу, как только придумаем, что еще написать вместо этого текста.</div>
                    <div class="btn btn--greenbg js-close-message">Отправить еще</div>
                </div>
                
                <div class="submit-message submit-message--mini js-error-message">
                    <div class="submit-message__title">Ошибка</div>
                    <div class="submit-message__text">К сожалению, при отправке запроса произошла ошибка. Вы можете попробовать отправить Ваше сообщение снова позднее.</div>
                    <div class="btn btn--greenbg js-close-message">попробовать снова</div>
                </div>
                
                <!--form type ID-->
                <input type="hidden" id="TYPE" name="TYPE" value="30">
                <!--//form type ID-->
            </form>
        </div>
    </div>
</div>



