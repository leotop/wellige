<?
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<?//=$arResult["FORM_NOTE"]?>

<div class="media-label media-label--subscription">
    <?if ($arResult["isFormNote"] != "Y") {?> 

        <?if ($arResult["isFormErrors"] == "Y"){?>

            <div class=" submit-message--mini js-error-message">
                <div class="submit-message__title">Ошибка</div>
                <div class="submit-message__text"><?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>К сожалению, при отправке запроса произошла ошибка. Вы можете попробовать отправить Ваше сообщение снова позднее.</div>
                <div class="btn btn--greenbg js-close-message js-try-again">попробовать снова</div>
            </div>
            <?} else {?>

            <div class="media-label__text">Хотите узнавать первым о новинках Wellige и о тенденциях в мире мебели?</div>

            <?=$arResult["FORM_HEADER"]?>    
            <div class="input-field">  

                <?
                    foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
                        if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') {
                            echo $arQuestion["HTML_CODE"];
                        } else {
                        ?>     
                        <?=$arQuestion["HTML_CODE"]?>
                        <?
                        }
                    } 
                ?> 
            </div>        
            
            <input style="display: none" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
            
            <input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="button" class="subscription__btn btn btn--greenbg" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
                                                                                        
            <?=$arResult["FORM_FOOTER"]?>
            <?
            }
        } else {//endif (isFormNote)?>
        <div class="submit-message--mini js-success-message">
            <div class="submit-message__title">Успешно</div>
            <div class="submit-message__text">На указанный email выслано письмо для подтверждения подписки</div>
        </div>   
        <?}?>

</div>

<?/*
    <div class="media-label media-label--subscription">
    <div class="media-label__text">Хотите узнавать первым о новинках Wellige и о тенденциях в мире мебели?</div>
    <form method="GET" action="/html/_html/_data/_success.json" class="subscription__form js-email-submit">
    <div class="input-field">
    <input type="email" id="mail" name="mail" placeholder="Введите вашу эл. почту" class="subscription__input"> 
    </div>
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
    </form>
    </div>  */
