<div class="wrapper">
    <div class="search">
        <form class="search-form js-search" id="search" action="<?=$APPLICATION->GetCurPage()?>" data-ajax="<?=$templateFolder."/ajax_search.php"?>" data-section="<?=$arResult["ID"]?>">
            <input class="collection__search js-search-input" id="search-input" name="search" type="text" placeholder="поиск по коллекции" value="<?=trim($_REQUEST["search"])?>" autocomplete="off"/>
            <input class="collection__search-submit" type="submit" value="" /> 
        </form>
        <div class="search__dropdown js-search-dropdown _hidden"></div>
    </div>
</div>