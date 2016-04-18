<?require_once ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");?>

<?  
   require_once("sub_function.php");
   addUnisenderSub($_POST['sub_mail'],$_POST['sub_tags'],$_POST['sub_name']);
?>