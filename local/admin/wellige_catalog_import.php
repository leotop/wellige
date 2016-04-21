<?require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");
    require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_after.php');
    $APPLICATION->SetTitle("Импорт каталога из файла");
?>
<?

    if ($_REQUEST["send_file"] == "Y" && !empty($_FILES["file"]["tmp_name"])) {

        $file = $_FILES["file"]["tmp_name"];

        if (!file_exists($file)) {
            echo "<b>Ошибка загрузки файла, попробуйте еще раз!</b>";
        } else { 
        $result = importCatalog($file);  
            if (!empty($result)) {?>
               <b>Импорт успешно завершен.</b><br>
                <p>Товаров добавлено: <b><?=$result["ITEMS_ADD"]?></b></p>     
                <p>Товаров обновлено: <b><?=$result["ITEMS_UPDATE"]?></b></p>     
                <p>Предложений добавлено: <b><?=$result["OFFERS_ADD"]?></b></p>     
                <p>Предложений обновлено: <b><?=$result["OFFERS_UPDATE"]?></b></p>     
                <?if (file_exists($_SERVER["DOCUMENT_ROOT"]."/import_log/".date("Y-m-d")."_log.txt")){?>
                <p><a href="/import_log/log.php" target="_blank">Лог выгрузки</a></p>
                <?}?>
            <?}
            else {?>
                <b>Ошибка импорта файла. Попробуйте еще раз</b>
            <?}
        }
    }

?>
<p>
    Загрузите файл в формате *.csv. <br>Если в тексте присутствует символ ";" (точка с запятой), необходимо во всем тексте заменить его на символ "@" без кавычек.<br>
    Если не заменить ";", то при парсинге файла могут возникнуть ошибки.<br>
    <br>
    Также в csv-файле нужно удалить пустые строки вначале файла и пустые столбцы слева.<br>
    Загрузка файла может занимать некоторое время, вплоть до нескольких минут.   
</p>
<form method="post" action="" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" name="submit" value="Загрузить">
    <input type="hidden" name="send_file" value="Y">
</form>  
<?require($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_admin.php");?>