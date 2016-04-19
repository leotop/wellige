<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
    $IBLOCK_ID = 11;

    $el = new CIBlockElement;

    $PROP = array();
    $PROP["EMAIL"] = $_REQUEST["EMAIL"];
    $PROP["TYPE"] = $_REQUEST["TYPE"];
    
    if (!$_REQUEST["PHONE"]) {$_REQUEST["PHONE"] = "не указан";}
    if (!$_REQUEST["COMPANY"]) {$_REQUEST["COMPANY"] = "не указана";}
    
    $TEXT = "Телефон: ".$_REQUEST["PHONE"]."; "." Компания: ".$_REQUEST["COMPANY"].". ".$_REQUEST["MESSAGE"];

    $formTypes = array();
    $enums = CIBlockProperty::GetPropertyEnum("TYPE",Array(),Array("IBLOCK_ID"=>$IBLOCK_ID));
    while($arEnum = $enums->Fetch()) {
      $formTypes[$arEnum["ID"]] = $arEnum["VALUE"];  
    }


    $arLoadProductArray = Array(
        "IBLOCK_SECTION_ID" => false,          
        "IBLOCK_ID"      => $IBLOCK_ID,
        "PROPERTY_VALUES"=> $PROP,
        "NAME"           => $_REQUEST["NAME"],
        "ACTIVE"         => "Y",            
        "PREVIEW_TEXT"   => $TEXT,         
    );

    if($ID = $el->Add($arLoadProductArray)) { 
        $TEXT = "Телефон: ".$_REQUEST["PHONE"]."<br>"." Компания: ".$_REQUEST["COMPANY"]."<br>".$_REQUEST["MESSAGE"];
        $result = array("error"=>0);
        //send message for user and admin 
        $emailFields = array(
            "NAME"=>$arLoadProductArray["NAME"],
            "EMAIL"=>$arLoadProductArray["PROPERTY_VALUES"]["EMAIL"],
            "TEXT"=>$TEXT,
            "TYPE"=>$formTypes[$arLoadProductArray["PROPERTY_VALUES"]["TYPE"]]
        );
        CEvent::Send("FORM_SEND","s1",$emailFields,"Y");
    }
    else {
        $result = array("error"=>1);;
    }            

    $result = json_encode($result); 
    echo $result;

?>