<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?if (trim($_REQUEST["query"]) != "" && intval($_REQUEST["section"]) > 0) {
        //ajax-searh
        $query = trim($_REQUEST["query"]);
        $section = intval($_REQUEST["section"]);

        //проверяем вложенность раздела. Если мы на 3 уровне - берем раздел-родитель
        $arSectionInfo = CIBlockSection::GetByID($section)->Fetch();
        if ($arSectionInfo["DEPTH_LEVEL"] == 3) {
            $section = $arSectionInfo["IBLOCK_SECTION_ID"];
        }

        $items = CIBlockElement::GetList(array("SORT"=>"ASC"),array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, "ACTIVE"=>"Y", "?NAME"=>$query, "SECTION_ID"=>$section, "INCLUDE_SUBSECTIONS"=>"Y"),false,false,array("ID","NAME","DETAIL_PICTURE","DETAIL_PAGE_URL"));
        while($arItem = $items->GetNext()) {
            $arResult["SEARCH_RESULT"]["ITEMS"][] = $arItem;
        }

        $sectionList = [];
        //        $arFilter = array('IBLOCK_ID' => 6, 'LEFT_MARGIN' => $arSectionInfo["LEFT_MARGIN"], 'RIGHT_MARGIN' => $arSectionInfo["RIGHT_MARGIN"]);
        $arFilter = array('IBLOCK_ID' => 6, "SECTION_ID"=>$section,);
        $rsSections = CIBlockSection::GetList(array('LEFT_MARGIN' => 'ASC'), $arFilter,false,array("ID"));
        while ($arSection = $rsSections->Fetch())
        {
            $sectionList[] = $arSection["ID"];
        }

        $sections =  CIBlockSection::GetList(array("SORT"=>"ASC"),array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, "ACTIVE"=>"Y","NAME"=>"%".$query."%", "SECTION_ID"=>$sectionList,"INCLUDE_SUBSECTIONS"=>"Y"));
        while($arSection = $sections->GetNext()) {
            $arResult["SEARCH_RESULT"]["SECTIONS"][] = $arSection;
        }

        if (count($arResult["SEARCH_RESULT"]["SECTIONS"]) > 0 || count($arResult["SEARCH_RESULT"]["ITEMS"]) > 0 ) {
            $strRes = '{"searchItems": ['; 
            //sections   
            foreach ($arResult["SEARCH_RESULT"]["SECTIONS"] as $section) {
                $img = CFIle::ResizeImageGet($section["PICTURE"],array("width"=>130,"height"=>80),BX_RESIZE_IMAGE_EXACT);
                if (!$img["src"]) {$img["src"] = "/img/no_photo.png";}
                $strRes .= '{
                "title": "'.$section["NAME"].'",
                "img": "'.$img["src"].'",
                "link": "'.$section["SECTION_PAGE_URL"].'"
                },';
            }
            //items      
            foreach ($arResult["SEARCH_RESULT"]["ITEMS"] as $item) {
                $img = CFIle::ResizeImageGet($item["DETAIL_PICTURE"],array("width"=>130,"height"=>80),BX_RESIZE_IMAGE_EXACT);
                if (!$img["src"]) {$img["src"] = "/img/no_photo.png";}
                $strRes .= '{
                "title": "'.$item["NAME"].'",
                "img": "'.$img["src"].'",
                "link": "'.$item["DETAIL_PAGE_URL"].'"
                },';
            }

            $strRes = substr($strRes,0,strlen($strRes) -1); 

            $strRes .= ']}';     

            echo $strRes;
        }
    }
?>