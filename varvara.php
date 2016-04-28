<?php

/*---CONFIG---*/
$maskfiles=array('.php','.htm','.tpl','.txt','.inc','.js'); //файлы, включающие эти слова идут в поиск
$minsearch=2; //минимальное количество символов для поиска
$maxfilesize=500*1024; //Максимальный размер файла (в байтах) по умолчанию: 500кб
$db_host='localhost';
$db_user='root';
$db_pass='mysql';
/*---/CONFIG---*/




ini_set ( 'display_errors', 'Off' );
error_reporting(0);
ini_set("max_execution_time", "0");

header('Content-Type: text/html; charset=utf-8'); 

$text = '';
if (isset ( $_REQUEST ['text'] ))
	$text = $_REQUEST ['text'];
$text=str_replace('\"','"',$text);
$text=str_replace("\'","'",$text);
$atext=str_replace('"','&quot;',$text);

$slow = '';
if (isset ( $_REQUEST ['slow'] ))
	$slow = $_REQUEST ['slow'];
$enc = '';
if (isset ( $_REQUEST ['enc'] ))
	$enc = $_REQUEST ['enc'];
$mask = '';
if (isset ( $_REQUEST ['mask'] ))
	$mask = $_REQUEST ['mask'];
$strip = '';
if (isset ( $_REQUEST ['strip'] ))
	$strip = $_REQUEST ['strip'];
if (isset ( $_REQUEST ['masks'] ))
	$maskfiles = explode(";",$_REQUEST ['masks']);
$dir = '';
if (isset ( $_REQUEST ['dir'] ))
	$dir = $_REQUEST ['dir'];
$where = '';
if (isset ( $_REQUEST ['where'] ))
	$where = $_REQUEST ['where'];
		
$matches = 0;
global $matches,$slow,$enc,$mask,$maskfiles,$maxfilesize,$db_host,$db_user,$db_pass;
?>
<html>
<head>
<title>VaRVaRa Searcher</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<style type="text/css">
body {
	text-size: 10px;
	padding: 5px;
}

.searchdiv {
	border: 1px solid black;
	padding: 5px;
	margin: 5px;
}

.founddiv {
	border: 1px solid black;
	padding: 5px;
	margin: 1px;
	background-color: #EEEEEE;
	color: black;
}

.sqldiv {
	border: 1px solid black;
	padding: 5px;
	margin: 5px;
	background-color: #AAFFAA;
	color: black;
}
</style>
</head>
<body>
<div class="searchdiv">
<form action="" method="get">What are you like, Master?: <input
	type="text" name="text"
	value="<?php
	echo $atext;
	?>" size="100"> <input type="submit" value="Go!"> <br> 
	<input type="checkbox" name="slow" value="1" <?php if ($slow) echo "checked"; ?>>Размытый поиск(медленно)
	<input type="checkbox" name="enc" value="1" <?php if ($enc) echo "checked"; ?>>CP1251
	<input type="checkbox" name="mask" value="1" <?php if ($mask || !isset($_REQUEST['text'])) echo "checked"; ?>>Маска
	<input type="text" name="masks" value="<?php echo implode(";",$maskfiles); ?>">
	<input type="checkbox" name="strip" value="1" <?php if ($strip) echo "checked"; ?>>Срезать теги в SQL
<br>
	Путь поиска<input type="text" name="dir" size="60" value="<?php if($dir) echo $dir; else { $mainpath=pathinfo($_SERVER['SCRIPT_FILENAME']); echo $mainpath['dirname']; } ?>">
	<input type="radio" name="where" value="name" <?php if($where=="name") echo "checked";?>>Имя файла</option>
	<input type="radio" name="where" value="file" <?php if(!isset($_REQUEST['where']) || $where=="file") echo "checked";?>>Внутри файла</option>
	<input type="radio" name="where" value="sql" <?php if($where=="sql") echo "checked";?>>SQL</option>
	</select>
	</form>
</div>
<?php
if (strlen ( $text ) >= $minsearch) {
		echo "Founded in:<br>";
	if($where=="file")
	{
		$time=microtime();
		
		//$masks=str_replace(".","",implode(",",));
		$masks="";
		if($mask)
			foreach($maskfiles as $msk)
				if(trim($msk)!="")
					$masks.=" --include=*.".str_replace(".","",$msk);
		$comm="grep -rlI $masks ".escapeshellarg($text)." $dir 2>/dev/null";
		//echo $comm;
		$outp=wsoEx($comm);
		//print_r($outp);
		if($outp!=-1)
		{
			foreach ( $outp as $addr )
				if(trim($addr)!='')
					search_in_file ( $addr, $text );
		}
		else
		{
			echo "&gt;&gt;normal";//exit();
			$files = search_files ( $dir );
			if ($slow)
				$text = trimpage ( $text );
			foreach ( $files as $addr )
				if(trim($addr)!='')
					search_in_file ( $addr, $text );
		}
		echo "Matches: " . $matches . "<br>";
		if(isset($files))
			echo "Scanned Files: " . count ( $files ) . "<br>";
		echo (microtime()-$time)."<br>";
	}
	if($where=="sql")
	{
		sql_search($text);
	}
	if($where=="name")
	{
		$files = search_files ( $dir );
		foreach ( $files as $addr )
			if(trim($addr)!='')
				if(strpos(strtolower($addr), strtolower($text))!==false)
				{
					echo '<div class="founddiv">' . $addr . '</div>';
					$matches ++;
				}
		echo "Matches: " . $matches . "<br>";
		echo "Scanned Files: " . count ( $files ) . "<br>";
	}
}

function wsoEx($in) {
	$out = '';
	if (function_exists('exec')) {
		@exec($in,$out);
		//$out = @join("\n",$out);
		echo "&gt;&gt;exec";
	} elseif (function_exists('passthru')) {
		ob_start();
		@passthru($in);
		$out = ob_get_clean();
		$out=explode("\n",$out);
		echo "&gt;&gt;passthru";
	} elseif (function_exists('system')) {
		ob_start();
		@system($in);
		$out = ob_get_clean();
		$out=explode("\n",$out);
		echo "&gt;&gt;system";
	} elseif (function_exists('shell_exec')) {
		$out = shell_exec($in);
		$out=explode("\n",$out);
		echo "&gt;&gt;shell_exec";
	} elseif (is_resource($f = @popen($in,"r"))) {
		$out = "";
		while(!@feof($f))
			$out .= fread($f,1024);
		pclose($f);
		$out=explode("\n",$out);
		echo "&gt;&gt;popen";
	}
	else return -1;
	
	return $out;
}


function sql_search($text)
{
	global $db_host,$db_user,$db_pass,$slow,$strip;
	$link=mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	if($link)
	{
		$q=mysql_query("SET NAMES UTF8",$link);
		$q=mysql_query("SHOW DATABASES",$link);
		$databases=array();
		while($tmp=mysql_fetch_array($q)){ if($tmp[0]!='information_schema') $databases[]=$tmp[0]; }
		foreach($databases as $db)
		{
			//echo "Search In: ".$db."<br>";
			$q=mysql_query("USE `".$db."`",$link);
			$q=mysql_query("SHOW TABLES");
			$tables=array();
			while($tmp=mysql_fetch_array($q)){ $tables[]=$tmp[0]; }
			foreach($tables as $table)
			{
				//echo "Table: ".$table."<br>";	
				$q=mysql_query("DESCRIBE ".$table);
				$fields=array();
				if($slow)
					while($tmp=mysql_fetch_array($q)){ $fields[]=$tmp[0]; }
				else
					while($tmp=mysql_fetch_array($q)){ if(strpos($tmp[1],"char")!==false || strpos($tmp[1],"text")!==false) $fields[]=$tmp[0]; }
				//foreach($fields as $field)
				//{
					//$q=mysql_query("SELECT * FROM `".$table."` WHERE `".$field."` LIKE '%".$text."%'");
					$fld="";
					foreach($fields as $field)
						$fld.="`".$field."` LIKE '%".$text."%' OR ";
					$q=mysql_query("SELECT * FROM `".$table."` WHERE $fld 1=0");
					$results=array();
					while($tmp=mysql_fetch_assoc($q)){ $results[]=$tmp; }
					if(count($results)>0)
					{
						echo '<div class="sqldiv">';
						echo "<font color='blue'>Founded In: DB(".$db.")->Table(".$table.")->Field(".$field.")</font><br>";
						echo '<table border="1"><tr>';
						foreach($results[0] as $f=>$k)
						{
							echo "<td>".$f."</td>";
						}
						echo "</tr>";						
						foreach ($results as $result)
						{
							echo '<tr valign="top">';
							foreach($result as $f=>$k)
								if($strip)
									echo "<td>".htmlspecialchars($k)."</td>";
								else
									echo "<td>".$k.$strip."</td>";
							echo "</tr>\n";
						}
						echo "</table></div>";
						flush();
					}
				//}
			}
		}
	}
}

function trimpage($page) {
	$page = trim ( $page );
	$page = str_replace ( "\n", "", $page );
	$page = str_replace ( "\r", "", $page );
	$npage = str_replace ( "  ", " ", $page );
	while ( $npage != $page ) {
		$page = $npage;
		$npage = str_replace ( "  ", " ", $page );
	}
	return $page;
}

function regexp($text) {
	$subj = str_replace ( " ", ' *', $text );
	$subj = "%" . $subj . "%siU";
	return $subj;
}

function search_in_file($path, $subj) {
	global $matches,$slow,$enc;
	$file = file_get_contents ( $path );
	if($enc)
		$file = enc_text_to_utf($file);
	if($slow)
	{
		$file = trimpage ( $file );
		$file=mb_convert_case($file, MB_CASE_LOWER);
		$subj=mb_convert_case($subj, MB_CASE_LOWER);
	}
	if (strpos ( $file, $subj ) !== false) {
		$add="";
		$pl="";
		$f=fopen($path,"r");
		while($l=fgets($f))
		{
			if($enc)
				$l = enc_text_to_utf($l);
			$x = strpos ( $l, $subj );
			if($x !== false)
			{
				if($x>100) $x=$x-100;
				else $x=0;
				$pl=substr($pl,0,200);
				$l=substr($l,$x,200);
				$l=htmlspecialchars($pl)."<br>".htmlspecialchars($l);
				$l=str_replace($subj,"<font color='red'>".$subj."</font>",$l);
				$add.='<div class="sqldiv">' . $l. '</div>';
			}
			$pl=$l;
		}
		fclose($f);
		echo '<div class="founddiv">' . $path . $add. '</div>';
		$matches ++;
		flush();
	}
}

function enc_text_to_utf($text){
	$text=@iconv("WINDOWS-1251","UTF-8",$text);
	return $text;
}

function search_files($path) {
	global $mask,$maskfiles,$maxfilesize;
	$result = array ();
	if (!is_dir($path))
	{
		if($mask)
		{
			$skip=true;
			foreach($maskfiles as $msk)
				if(strpos(strtolower($path),strtolower($msk))!==false)
					$skip=false;
			if(!$skip && filesize($path)<=$maxfilesize)
				return $path;
		}
		else
			if(filesize($path)<=$maxfilesize)
				return $path;
	}
	else
	{
		$dir = @dir ( $path );
		while ( false !== ($entry = $dir->read ()) )
			if ($entry != "." && $entry != "..")
			{
				$entry = search_files ( $path . '/' . $entry );
				if (is_array ( $entry ))
					$result = array_merge ( $result, $entry );
				else
					$result [] = $entry;
			}
	}
	flush();
	return $result;
}
?>
</body>
</html>
