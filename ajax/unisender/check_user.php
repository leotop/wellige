<?require_once ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");?>

<?
    require_once("unisender_api.php");
    
        $apikey="5bq7c5dewkn6a7we4i3ws9bssioe1d3hre44nppe";
        $uni=new UniSenderApi($apikey); 
        $result = $uni->checkUserExists(Array("email"=>"aid-s1@mail.ru"));
        $answer = json_decode($result,true);
        arshow($answer);

?>