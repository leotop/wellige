<section class="designer-help">
    <div class="wrapper">
        <div class="designer-help__icon"></div>
        <div class="designer-help__info"> Не можете определиться какая мебель подойдет?
        <br> Нужна помощь дизайнера? </div> <a class="designer-help__btn btn btn--greenbg" href="/designers-help/">получить помощь</a> </div>
</section>

<?if (is_array($arResult["OTHER_SECTIONS"]) && count($arResult["OTHER_SECTIONS"]) > 0) {?>
    <section class="slide-carousel">
        <div class="wrapper">
            <h4 class="slide-carousel__title">другие коллекции</h4>   
        </div>                             
        <div class="slide-carousel__wrap js-slider "> 

            <?foreach ($arResult["OTHER_SECTIONS"] as $otherSection) {?>
                <?$img = CFIle::GetPath($otherSection["PICTURE"]);?>     
                <div class="slide-carousel__item " style="background-image: url('<?=$img?>')">
                    <div class="slide-carousel__wrapper ">                        
                        <div class="slide-carousel__inner ">
                            <div class="slide-carousel__prename">Коллекция</div>
                            <div class="slide-carousel__name"><?=$otherSection["NAME"]?></div>
                            <div class="slide-carousel__text"><?=$otherSection["DESCRIPTION"]?></div>
                            <a class="" href="<?=$otherSection["SECTION_PAGE_URL"]?>"><div class="slide-carousel__btn btn btn--white">посмотреть коллекцию</div></a>
                        </div>
                        <div class="slide__bg--dark"></div>
                    </div>
                </div>
                <?}?>

        </div>
        <div class=""></div>
    </section>
    <?}?>
    
    <div class="ajax-layout js-ajax-layout" style="display: none;"></div>