<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
    $IBLOCK_ID = 11;

    $el = new CIBlockElement;

    $PROP = array();
    $PROP["EMAIL"] = $_REQUEST["EMAIL"];
    $PROP["TYPE"] = $_REQUEST["TYPE"];
    
    $TEXT = "Запрос подробностей о сотрудничестве";
   
    $formTypes = array();
    $enums = CIBlockProperty::GetPropertyEnum("TYPE",Array(),Array("IBLOCK_ID"=>$IBLOCK_ID));
    while($arEnum = $enums->Fetch()) {
      $formTypes[$arEnum["ID"]] = $arEnum["VALUE"];  
    }             

    $arLoadProductArray = Array(
        "IBLOCK_SECTION_ID" => false,          
        "IBLOCK_ID"      => $IBLOCK_ID,
        "PROPERTY_VALUES"=> $PROP,
        "NAME"           => $_REQUEST["EMAIL"],
        "ACTIVE"         => "Y",   
        "PREVIEW_TEXT"   => $TEXT      
    );

    if($ID = $el->Add($arLoadProductArray)) { 
        $result = array("error"=>0);
        //send message for user and admin 
        $emailFields = array(
            "NAME"=>$arLoadProductArray["NAME"],
            "EMAIL"=>$arLoadProductArray["PROPERTY_VALUES"]["EMAIL"],
            "TYPE"=>$formTypes[$arLoadProductArray["PROPERTY_VALUES"]["TYPE"]],
            "TEXT"=>$TEXT
        );
        CEvent::Send("FORM_SEND","s1",$emailFields,"Y");
    }
    else {
        $result = array("error"=>1);;
    }            

    $result = json_encode($result); 
    echo $result;

?>