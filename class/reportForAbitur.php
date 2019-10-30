<?php session_start();
class reportForAbitur{
	function rprtForAbit(){
		include_once("get_string.php");
		include_once("get_function.php");
		$title = new get_String_Form();
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		//echo $ip;
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3232235520)){
		$obj = new get_function();
		$obj->config();
		echo '<table class="table" width="100%"><thead>';
		echo '<tr><th><p>'; echo $title->getStringForm('svod'); echo '</p>';
		echo '</th><th><p>'; echo $title->getStringForm('prot_dop'); echo '</p>';
		echo '</th></tr></thead><tbody>';
		echo '<td width="50%">';
		echo '<form action="excel_svod.php" method="GET"><select name="otdl">'; $this->otdelenie();
		echo '</select><br><input type="submit" class="btn" value="'; 
		echo $title->getStringForm('create_rpt'); echo '"></form>';		
		echo '</td>';
		echo '<td>';
		echo '<form action="excel_protocol.php" method="GET"><input type="text" name="num_pr" placeholder="'; 
		echo $title->getStringForm('num_of_prot'); echo '"><br><input type="submit" class="btn" value="'; 
		echo $title->getStringForm('create_rpt'); echo '">';
		echo '</form>';
		echo '</td>';
		
		echo '</tr>';
		echo '<tr><td><a href="class/copyDocument.php" target="_blank"> Копии документов </a></td><td></td></tr>';
		echo '<tr><td><a href="excel_original.php" target="_blank"> Оригиналы документов </a></td><td></td></tr>';
		echo '<tr><td><a href="excel_orig_all.php" target="_blank"> Оригиналы + копии </a></td><td></td></tr>';
		echo '<tr><td><a href="allAbitur.php" target="_blank"> Список всех абитуриентов </a></td><td></td></tr>';
		echo '<tr><td><a href="secr_stat.php" target="_blank"> Статистика секретарей </a></td><td></td></tr>';
		echo '<tr><td><a href="excel_svod_short.php" target="_blank"> Количество поданных заявлений </a></td><td></td></tr>';

		echo '<tr><td>&nbsp;</td><td></td><tr>';
		if ($_SESSION['nnname'] != 'zaharov') {	
		echo '<tr><td><a href="boldyr_f.php" target="_blank"> Таблица </a></td><td></td></tr>';
		//echo '<tr><td><a href="boldyr.php" target="_blank"> Таблица шаблон </a></td><td></td></tr>';
		}
		
		echo '<tr><td><a href="forma.php" target="_blank">Форма предоставления данных о результатах приемной компании</a></td><td></td></tr>';
		//echo '<tr><td><a href="forma1.php" target="_blank">Приказ № 313 Форма 1</a></td><td></td><tr>';
		//echo '<tr><td><a href="forma2.php" target="_blank">Приказ № 313 Форма 2</a></td><td></td><tr>';
		//echo '<tr><td><a href="boldyr_o.php" target="_blank"> Таблица (русский, математика, общество)</a></td><td></td><tr>';
		//echo '<tr><td><a href="boldyr_l.php" target="_blank"> Таблица (русский, литература)</a></td><td></td><tr>';
		//echo '<tr><td><a href="boldyr_m.php" target="_blank"> Таблица (русский, математика)</a></td><td></td><tr>';
		echo '<tr><td><a href="vipiska_1.php" target="_blank">Выписка из приказа (очники)</a></td><td></td></tr>';
		echo '<tr><td><a href="vipiska_2.php" target="_blank">Выписка из приказа (заочники)</a></td><td></td></tr>';
		echo '<tr><td><a href="vipiska_4.php" target="_blank">Выписка из приказа (Магистратура)</a></td><td></td></tr>';
		echo '</tbody></table>';
		//echo date("F j, Y, g:i a");
}
	else {
				echo $title->getStringForm('close');}
	}
	
/*++++++++++++++++++++++++++++++++++

TABLE -  otdelenie

+++++++++++++++++++++++++++++++++++*/	
	function otdelenie()
	{
		$obr = "SELECT id, FORMAOBUCH FROM FORMAOBUCH ORDER BY id";	
		$res_obr = mysql_query($obr);
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["id"]."'>");
        	printf ($row["FORMAOBUCH"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
}
	
?>