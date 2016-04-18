<?  $file = $_SERVER["DOCUMENT_ROOT"]."/import_log/".date("Y-m-d")."_log.txt";
    if (file_exists($file)) {     

        $handle = fopen($file, "r");
        while (!feof($handle)) {
            $buffer = fgets($handle, 4096);
            echo $buffer."<br>";
        }
        fclose($handle);

    }   
    else {
        echo "файл лога не найден!";
    }              
?>