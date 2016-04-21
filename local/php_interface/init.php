<?
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");
    CModule::IncludeModule("main");


    define("ARTICLES_IBLOCK_ID", 5); //constants iblock id     
    define("CATALOG_IBLOCK_ID", 6); //catalog iblock id
    define("OFFERS_IBLOCK_ID", 19); //offers iblock id
    define("IMPORT_CATALOG", 17); //инфоблок, выгруженный из 1С 

    global $arWaterMark;
    $arWaterMark = Array(
        array(
            "name" => "watermark",
            "position" => "bottomright", // Положение
            "type" => "image",
            "size" => "real",
            "file" => $_SERVER["DOCUMENT_ROOT"].'/images/watermark.png', // Путь к картинке
        )
    );


    function arshow($array, $adminCheck = false){
        global $USER;
        $USER = new Cuser;
        if ($adminCheck) {
            if (!$USER->IsAdmin()) {
                return false;
            } 
        }
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    AddEventHandler("iblock","OnAfterIBlockElementUpdate",array("ElementUpdateFunctions","ElementUpdateHandler"));
    AddEventHandler("iblock","OnAfterIBlockElementAdd",array("ElementUpdateFunctions","ElementUpdateHandler"));       

    class ElementUpdateFunctions {          

        function ElementUpdateHandler($arFields){  
            //remove flag "main article" from all articles except this                  
            if($arFields["IBLOCK_ID"] == ARTICLES_IBLOCK_ID) {
                $checkMainArticleFlag = CIBLockElement::GetList(array(),array("ID"=>$arFields["ID"],"!PROPERTY_MAIN_ARTICLE"=>false),false,false,array("ID")); 
                if ($checkMainArticleFlag->SelectedRowsCount() > 0) {
                    RemoveMainArticleFlag($arFields["ID"]);
                } 
            }   
        } 
    }      


    //remove flag "main article" from articles
    function RemoveMainArticleFlag($articleID) {
        //removing flag from other articles
        $mainArticlesList = CIBlockElement::GetList(array(),array("IBLOCK_CODE"=>"articles","!PROPERTY_MAIN_ARTICLE"=>false,"!ID"=>$articleID),false,false,array("ID"));
        while($arArticle = $mainArticlesList->Fetch()) {
            CIBlockElement::SetPropertyValuesEx($arArticle["ID"], false, array("MAIN_ARTICLE" => ""));
        }             
    }



    //функция генерации символьного кода для элементов каталога 
    //$name - имя товара, $num - постфикс, если ноль, то ничего не прибавляем, если > 0, то дописываем его к имени: имя_$num, $iblockID - ID инфоблока, если не задан - ищем по всем
    function getSymbolCode($name,$num=0,$iblockID=false) {             
        //генерим символьный код
        if ($num <= 0) {
            $code = Cutil::translit($name, "ru", array());
        }           
        else  {
            $code = Cutil::translit($name, "ru", array())."_".$num;
        }            

        //проверяем существование элемента в каталоге
        $filter = array("CODE"=>$code);
        if (intval($iblockID) > 0) {
            $filter["IBLOCK_ID"] = $iblockID; 
        }
        $el = CIBlockElement::GetList(array(), $filter,false, false, array("ID"));

        //если элемент с текущим символьным кодом существует, то вызываем функцию еще раз, добавив к символьному коду единицу   
        if ($el->SelectedRowsCount() > 0) {
            //  echo "count: ".$el->SelectedRowsCount()."<br>";    
            $code = getSymbolCode($name,$num+1,$iblockID);   
        }       

        return $code;

    }  

    //функция обновления цен и остатков после выгрузки товаров из 1С
    AddEventHandler("catalog","OnPriceUpdate",array("CatalogUpdateFunctions","CatalogElementUpdateHandler"));
    AddEventHandler("catalog","OnStoreProductUpdate",array("CatalogUpdateFunctions","CatalogElementUpdateHandler"));

    class CatalogUpdateFunctions {

        function CatalogElementUpdateHandler($ID,$arDataFields) {

            //получаем ID инфоблока элемента 
            $arFields = CIBlockElement::GetList(array(),array("ID"=>$arDataFields["PRODUCT_ID"]),false,false,array("IBLOCK_ID","ID","XML_ID"))->Fetch();    

            //функция обновления остатков и цен после изменения/добавления товара при выгрузке из 1С
            if($arFields["IBLOCK_ID"] == IMPORT_CATALOG) {
                //проверяем, существует ли в каталоге товаров товар с таким же внешним кодом
                $checkItem = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>OFFERS_IBLOCK_ID,"XML_ID"=>$arFields["XML_ID"]),false,false,array("ID"))->Fetch();  

                $catalogProductInfo = CCatalogProduct::GetList(array(),array("ID"=>$arDataFields["PRODUCT_ID"]),false,false,array())->Fetch();  

                //если товар существует - обновляем его
                if ($checkItem["ID"] > 0) {
                    //собираем ID типов цен
                    $priceList = array();
                    $pricesSelect = array(); //массив для подстановки в запрос на выборку тваров
                    $prices = CCatalogGroup::GetList(array("ID"=>"ASC"), array(), false, false, array("ID"));
                    while($arPrice = $prices->Fetch()) {
                        $priceList[] = $arPrice["ID"]; 
                        //массив для выборки цен из товаров, выгруженных из 1С
                        $pricesSelect[] = "CATALOG_GROUP_".$arPrice["ID"];
                    }

                    //собираем ID складов
                    $storeList = array();
                    $storeSelect = array(); //массив для подстановки в запрос на выборку тваров
                    $stores = CCatalogStore::GetList(array("ID"=>"ASC"), array(), false, false, array("ID"));
                    while($arStore = $stores->Fetch()) {
                        $storeList[] = $arStore["ID"];
                        //массив для выборки остатков по складам из товаров, выгруженных из 1С 
                        $storeSelect[] = "CATALOG_STORE_AMOUNT_".$arStore["ID"];
                    } 

                    $arSelect = array("ID","NAME","XML_ID","CATALOG_QUANTITY");
                    $arSelect = array_merge($arSelect,$pricesSelect,$storeSelect);

                    //получаем цены и остатки выгруженного элемента
                    $arElement = CIBlockElement::GetList(array(),array("ID"=>$arFields["ID"]),false,false,$arSelect)->Fetch();      


                    //обновление цен
                    if (!$arDataFields["STORE_ID"]) { //срабатывает только при событии обновления цены
                        //добавляем/обновляем цены      
                        foreach ($priceList as $priceID){
                            $price = $arElement["CATALOG_PRICE_".$priceID];
                            $dataPrice = array("PRODUCT_ID" => $checkItem["ID"], "PRICE" => $price, "CURRENCY" => "RUB", "CATALOG_GROUP_ID" => $priceID);
                            //проверяем существование данной цены
                            $res = CPrice::GetList(array(),array("PRODUCT_ID" => $checkItem["ID"], "CATALOG_GROUP_ID" => $priceID));
                            //если цена данного типа есть, обновляем, если нет - добавляем    
                            if ($arr = $res->Fetch()){
                                CPrice::Update($arr["ID"], $dataPrice); 
                            } else {
                                CPrice::Add($dataPrice);
                            }     
                        }         

                    } else {  //срабатывает только при событии обновления остатков
                        //обновляем остатки
                        foreach ($storeList as $storeID) {
                            $amount = $arElement["CATALOG_STORE_AMOUNT_".$storeID];
                            $dataAmount = array("PRODUCT_ID" => $checkItem["ID"], "AMOUNT" => $amount, "STORE_ID" => $storeID);
                            //проверяем существование остатков по данному складу
                            $res = CCatalogStoreProduct::GetList(array(),array("PRODUCT_ID" => $checkItem["ID"], "STORE_ID" => $storeID));
                            //если остатки есть - обновляем, если нет - добавляем    
                            if ($arr = $res->Fetch()){
                                CCatalogStoreProduct::Update($arr["ID"], $dataAmount);
                            } else {
                                CCatalogStoreProduct::Add($dataAmount);
                            }        
                        } 

                        //обновляем общее количество
                        $arProductFields = array("QUANTITY" => $catalogProductInfo["QUANTITY"]);
                        CCatalogProduct::Update($checkItem["ID"], $arProductFields);                       
                    }         
                }   
            }    
        }

    }   

    //добавляем в админсатративном меню ссылку на страницу для загрузки файла
    AddEventHandler("main","OnBuildGlobalMenu","OnBuildGlobalMenu");             
    function OnBuildGlobalMenu(&$aGlobalMenu, &$aModuleMenu)
    {
        global $USER;
        if(!$USER->IsAdmin()){
            return;
        }

        $importMenu = array(
            "parent_menu" => "global_menu_content",
            "section" => "fileman",
            "sort" => "10",
            "text" => "Импорт каталога из файла",
            "title" => "Импорт файла каталога",
            "icon" => "workflow_menu_icon",
            "page_icon" => "workflow_menu_icon",
            "items_id" => "menu_fileman",
            "more_url" => Array(), 
            "items" => Array(),
            "url" => "/bitrix/admin/wellige_catalog_import.php"
        );
        $aModuleMenu[] = $importMenu;      
    }  


    //функция импорта каталога из файла
    function importCatalog($filePath) {

        $result = false;

        $file = $filePath;
        if (!file_exists($file)) {
            return $result;
        }

        //путь к файлу лога. Если уже существует - удаляем.
        $logFileName = $_SERVER["DOCUMENT_ROOT"].'/import_log/'.date("Y-m-d").'_log.txt';
        if (file_exists($logFileName)) {
            unlink($logFileName);
        }

        //собираем материалы
        $arMaterials = array();
        $materials = CIBlockElement::GetList(array(),array("IBLOCK_CODE"=>"materials"),false,false,array("NAME","ID"));
        while($arMaterial = $materials->Fetch()) {
            //в загружаемом файле названия материалов в нижнем регистре, поэтому необходима данная операция
            $arMaterials[strtolower($arMaterial["NAME"])] = $arMaterial["ID"];  
        }

        //собираем ID типов цен
        $priceList = array();
        $pricesSelect = array(); //массив для подстановки в запрос на выборку тваров
        $prices = CCatalogGroup::GetList(array("ID"=>"ASC"), array(), false, false, array("ID"));
        while($arPrice = $prices->Fetch()) {
            $priceList[] = $arPrice["ID"]; 
            //массив для выборки цен из товаров, выгруженных из 1С
            $pricesSelect[] = "CATALOG_GROUP_".$arPrice["ID"];
        }

        //собираем ID складов
        $storeList = array();
        $storeSelect = array(); //массив для подстановки в запрос на выборку тваров
        $stores = CCatalogStore::GetList(array("ID"=>"ASC"), array(), false, false, array("ID"));
        while($arStore = $stores->Fetch()) {
            $storeList[] = $arStore["ID"];
            //массив для выборки остатков по складам из товаров, выгруженных из 1С 
            $storeSelect[] = "CATALOG_STORE_AMOUNT_".$arStore["ID"];
        }


        //собираем товары, выгруженные из 1С
        $importProducts = array();         
        $offersSelect = array("ID","NAME","XML_ID","CATALOG_QUANTITY");
        //добавляем в запрос выборку количества по складам и цены
        $offersSelect = array_merge($offersSelect,$pricesSelect,$storeSelect);
        $offers = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>IMPORT_CATALOG),false,false,$offersSelect);
        while($arOffer = $offers->Fetch()) {
            $importProducts[trim($arOffer["NAME"])] = $arOffer;
        }

        //собираем текущие товары и предложения
        $currentItems = array();
        $currentOffers = array();
        $catalogItems = CIBlockElement::GetList(array("NAME"=>"ASC"),array("IBLOCK_ID"=>array(CATALOG_IBLOCK_ID,OFFERS_IBLOCK_ID)),false,false,array("ID","PROPERTY_DEFAULT_NAME","NAME","IBLOCK_ID"));   
        while($arCatalogItem = $catalogItems->Fetch()) {
            //товары
            if ($arCatalogItem["IBLOCK_ID"] == CATALOG_IBLOCK_ID) {
                //для товаров используем поле "имя в 1С"
                $name = $arCatalogItem["NAME"];
                if (!empty($arCatalogItem["PROPERTY_DEFAULT_NAME_VALUE"])) {
                    $name = $arCatalogItem["PROPERTY_DEFAULT_NAME_VALUE"];
                }
                $currentItems[$name] = $arCatalogItem["ID"]; 

            } else {  //торговые предложения
                $name = $arCatalogItem["NAME"];
                $currentOffers[$name] = $arCatalogItem["ID"];
            }

        }     


        $resultArray = array();
        $f = fopen($file, "r");
        while($str = fgets($f, 1024)){
            $str = iconv("CP1251", "UTF-8", $str);

            $tempArr = array();
            $tempArr = explode(";", $str);       

            if (!empty($tempArr[5]) && $tempArr[0] != "Номенклатура" && $tempArr[2] == "Да") {    
                foreach ($tempArr as $i=>$item) {  
                    //убираем из строк лишние пробелы и кавычки
                    $item = str_replace(array('""',"@"), array('#',";"), $item);    
                    $item = str_replace('"', '', $item);
                    $item = str_replace('#', '"', $item); 
                    $item = trim($item);   

                    //находим внешний код по имени
                    if ($i == 0){  //0 - столбец с именем                           
                        if ($importProducts[$item]["XML_ID"]) {
                            $tempArr[35] = $importProducts[$item]["XML_ID"]; 
                        }  
                    }

                    //цена
                    if ($i == 34) {
                        $price = explode(",",$item);
                        $pattern = "/\D/";
                        $item = preg_replace($pattern,"",$price[0]);
                    }

                    $tempArr[$i] = $item; 
                }     
                $resultArray[] = $tempArr;

            }
            /*  //для отладки
            else {
                echo "товар ".$tempArr[5]." не соответствует требованиям: ".$tempArr[5]."-".$tempArr[0]."-".$tempArr[2]."<br>";
            }  */
        }
        fclose($f);       

        $offers = array();
        
        

        foreach ($resultArray as $item) {   
            $offers[$item[5]][] = $item;       
        }    
        
        $CATALOG_IBLOCK_ID = CATALOG_IBLOCK_ID; //каталог товаров
        $SKU_IBLOCK_ID = OFFERS_IBLOCK_ID; //инфоблок предложений
        $PARENT_SECTION = 1780; //родительский раздел для импортируемых товаров

        $newITEMS = array();
        $result = array("ITEMS_ADD"=>0, "ITEMS_UPDATE"=>0, "OFFERS_ADD"=>0, "OFFERS_UPDATE"=>0);


        foreach ($offers as $name=>$offer) {

            $logText = "";

            $itemExist = false;
            //ищем товар среди уже созданных
            if ($currentItems[$name] > 0) {
                $PRODUCT_ID = $currentItems[$name];
                $itemExist = true;  

                $logText .= "Товар: ".$PRODUCT_ID." [".$name."] существует; ".$err." товар будет обновлен\n"; 
                $result["ITEMS_UPDATE"]++; //общее количество обновленных товаров

            } else {
                //если товара нет - добавляем      

                //формируем новый товар
                $el = new CIBlockElement;   

                //первое предложение данного товара
                $firstOffer = $offer[0]; 

                $PROP = array();
                //артикул
                $PROP["VENDOR_CODE"] = $firstOffer[8]; 

                //размеры
                $dimensions = explode("х",$firstOffer[14]);            
                if (is_array($dimensions)) {
                    $PROP["HEIGHT"] = $dimensions[1]; //высота
                    $PROP["DEPTH"] = $dimensions[2]; //глубина
                    $PROP["WIDTH"] = $dimensions[0]; //ширина
                }

                //вес
                $PROP["WEIGHT"] = $firstOffer[26]; 

                //объем
                $PROP["VOLUME"] = $firstOffer[27]; 

                //требуется сборка
                if (intval($firstOffer[29]) > 0) {
                    $PROP["ASSEMBLY_REQUIRED"] = 71; 
                }              

                //габаритность
                if (intval($firstOffer[30]) == 1)  {
                    $PROP["DIMENSIONS"] = 69; //крупногабаритный товар
                } else {
                    $PROP["DIMENSIONS"] = 70; //некрупногабаритный товар
                }     

                //материалы
                if ($arMaterials[$firstOffer[16]] > 0) {
                    $PROP["MATERIALS"] = $arMaterials[$firstOffer[16]]; 
                }

                //имя из 1С
                $PROP["DEFAULT_NAME"] = $name; 

                $arLoadProductArray = Array(
                    "IBLOCK_SECTION_ID" => $PARENT_SECTION,          // элемент лежит в корне раздела, раздел обновим ниже
                    "IBLOCK_ID"      => $CATALOG_IBLOCK_ID,
                    "NAME"           => $name,
                    "ACTIVE"         => "N",
                    "CODE"           => getSymbolCode($name), 
                    "PROPERTY_VALUES"=> $PROP,
                );              

                //получаем ID нового товара, к которому будем добавлять ТП
                $PRODUCT_ID = $el->Add($arLoadProductArray);     

                //лог
                if (!$PRODUCT_ID) {
                    $err = $el->LAST_ERROR."; ";    
                }   
                else {
                    $result["ITEMS_ADD"]++; //общее количество добавленных товаров
                }   

                $logText .= "Товар: ".$PRODUCT_ID." (".$name.") создан; ".$err." символьный код: ".Cutil::translit($name, "ru", array())."\n"; 
            }                   



            $product = $arLoadProductArray; 

            //если есть основной товар
            if ($PRODUCT_ID > 0) {

                //если товар не существовал ранее, добавляем свойства товара
                if (!$itemExist) {
                    $arFields = array(
                        "ID" => $PRODUCT_ID,             
                    );
                    CCatalogProduct::Add($arFields); 
                }         

                //перебираем ТП для данного товара      
                foreach ($offer as $offerItem) {   

                    //проверяем предложение на существование
                    $skuExist = false;
                    if($currentOffers[$offerItem[0]] > 0) {
                        $skuExist = true;
                        $SKU_ID = $currentOffers[$offerItem[0]]; 
                    }      

                    //получаем товар, который был выгружен из 1С и соответствует данному предложению
                    $importedSKU = $importProducts[$offerItem[0]];

                    //создаем ТП   
                    $sku = new CIBlockElement;
                    $sku_prop = array();

                    //связь с товаром
                    $sku_prop["CML2_LINK"] = $PRODUCT_ID;

                    //артикул
                    $sku_prop["VENDOR_CODE"] = $offerItem[8];    

                    //вес
                    $sku_prop["WEIGHT"] = $offerItem[26]; 

                    //объем
                    $sku_prop["VOLUME"] = $offerItem[27];                               

                    //габаритность
                    if (intval($offerItem[30]) == 1)  {
                        $sku_prop["DIMENSIONS_TYPE"] = 116; //крупногабаритный товар
                    } else {
                        $sku_prop["DIMENSIONS_TYPE"] = 117; //некрупногабаритный
                    }

                    //спальное место/механизм
                    $sku_prop["MECHANISM"] = $offerItem[9]; 

                    //раскладной да/нет
                    if ($offerItem[6] == "раскл.") {
                        $sku_prop["FOLDING"] = 113; 
                    }

                    //декор
                    $sku_prop["DECORATION"] = $offerItem[7]; 

                    //левая, левое, левый, правое, правый, правая
                    if ($offerItem[11] == "левая" || $offerItem[11] == "левый" || $offerItem[11] == "левое") {
                        $sku_prop["LEFT_RIGHT"] =  114; //левый
                    }
                    else if ($offerItem[11] == "правая" || $offerItem[11] == "правый" || $offerItem[11] == "правое"){
                        $sku_prop["LEFT_RIGHT"] = 115; //правый
                    }

                    //габариты строкой
                    $sku_prop["DIMENTIONS"] = $offerItem[14];

                    //номенклатурная группа
                    $sku_prop["GROUP"] = $offerItem[15]; 

                    //сборка
                    $sku_prop["ASSEMBLY"] =  $offerItem[29];

                    //занос
                    $sku_prop["BANK"] =  $offerItem[31]; 
                    $sku_prop["BANK"] =  $offerItem[31]; 

                    //обивка
                    $sku_prop["UPHOLSTERY"] = $offerItem[13];

                    //пакеты
                    $sku_prop["PARTS"] = $offerItem[28];

                    //материалы
                    if ($arMaterials[$offerItem[16]] > 0) {
                        $sku_prop["MATERIALS"] = $arMaterials[$offerItem[16]]; 
                    }                   

                    //если предложение не существует - добавляем
                    if (!$skuExist) {    
                        //свойства ТП
                        $arLoadProductArray = Array(
                            "IBLOCK_SECTION_ID" => false,          
                            "IBLOCK_ID"      => $SKU_IBLOCK_ID,
                            "PROPERTY_VALUES"=> $sku_prop,
                            "NAME"           => $offerItem[0],
                            "ACTIVE"         => "Y",
                            "XML_ID"         => $offerItem[35] 
                        ); 

                        //получаем ID нового ТП, относящееся к товару $PRODUCT_ID
                        $SKU_ID = $sku->Add($arLoadProductArray);   
                        $logText .= "ТП с кодом ".$code." не найдено! Cоздано новое: ".$SKU_ID." \n "; 
                        $result["OFFERS_ADD"]++;  //общее количество добавленных предложений

                        //добавляем свойства товара  
                        $new_sku_params["ID"] = $SKU_ID;     
                        $new_sku_params["QUANTITY"] = $importProducts[$offerItem[0]]["CATALOG_QUANTITY"]; //общее количество    
                        $sku_res = CCatalogProduct::Add($new_sku_params); 

                        //лог
                        if ($sku_res) {
                            $sku_renew = "свойства товара добавлены к элементу ".$SKU_ID.";";
                        } else {
                            $sku_renew = "ошибка добавления элемента каталога к товару ".$SKU_ID."\n";
                        }
                        $logText .= $sku_renew."\n ";
                    } else { 
                        //если предложение существует, обновляем значения свойств                       
                        CIBlockElement::SetPropertyValuesEx($SKU_ID, false, $sku_prop);

                        //обновляем общее количество
                        $new_sku_params = array(); // $sku_params;
                        $new_sku_params["QUANTITY"] = $importProducts[$offerItem[0]]["CATALOG_QUANTITY"]; //общее количество    
                        $sku_res = CCatalogProduct::Update($SKU_ID, $new_sku_params);

                        $logText .= "Предлождение ".$SKU_ID." [".$offerItem[0]."] обновлено \n ";
                        $result["OFFERS_UPDATE"]++;  //общее количество обновленных предложений
                    }              

                    //добавляем/обновляем цены      
                    foreach ($priceList as $priceID){
                        $price = $importedSKU["CATALOG_PRICE_".$priceID];
                        if (empty($price)) {
                           $price = $offerItem[34];
                        }
                        $dataPrice = array("PRODUCT_ID" => $SKU_ID, "PRICE" => $price, "CURRENCY" => "RUB", "CATALOG_GROUP_ID" => $priceID);
                        //проверяем существование данной цены
                        $res = CPrice::GetList(array(),array("PRODUCT_ID" => $SKU_ID, "CATALOG_GROUP_ID" => $priceID));
                        //если цена данного типа есть, обновляем, если нет - добавляем    
                        if ($arr = $res->Fetch()){
                            CPrice::Update($arr["ID"], $dataPrice);                        
                        } else {
                            CPrice::Add($dataPrice);
                        }   
                    }

                    $logText .= "Цены у предложения [".$SKU_ID."] обновлены \n ";

                    //обновляем остатки
                    foreach ($storeList as $storeID) {
                        $amount = $importedSKU["CATALOG_STORE_AMOUNT_".$storeID];
                        $dataAmount = array("PRODUCT_ID" => $SKU_ID, "AMOUNT" => $amount, "STORE_ID" => $storeID);
                        //проверяем существование остатков по данному складу
                        $res = CCatalogStoreProduct::GetList(array(),array("PRODUCT_ID" => $SKU_ID, "STORE_ID" => $storeID));
                        //если остатки есть - обновляем, если нет - добавляем    
                        if ($arr = $res->Fetch()){
                            CCatalogStoreProduct::Update($arr["ID"], $dataAmount);
                        } else {
                            CCatalogStoreProduct::Add($dataAmount);
                        }                             
                    } 

                    $logText .= "Остатки на складе ".$storeID." у предложения [".$SKU_ID."] добавлены \n ";       

                    $arLoadProductArray["FIND_OFFER"] = $importedSKU;

                    $product["ITEMS"][] = $arLoadProductArray;

                    $newITEMS[] = $product;
                }

            }          

            $logText .= date("j.m.Y, H:i:s")."; IP: ".$_SERVER["REMOTE_ADDR"]."\n-------------------\n";    
            //пишем в файл то, что выгрузили
            $handle = fopen($logFileName, 'a');
            fwrite($handle, $logText);
            fclose($handle);     

        }  

        //общий результат выгрузки
        $logText = "Импорт завершен: ".date("j.m.Y, H:i:s")."\n-------------------\n";  
        $handle = fopen($logFileName, 'a');
        fwrite($handle, $logText);
        fclose($handle);    

        return $result;    

    }


    //unisender
    // --- add sub to unisender from subscribe form
    //AddEventHandler("subscribe", "OnBeforeSubscriptionAdd", "bottomFormSub");

    require_once ($_SERVER['DOCUMENT_ROOT'] ."/ajax/unisender/sub_function.php");         

    function bottomFormSub(&$arFields){
      //  addUnisenderSub($email); 
    }




?>