<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
    $this->setFrameMode(true);
?>   
<?if ($arResult["DEPTH_LEVEL"] != 1) {?>

    <script type='text/javascript'>
        <?//Need for off on all catalog pages except style sections  ?>
        $(".js-fullpage").removeAttr("class").addClass("page");
        <?//Need for off on all catalog pages except style sections  ?>
        $("header").removeClass("header--transparent");
    </script>
    <div class="wrapper">
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "nav-chain", array(
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "-"
                ),
                false,
                Array('HIDE_ICONS' => 'Y')
            );?>   
        <h1>
            <?=$APPLICATION->ShowTitle();?>
            <?if (!$_REQUEST["search"] && $arResult["DEPTH_LEVEL"] == 2 ){?>
                
                <span class="collection-filter__close js-filter-toggle js-filter-toggle-close" style="display: none;">скрыть</span>
                <span class="collection-filter__open js-filter-toggle js-filter-toggle-open">выбрать категорию</span>  
                <?} else if (!$_REQUEST["search"] && $arResult["DEPTH_LEVEL"] == 3 ) {?>
                <a href="#"><span class="collection-filter__close js-filter-toggle js-filter-toggle-close" style="display: none;">скрыть</span></a>
                <span class="collection-filter__open js-filter-toggle js-filter-toggle-open"><?=$arResult["NAME"]?> Х</span>
                <?}?>
        </h1>
        <?//room page
            if ($arResult["DEPTH_LEVEL"] == 4 && $arResult["SECTIONS"][4][$arResult["ID"]]["UF_ART_NUMBER"]){?> 
            <div class="library-articul">Артикул: <?=$arResult["SECTIONS"][4][$arResult["ID"]]["UF_ART_NUMBER"]?></div>
            <?}?>
    </div>
    <?}?>

<?       
    //search results
    if ($_REQUEST["search"]) 
    {?>
    <section class="collection">

        <?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/search_form.php")?>  

        <div class="wrapper js-items-top items-addit">  

            <div class="collection-inner js-collection-cat-filter js-collection-cat-filter-item">
                <?if (count($arResult["SEARCH_RESULT"]["ITEMS"]) > 0 || count($arResult["SEARCH_RESULT"]["SECTIONS"]) > 0)  {?>

                    <?//результаты поиска (разделы)
                        foreach ($arResult["SEARCH_RESULT"]["SECTIONS"] as $section){?> 
                        <a href="<?=$section["SECTION_PAGE_URL"]?>">
                            <div class="collection-item "> 
                                <?$img = CFIle::ResizeImageGet($section["PICTURE"],array("width"=>685,"height"=>400),BX_RESIZE_IMAGE_EXACT);
                                    $imgInfo = CFile::GetFileArray($section["PICTURE"]);
                                    if ($img["src"]) {?>
                                    <img src="<?=$img["src"]?>" alt="<?=$imgInfo["DESCRIPTION"]?>" /> 
                                    <?}?>
                                <span class="item-name"><?=$section["NAME"]?></span> 
                            </div>
                        </a>
                        <?}?>

                    <?//результаты поиска (товары)
                        foreach ($arResult["SEARCH_RESULT"]["ITEMS"] as $item){?>
                        <a href="<?=$item["DETAIL_PAGE_URL"]?>"> 
                            <div class="collection-item "> 
                                <?$img = CFIle::ResizeImageGet($item["DETAIL_PICTURE"],array("width"=>685,"height"=>400),BX_RESIZE_IMAGE_EXACT);
                                    if ($img["src"]) {?>
                                    <img src="<?=$img["src"]?>" alt="<?=$item["DETAIL_PICTURE"]["DESCRIPTION"]?>" /> 
                                    <?}?>
                                <span class="item-name"><?=$item["NAME"]?></span> 
                            </div>
                        </a>
                        <?}?>  

                    <?} else {?>
                    <div>
                        <p>По вашему зарпосу "<?=trim($_REQUEST["search"])?>" ничего не найдено<br></p>
                    </div>                     
                    <?}?>
                <div class="clear">  
                    <a href="<?=$APPLICATION->GetCurDir()?>">назад</a>
                </div>   

            </div>
            <div class="collection-inner js-collection-items"></div>
        </div>
    </section>
    <?}

    else {

        //types of section pages
        switch ($arResult["DEPTH_LEVEL"]) {
            //style page
            case 1: 
            ?> 
            <section class="js-slide slide slide--style  js-popup-parrent" data-anchor="styletop">

                <div class="slide__wrap">

                    <?$bg = $arResult["PICTURE"]["SRC"]?>
                    <div class="mainpage__videos slide__bg slide__bg--dark js-anim-videos" data-bg='<?=$bg?>'>   
                        <?if ($arResult["SECTION_INFO"]["UF_STYLE_VIDEO"]) {
                                $videoPath = CFile::GetPath($arResult["SECTION_INFO"]["UF_STYLE_VIDEO"]);
                            ?>
                            <video autoplay muted loop src="<?=$videoPath?>" class="mainpage__video js-anim-video" type="video/mp4"></video>
                            <div class="film js-film" data-src="<?=$videoPath?>"></div>
                            <?}?>  
                    </div>                                                                                        
                    <h1 class="slide__title js-hide hide-top"><?=$arResult["NAME"]?></h1>
                    <div class="slide__text js-hide hide-top"><?=$arResult["DESCRIPTION"]?></div>
                    <?if ($arResult["SECTION_INFO"]["UF_STYLE_VIDEO"]) {?>
                        <div class="popup-open js-movie-popup-btn js-movie-popup-btn--video js-hide hide-bottom">смотреть фильм</div>
                        <?}?>
                    <div class="btn btn--white js-down js-hide hide-bottom" data-dest="<?=$arResult["CODE"]?>">Коллекции мебели</div>
                </div>
            </section>    

            <?
                $c = 0;

                foreach ($arResult["SECTION_STRUCTURE"]["COLLECTIONS"] as $collection) {?>               

                <section class="js-slide slide " data-anchor="<?if ($c==0){echo $arResult["CODE"];} else {echo $collection["CODE"];}?>" data-type="sliderArrow" data-family="collection" data-name="<?=$collection["NAME"]?>">
                    <div class="slide__wrap style">

                        <?
                            $collectionImage = CFile::GetPath($collection["PICTURE"]);
                            $collectionImageMobile = CFile::GetPath($collection["DETAIL_PICTURE"]);

                        ?>
                        <div class="slide__bg slide__bg--dark __active" data-mobile-bg='<?=$collectionImageMobile?>' style="background-image: url('<?=$collectionImage?>')"></div>                       

                        <?
                            $roomCounter = 0;

                            foreach ($collection["ROOMS"] as $roomType) {
                                if (is_array($roomType["ITEMS"]) && count ($roomType["ITEMS"] > 0))  {
                                    foreach ($roomType["ITEMS"] as $item) {
                                        //выводим в общей сложности не более 10 комнат
                                        if ($roomCounter > 10) {break;}
                                        $image = CFile::GetPath($item["PICTURE"]);
                                        $smallImg = CFile::GetPath($roomType["DETAIL_PICTURE"]);
                                    ?>
                                    <div class="slide__bg slide__bg--dark __active" data-mobile-bg='<?=$smallImg?>' style="background-image: url('<?=$image?>')"></div>
                                    <?$roomCounter++;}?>
                                <?}?>
                            <?}?>

                        <div class="slide__bg slide__bg--dark __active" style="background-image: url('<?=$collectionImage?>')"></div>

                        <div class="js-slider-item">
                            <div class="style wrapper">
                                <div class="style__wrap">
                                    <div class="style__prename">Коллекция</div>
                                    <div class="style__name"><?=$collection["NAME"]?></div>
                                    <div class="style__text"><?=$collection["DESCRIPTION"]?></div>
                                    <a href="<?=$collection["SECTION_PAGE_URL"]?>"><div class="style__btn btn btn--white">посмотреть коллекцию</div></a>
                                </div>
                            </div>
                        </div>

                        <?
                            $roomCounter = 0;

                            foreach ($collection["ROOMS"] as $roomType) {
                                if (is_array($roomType["ITEMS"]) && count ($roomType["ITEMS"] > 0))  {
                                    foreach ($roomType["ITEMS"] as $item) {
                                        //выводим в общей сложности не более 10 комнат
                                        if ($roomCounter > 10) {break;}
                                    ?>
                                    <div class="js-slider-item">
                                        <div class="style wrapper">
                                            <div class="style__wrap">
                                                <div class="style__prename">Коллекция «<?=$collection["NAME"]?>»</div>
                                                <div class="style__name"><?=$item["NAME"]?></div>
                                                <div class="style__text"><?=$item["DESCRIPTION"]?></div>
                                                <a href="<?=$item["SECTION_PAGE_URL"]?>"><div class="style__btn btn btn--white">посмотреть комнату</div></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?$roomCounter++;}?>
                                <?}?>
                            <?}?>



                        <div class="js-slider-item">
                            <div class="style style__grid wrapper">

                                <?
                                    $r = 1;
                                    $roomsCount = count($collection["ROOMS"]);

                                    foreach ($collection["ROOMS"] as $room) {
                                        //если больше 7 блоков - прекращаем вывод
                                        if ($r > 7) {break;}
                                        $img = CFIle::ResizeImageGet($room["PICTURE"],array("width"=>446,"height"=>292),BX_RESIZE_IMAGE_EXACT);
                                        $imgInfo = CFile::GetFileArray($room["PICTURE"]);
                                    ?> 

                                    <?//блок со ссылкой на коллекцию располагается в разных местах в зависимости от количества комнат
                                        if (($roomsCount == 2 && $r == 1) 
                                            || ($roomsCount == 3 && $r == 2)                                            
                                            || (($roomsCount == 4 || $roomsCount == 5) && $r == 3) 
                                            || ($roomsCount == 6 && $r == 4)) {
                                        ?>          

                                        <div class="style__grid-item style__grid-item--main">
                                            <div class="style__name"><?=$collection["NAME"]?></div>                                            
                                            <div class="style__text"><?=$collection["UF_SHORT_DESCRIPTION"]?></div>
                                            <a href="<?=$collection["SECTION_PAGE_URL"]?>">
                                                <div class="style__btn btn btn--white">посмотреть в магазине</div>
                                            </a>
                                        </div>

                                        <?if ($roomsCount == 2 && $r == 1){?>
                                            <?if ( $roomsCount%2 == 0) {?>
                                                <div class="style__grid-item style__grid-item--main"> </div>
                                                <?}?>
                                            <?}?> 
                                        <?}?>   

                                    <a href="<?=$room["SECTION_PAGE_URL"]?>" class="style__grid-item">
                                        <div class="style__collection-image"> 
                                            <?if ($img["src"]){?>
                                                <img src="<?=$img["src"]?>" alt="<?=$imgInfo["DESCRIPTION"]?>">
                                                <?}?>
                                            <div class="style__collection-text"><?=$room["NAME"]?></div>
                                        </div>
                                    </a>  


                                    <?if (($roomsCount == 1 && $r == 1)) {?>
                                        <div class="style__grid-item style__grid-item--main">
                                            <div class="style__name"><?=$collection["NAME"]?></div>                                            
                                            <div class="style__text"><?=$collection["UF_SHORT_DESCRIPTION"]?></div>
                                            <a href="<?=$collection["SECTION_PAGE_URL"]?>">
                                                <div class="style__btn btn btn--white">посмотреть в магазине</div>
                                            </a>
                                        </div>
                                        <?}?>


                                    <?$r++;}?>  

                                <?if ( $roomsCount % 2 == 0 && $roomsCount != 2) {?>
                                    <div class="style__grid-item style__grid-item--main"> </div>
                                    <?}?>
                            </div>
                        </div>    

                    </div>
                </section>
                <?$c++;}?>


            <?break;     

                //collection
            case 2:
            ?>

            <section class="collection">

                <?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/search_form.php")?>

                <div class="collection-filter js-collection-filter" data-action="<?=$templateFolder?>/ajax.php" style="display: none;">
                    <div class="wrapper">
                        <div class="js-collection-main-filter">

                            <div class="collection-filter__title"> комнаты в коллекции 
                                <a href="#all-rooms" id="all-rooms">
                                    <span class="collection-filter__all js-all" data-type="rooms">показать все комнаты</span>
                                </a> 
                            </div>

                            <div class="collection-filter__inner">
                                <?foreach ($arResult["ROOM_TYPES"] as $i=>$roomType) {
                                    //выводим 4 первые типа
                                    if ($roomType["ROOMS"] > 0 && $i <=3) {
                                        $img = CFIle::ResizeImageGet($roomType["PICTURE"],array("width"=>326,"height"=>190),BX_RESIZE_IMAGE_EXACT);
                                        $imgInfo = CFIle::GetFileArray($roomType["PICTURE"]);
                                    ?>
                                    <a href="#r-<?=$roomType["ID"]?>" id="r-<?=$roomType["ID"]?>">
                                        <div class="collection-filter__room-item js-filter-item" data-filter-type="main" data-filter="r-<?=$roomType["ID"]?>" data-section="<?=$arResult["ID"]?>" data-name="<?=$roomType["NAME"]?>"> 
                                            <?if ($img["src"]) {?>
                                                <img src="<?=$img["src"]?>" alt="<?=$imgInfo["DESCRIPTION"]?>" /> 
                                                <?}?>
                                            <span class="item-name"><?=$roomType["NAME"]?></span> 
                                        </div>
                                    </a>
                                    <?}
                                }?>                                
                            </div>
                        </div>


                        <div class="collection-filter__title"> отдельные предметы 
                            <a href="#all-items" id="all-items">
                                <span class="collection-filter__all js-all" data-type="item">показать все предметы</span> 
                            </a>
                        </div>

                        <div class="collection-filter__inner">
                            <?foreach ($arResult["PRODUCT_TYPES"] as $productType){?>
                                <a href="#i-<?=$productType["ID"]?>" id="i-<?=$productType["ID"]?>">
                                    <div class="collection-filter__item js-filter-item" data-filter-type="sub" data-filter="i-<?=$productType["ID"]?>" data-section="<?=$arResult["ID"]?>" data-name="<?=$productType["VALUE"]?>"><?=$productType["VALUE"]?></div>
                                </a>
                                <?}?>
                        </div>
                    </div>
                </div>

                <div class="wrapper js-items-top items-addit">
                    <div class="collection-inner js-collection-cat-filter js-collection-cat-filter-rooms">
                        <?
                            //все типы комнат
                            foreach ($arResult["ROOM_TYPES"] as $roomType) {
                                if ($roomType["ROOMS"] > 0) { 
                                    $img = CFIle::ResizeImageGet($roomType["PICTURE"],array("width"=>685,"height"=>400),BX_RESIZE_IMAGE_EXACT);
                                    $imgInfo = CFIle::GetFileArray($roomType["PICTURE"]);
                                ?> 
                                <a href="#r-<?=$roomType["ID"]?>" id="r-<?=$roomType["ID"]?>">    
                                    <div class="collection-item collection-item--big js-filter-item" data-filter="r-<?=$roomType["ID"]?>" data-section="<?=$arResult["ID"]?>" data-name="<?=$roomType["NAME"]?>"> 
                                        <?if ($img["src"]) {?>
                                            <img src="<?=$img["src"]?>" alt="<?=$imgInfo["DESCRIPTION"]?>" /> 
                                            <?}?> 
                                        <span class="item-name"><?=$roomType["NAME"]?>: <?=$roomType["ROOMS"]?></span> 
                                    </div>
                                </a>
                                <?}
                        }?>    

                    </div>

                    <div class="collection-inner collection-cat-filter-item js-collection-cat-filter js-collection-cat-filter-item" >
                        <?
                            //выводим все товары данной коллекции
                            foreach ($arResult["PRODUCT_TYPES"] as $productType){?> 
                            <a href="#i-<?=$productType["ID"]?>" id="i-<?=$productType["ID"]?>">
                                <div class="collection-item js-filter-item" data-filter="i-<?=$productType["ID"]?>" data-section="<?=$arResult["ID"]?>" data-name="<?=$productType["VALUE"]?>"> 
                                    <?
                                        $img = CFIle::ResizeImageGet($productType["PICTURE"],array("width"=>700,"height"=>470),BX_RESIZE_IMAGE_EXACT);
                                        $imgInfo = CFIle::GetFileArray($productType["PICTURE"]);
                                        if ($img["src"]) {?>
                                        <img src="<?=$img["src"]?>" alt="<?=$imgInfo["DESCRIPTION"]?>" /> 
                                        <?}?>
                                    <span class="item-name"><?=$productType["VALUE"]?></span> 
                                </div>
                            </a>
                            <?}?>    

                    </div>
                    <div class="collection-inner js-collection-items"></div>
                </div>
            </section>

            <?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/bottom_block.php")?>


            <?break;?>

            <?
                //room type
            case 3:
            ?>
            <section class="collection">

                <?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/search_form.php")?>
                <div class="collection-filter js-collection-filter" data-action="<?=$templateFolder?>/ajax.php" style="display: none;" >
                    <div class="wrapper">    
                        <div class="js-collection-main-filter">

                            <div class="collection-filter__title"> комнаты в категории 
                                <a href="#all-rooms" id="all-rooms">
                                    <span class="collection-filter__all js-all" data-type="rooms">показать все комнаты</span> 
                                </a>
                            </div>

                            <div class="collection-filter__inner">
                                <?foreach ($arResult["ROOM_TYPES"] as $i=>$roomType) {
                                    //выводим 4 первые типа
                                    if ($roomType["ELEMENT_CNT"] > 0 && $i <=3) {
                                        $img = CFIle::ResizeImageGet($roomType["PICTURE"],array("width"=>326,"height"=>190),BX_RESIZE_IMAGE_EXACT);
                                        $imgInfo = CFIle::GetFileArray($productType["PICTURE"]);
                                    ?>
                                    <a href="#r-<?=$roomType["ID"]?>" id="r-<?=$roomType["ID"]?>">
                                        <div class="collection-filter__room-item js-filter-item" data-filter-type="main" data-filter="r-<?=$roomType["ID"]?>" data-section="<?=$arResult["ID"]?>" data-name="<?=$roomType["NAME"]?>"> 
                                            <?if ($img["src"]) {?>
                                                <img src="<?=$img["src"]?>" alt="<?=$imgInfo["DESCRIPTION"]?>" /> 
                                                <?}?>
                                            <span class="item-name"><?=$roomType["NAME"]?></span> 
                                        </div>
                                    </a>
                                    <?}
                                }?>  
                                <?/*
                                    $roomType= $arResult["SECTIONS"][$arResult["DEPTH_LEVEL"]][$arResult["ID"]];
                                    $img = CFIle::ResizeImageGet($roomType["PICTURE"],array("width"=>326,"height"=>190),BX_RESIZE_IMAGE_EXACT);
                                    $imgInfo = CFIle::GetFileArray($productType["PICTURE"]);
                                    ?>
                                    <div class="collection-filter__room-item js-filter-item" data-filter-type="main" data-filter="r-<?=$roomType["ID"]?>" data-section="<?=$arResult["ID"]?>" data-name="<?=$roomType["NAME"]?>"> 
                                    <?if ($img["src"]) {?>
                                    <img src="<?=$img["src"]?>" alt="<?=$imgInfo["DESCRIPTION"]?>" /> 
                                    <?}?>
                                    <span class="item-name"><?=$roomType["NAME"]?></span> 
                                    </div>
                                <?*/?>
                            </div>
                        </div>

                        <div class="collection-filter__title"> отдельные предметы 
                            <a href="#all-items" id="all-items">
                                <span class="collection-filter__all js-all" data-type="item">показать все предметы</span> 
                            </a>
                        </div>

                        <div class="collection-filter__inner">
                            <?foreach ($arResult["PRODUCT_TYPES"] as $productType){?>
                                <a href="#i-<?=$productType["ID"]?>" id="i-<?=$productType["ID"]?>">
                                    <div class="collection-filter__item js-filter-item" data-filter-type="sub" data-filter="i-<?=$productType["ID"]?>" data-section="<?=$arResult["ID"]?>" data-name="<?=$productType["VALUE"]?>"><?=$productType["VALUE"]?></div>
                                </a>
                                <?}?>
                        </div>
                    </div>
                </div>
                <div class="wrapper js-items-top items-addit">   
                    <div class="collection-inner js-collection-cat-filter js-collection-cat-filter-rooms">
                        <?
                            //все типы комнат
                            foreach ($arResult["ROOM_TYPES"] as $roomType) {                                   
                                $img = CFIle::ResizeImageGet($roomType["PICTURE"],array("width"=>685,"height"=>400),BX_RESIZE_IMAGE_EXACT);
                                $imgInfo = CFIle::GetFileArray($productType["PICTURE"]);
                            ?> 
                            <a href="#r-<?=$roomType["ID"]?>" id="r-<?=$roomType["ID"]?>">    
                                <div class="collection-item collection-item--big js-filter-item" data-filter="r-<?=$roomType["ID"]?>" data-section="<?=$arResult["ID"]?>" data-name="<?=$roomType["NAME"]?>"> 
                                    <?if ($img["src"]) {?>
                                        <img src="<?=$img["src"]?>" alt="<?=$imgInfo["DESCRIPTION"]?>" /> 
                                        <?}?> 
                                    <span class="item-name"><?=$roomType["NAME"]?></span> 
                                </div>
                            </a>
                            <?}?>

                    </div>
                    <div class="collection-inner collection-cat-filter-item js-collection-cat-filter js-collection-cat-filter-item">
                        <?
                            //выводим все товары данной коллекции
                            foreach ($arResult["PRODUCT_TYPES"] as $productType){?>
                            <a href="#i-<?=$productType["ID"]?>" id="i-<?=$productType["ID"]?>"> 
                                <div class="collection-item js-filter-item" data-filter="i-<?=$productType["ID"]?>" data-section="<?=$arResult["ID"]?>" data-name="<?=$productType["VALUE"]?>"> 
                                    <?
                                        $img = CFIle::ResizeImageGet($productType["PICTURE"],array("width"=>685,"height"=>400),BX_RESIZE_IMAGE_EXACT);
                                        $imgInfo = CFIle::GetFileArray($productType["PICTURE"]);
                                        if ($img["src"]) {?>
                                        <img src="<?=$img["src"]?>" alt="<?=$imgInfo["DESCRIPTION"]?>" /> 
                                        <?}?>
                                    <span class="item-name"><?=$productType["VALUE"]?></span> 
                                </div>
                            </a>
                            <?}?>

                    </div>
                    <div class="collection-inner js-collection-items"></div>
                </div>
            </section>

            <?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/bottom_block.php")?>    

            <?break;?>


            <?
                //room page
            case 4:?>

            <div class="slide-carousel library-carousel">
                <div class="slide-carousel__wrap library-carousel__wrap js-slider">

                    <?if ($arResult["PICTURE"]["SRC"]) {?>
                        <div class="library-carousel__item" style="background-image: url('<?=$arResult["PICTURE"]["SRC"]?>')"></div>
                        <?}?>
                    <?if (is_array($arResult["SECTIONS"][4][$arResult["ID"]]["UF_ROOM_PICTURES"])){
                            foreach ($arResult["SECTIONS"][4][$arResult["ID"]]["UF_ROOM_PICTURES"] as $picture) {
                                $path = CFile::GetPath($picture);?>                                                                                                   
                            <div class="library-carousel__item" style="background-image: url('<?=$path?>')"></div>  
                            <?}?>                                  
                        <?}?>

                </div>
                <div class="library-carousel__btns">
                    <div class="btn btn--white js-show-hidden" data-target="cost" data-swap="свернуть">показать стоимость</div>
                    <div class="btn btn--white js-show-hidden" data-target="stores" data-swap="скрыть">где посмотреть?</div>
                    <?if ($arResult["SECTIONS"][4][$arResult["ID"]]["UF_SHOP_LINK"]) {?>
                        <a href="<?=$arResult["SECTIONS"][4][$arResult["ID"]]["UF_SHOP_LINK"]?>"><div class="btn btn--white">купить в интернет-магазине</div></a>
                        <?}?>
                </div>
            </div>

            <div class="library-cost js-hidden" data-target='cost'>
                <div class="wrapper">      
                    <h2 class="library-cost__title">Всего предметов: <?=count($arResult["ITEMS"])?> /  общая стоимость: от <?=$arResult["TOTAL_PRICE"]?> рублей</h2>

                    <div class="library-cost__list">
                        <?foreach ($arResult["ITEMS"] as $item) {?>
                            <a href="<?=$item["DETAIL_PAGE_URL"]?>" class="library-cost__item">
                                <?if ($item["DETAIL_PICTURE"]["ID"]) {  
                                    ?>
                                    <div class="library-cost__item-image">
                                        <img src="<?=$item["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$item["DETAIL_PICTURE"]["DESCRIPTION"]?>" />
                                    </div>
                                    <?}?>

                                <div class="library-cost__item-desc">
                                    <div class="library-cost__item-title"><?=$item["NAME"]?></div>    
                                    <div class="library-cost__item-price">
                                        <?
                                            if ($item["MIN_PRICE"]) {?>
                                            ОТ <?=$item["MIN_PRICE"]?> РУБЛЕЙ
                                            <?} else {
                                                foreach($arResult["PRICES"] as $code=>$arPrice){?>
                                                <?if($arPrice = $item["PRICES"][$code]):?>
                                                    <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                                        <?=$arPrice["PRINT_DISCOUNT_VALUE"]?>
                                                        <?else:?>
                                                        <?=$arPrice["PRINT_VALUE"]?>
                                                        <?endif?>                             
                                                    <?endif;?>
                                                <?}?>
                                            <?}?>
                                    </div>
                                </div>
                            </a>
                            <?}?>
                    </div>  
                </div>
            </div>

            <?if (is_array($arResult["SHOPS"]) && count($arResult["SHOPS"]) > 0) {?> 
                <section class="library-stores js-hidden" data-target='stores'>

                    <div class="library-stores__inner">
                        <div class="wrapper">
                            <h2 class="more-stores__title">где посмотреть</h2>
                            <div class="carousel__nav more-stores__nav"> </div>
                            <div class="more-stores__list js-carousel">
                                <?foreach ($arResult["SHOPS"] as $shop) {?>                                      
                                    <a href="<?=$shop["DETAIL_PAGE_URL"]?>" class="more-stores__item">
                                        <?if($shop["DETAIL_PICTURE"]){
                                                $img = CFIle::ResizeImageGet($shop["DETAIL_PICTURE"],array("width"=>326,"height"=>210),BX_RESIZE_IMAGE_EXACT);
                                                $imgInfo = CFIle::GetFileArray($productType["PICTURE"]);
                                            ?>
                                            <div class="more-stores__image">
                                                <img src="<?=$img["src"]?>" alt="<?=$imgInfo["DESCRIPTION"]?>">
                                            </div>
                                            <?}?>
                                        <div class="more-stores__name clear_margin_left" >
                                            <?if (is_array($shop["METRO"]) && count($shop["METRO"]) > 0) {?>
                                                <?foreach ($shop["METRO"] as $station) {?>
                                                    <div class="shopMetroStation">
                                                        <div class="shopMetroStationColor" style="background: #<?=$station["COLOR"]?>;"></div>
                                                        <div>м. <?=$station["NAME"]?></div>
                                                    </div>
                                                    <?}?>
                                                <?}?>                              
                                            <?=$shop["NAME"]?>
                                        </div>
                                    </a>
                                    <?}?>
                            </div>
                        </div>
                    </div>
                </section>
                <?}?>

            <?if(is_array($arResult["ATTENTION"]) && count($arResult["ATTENTION"]) > 0) {?>
                <section class="library-attention">
                    <div class="wrapper">
                        <h2 class="library-attention__title">Обратите внимание</h2>
                        <div class="carousel__nav more-stores__nav"></div>
                        <div class="library-attention__list js-carousel">

                            <?foreach ($arResult["ATTENTION"] as $attentionItem) {?>
                                <div class="library-attention__item">
                                    <a href="<?=$attentionItem["LINK"]?>" class="library-attention__image <?if ($attentionItem["PROPERTY_VIDEO_LINK_VALUE"]){?> __video js-video-popup<?} else {?> js-image-popup <?}?>"> 
                                        <?if ($attentionItem["DETAIL_PICTURE"]["SRC"])?>
                                        <img src="<?=$attentionItem["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$attentionItem["DETAIL_PICTURE"]["DESCRIPTION"]?>"> 
                                    </a>
                                    <h3 class="library-attention__item-title"><?=$attentionItem["NAME"]?></h3>
                                    <div class="library-attention__text"><?=$attentionItem["DETAIL_TEXT"]?></div>
                                </div>
                                <?}?>     

                        </div>
                    </div>
                </section>
                <?}?>

            <?if (is_array($arResult["SECTION_COLORS"]) && count ($arResult["SECTION_COLORS"]) > 0) {?>
                <section class="library-colors">
                    <div class="wrapper cf">
                    <h2 class="library-colors__title">цвета</h2>
                    <div class="library-colors__left">
                        <div class="library-colors__list">
                            <?foreach ($arResult["SECTION_COLORS"] as $i=>$sectionColor) {?>
                                <div class="library-colors__item">
                                    <div class="library-colors__item-color js-item-color <?if ($i == 0) {?>__selected<?}?>" data-color="<?=$sectionColor["ID"]?>" style="background-image: url(<?=$arResult["COLORS_LIST"][$sectionColor["PROPERTY_COLOR_VALUE"]]["COLOR_TEMPLATE_PATH"]?>)"></div>
                                    <div class="library-colors__item-title"><?=$arResult["COLORS_LIST"][$sectionColor["PROPERTY_COLOR_VALUE"]]["NAME"]?></div>
                                </div>
                                <?}?>   
                        </div>

                        <div class="library-colors__description">
                            <?foreach ($arResult["SECTION_COLORS"] as $i=>$sectionColor) {?>
                                <div class="library-colors__current <?if ($i == 0) {?>__selected<?}?> js-color-text" data-color="<?=$sectionColor["ID"]?>">
                                    <h3 class="library-colors__current-title"><?=$arResult["COLORS_LIST"][$sectionColor["PROPERTY_COLOR_VALUE"]]["NAME"]?></h3>
                                    <div class="library-colors__current-text"><?=$arResult["COLORS_LIST"][$sectionColor["PROPERTY_COLOR_VALUE"]]["DETAIL_TEXT"]?></div>
                                </div>
                                <?}?>
                        </div> 

                    </div>
                    <div class="library-colors__image"> 
                        <?foreach ($arResult["SECTION_COLORS"] as $i=>$sectionColor) {
                                $img = CFIle::ResizeImageGet($sectionColor["DETAIL_PICTURE"],array("width"=>764,"height"=>490),BX_RESIZE_IMAGE_EXACT);
                                $imgInfo = CFile::GetFileArray($sectionColor["DETAIL_PICTURE"]);
                            ?>
                            <img class="js-color-image <?if ($i == 0) {?>__selected<?}?>" data-color="<?=$sectionColor["ID"]?>" src="<?=$img["src"]?>" alt="<?=$imgInfo["DESCRIPTION"]?>"> 
                            <?}?>                          
                    </div>
                </section>
                <?}?>

            <div class="library-help">
                <div class="wrapper cf">
                    <div class="library-help__title">Не можете определиться какая мебель подойдет? Нужна помощь дизайнера?</div>
                    <a href="/designers-help/"><div class="btn btn--greenbg">получить помощь</div></a>
                </div>
            </div>


            <?if(is_array($arResult["OTHER_ROOMS"]) && count ($arResult["OTHER_ROOMS"]) > 0) {?>
                <div class="library-other">
                    <div class="wrapper">
                        <?
                            $nav = array(0=>"__prev",1=>"__next");
                            foreach ($arResult["OTHER_ROOMS"] as $i=>$otherRoom) {?>
                            <a href="<?=$otherRoom["SECTION_PAGE_URL"]?>" class="library-other__item <?=$nav[$i]?>">
                                <?if ($otherRoom["PICTURE"]) {?>
                                    <?
                                        $img = CFIle::ResizeImageGet($otherRoom["PICTURE"],array("width"=>685,"height"=>450),BX_RESIZE_IMAGE_EXACT); 
                                        $imgInfo = CFile::GetFileArray($otherRoom["PICTURE"]);
                                    ?> 
                                    <img src="<?=$img["src"]?>" alt="<?=$imgInfo["DESCRIPTION"]?>">
                                    <?}?>
                                <div class="library-other__title"><span><?=$otherRoom["NAME"]?></span></div>
                            </a>
                            <?if ($i >=1){break;}?>
                            <?}?>
                    </div>
                </div>
                <?}?>

            <?break;?>

            <?}?>  
    <?}?>         

<?if ($arResult["DEPTH_LEVEL"] > 1) {?>
    <script>
        $(function(){                               
            <?if ($arResult["DEPTH_LEVEL"] != 4){?>              
                $("body").addClass("collection-page");
                <?}?>

            //при наличии в улре параметров, применяем фильтр
            var url = document.location.href;
            if (url.indexOf("#") > 0) {
                var id = url.split("#");
                //имитируем клик по вложенным элементам
                setTimeout(function(){$("#" + id[1] + " > *:first").click(); return false},1);
            } else {
                <?if ($arResult["DEPTH_LEVEL"] == 3) {?>
                    setTimeout(function(){$("#r-<?=$arResult["ID"]?>  > *:first").click(); return false},1);
                    <?}?>
            }
        })
    </script>
    <?}?>