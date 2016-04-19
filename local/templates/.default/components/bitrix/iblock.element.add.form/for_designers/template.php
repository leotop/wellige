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

<section class="request request--foredesigners">
    <div class="wrapper">
        <h2 class="request__title">оставить заявку</h2>
        <div class="request__form">
            <form class="js-submit-form" method="GET" action="<?=$templateFolder."/ajax/action.php"?>">
                <div class="request__field input-field">
                    <label for="name">Ваше имя</label>
                    <input type="text" id="NAME" name="NAME" autocomplete="off"> 
                </div>

                <div class="request__field input-field">
                    <label for="mail">Электронная почта (для ответа)</label>
                    <input type="email" id="EMAIL" name="EMAIL" autocomplete="off"> 
                </div>

                <div class="request__field input-field">
                    <label for="company">Название студии/компании</label>
                    <input type="text" id="COMPANY" name="COMPANY" autocomplete="off">
                </div>

                <div class="request__field input-field">
                    <label for="phone">Номер телефона</label>
                    <input type="tel" id="PHONE" name="PHONE" autocomplete="off"> 
                </div>

                <div class="request__field input-field __textarea">
                    <label for="message">Комментарий к заявке (необязательно)</label>
                    <textarea id="MESSAGE" name="MESSAGE" autocomplete="off"></textarea>
                </div>

                <!--form type ID-->
                <input type="hidden" id="TYPE" name="TYPE" value="30">
                <!--//form type ID-->                      

                <button class="btn btn--greenbg" type="submit" name="button">отправить</button>

                <div class="submit-message js-success-message">
                    <div class="submit-message__inner">
                        <div class="submit-message__title">Успешно</div>
                        <div class="submit-message__text">Ваше сообщение получено! Спасибо за обращение. В ближайшее время мы изучим его и ответим на указанную электронную почту. 
                            Если по каким-то причинам вы не получили ответ, позвоните нам по телефону: <?include($_SERVER["DOCUMENT_ROOT"]."/include/phones/main_phone.php")?>.
                        </div>
                        <div class="btn btn--greenbg js-close-message">Отправить еще</div>
                    </div>
                </div>

                <div class="submit-message js-error-message">
                    <div class="submit-message__inner">
                        <div class="submit-message__title">Ошибка</div>
                        <div class="submit-message__text">К сожалению, при отправке запроса произошла ошибка. Вы можете попробовать отправить Ваше сообщение снова позднее.</div>
                        <div class="btn btn--greenbg js-close-message">попробовать снова</div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</section>