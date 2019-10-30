<img src="file:///F|/abitur2013_112/css/img/ok.jpg" width="16" height="16" />
<?php session_start();
include_once("get_string.php");
include_once("get_function.php");
class checkDataAbitur{
	function formaDataAbitur(){
		$obj = new get_function();
		$txt = new get_String_Form();
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		//echo $ip;
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3232235520)){
		echo '<table class="table" width="250"><thead>';
		echo '<tr><th><p>'; echo $txt->getStringForm('fio_abit'); echo '</p>';
		echo '</th></tr></thead><tbody><tr><td>';
		$obj->config();	
		echo '<form action="index.php?pages=23&cl=24" method="GET" class="form-inline">';
		echo '<input type="hidden" name="pages" value="23">';
		echo '<input type="hidden" name="cl" value="24">';		
		echo '<input name="fio" list="fiolist" type="text" placeholder="'; echo $txt->getStringForm('fio_abitur'); echo '"><datalist id="fiolist" >'; $this->fio_abitur(); echo' </datalist>';
		echo '&nbsp;<input type="submit" class="btn" value="Открыть карточку">';
		echo '</form></td>';
		echo '</tr></tbody></table>';	
		}
	
	else {
		echo $txt->getStringForm('close');
		}
	}
	function proverZhurnAbit($abit){
		$obj = new get_function();
		$txt = new get_String_Form();
		$obj->config();
		//echo $txt->getStringForm('abit');
		$obr = "SELECT DISTINCT INFO.fam, INFO.name, INFO.otch, INFO.pasport_ser, INFO.pasport_nom, INFO.ID, INFO.to_edit FROM INFO WHERE CONCAT(INFO.fam, ' ', INFO.name, ' ', INFO.otch) = '".$abit."'"; 
		$res_obr = mysql_query($obr);
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
		$ab_f = $row["fam"]." ".$row["name"]." ".$row["otch"];
		$ab_id = $row["ID"];
		//echo '<br>';
		echo '<table border="0" width="100%"><tr><td>';
		echo $txt->getStringForm('abit');
		echo '<span class="text-info">'.$ab_id.' - '.$ab_f.'</span>';
		echo '</td><td width="13%"><a href="class/dell_anket_data.php?id='.$ab_id.'&abit='.$abit.'">Удалить анкету</a></td><td width="18%">Парспорт: <b>'.$row["pasport_ser"].' '.$row["pasport_nom"].'</b></td><td width="2%">';
		if ($row["to_edit"] == 1){
			echo '<img src="css/img/ok.jpg">';
			}
		echo '</td><td width="8%"><a href="class/save_to_edit.php?id_inf='.$row["ID"].'&abit='.$abit.'">No Edit</a>';
		echo '</td></tr></table>';
		
		echo '<table class="table table-bordered"><thead><tr>';
		echo '<th>Абитур.</th>';
		echo '<th>Направ.</th>';
		echo '<th>Протокол</th>';
		echo '<th>Дата подачи</th>';
		echo '<th>Контракт</th>';
		echo '<th>Признак док.</th>';
		echo '<th>Льгота</th>';
		echo '<th>Дата собес.</th>';
		echo '<th>Логин</th>';
		echo '<th>Действие</th></tr></thead><tbody>';
		$sql_st = "SELECT ZHURNAL.IDstud, ZHURNAL.ID_zh, ZHURNAL.priznak_vozvrata, ZHURNAL.dat_sob, ZHURNAL.priority, ZHURNAL.ekzam, FORMAOBUCH.leter, ZHURNAL.Protokol, ZHURNAL.Date_podachi, ZHURNAL.Nomer_po_zhurn, SPEC.KratkoeName, KONTRAKT.KONTRAKT, PRIZNAKDOC.PRIZNAKDOC, LGOTAVNEKONK.LGOTAVNEKONK, ZHURNAL.fio_emploeyee, ZHURNAL.Priznak_doc FROM SPEC INNER JOIN ZHURNAL ON SPEC.ID = ZHURNAL.Special INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie INNER JOIN KONTRAKT ON KONTRAKT.ID = ZHURNAL.Kontrakt INNER JOIN PRIZNAKDOC ON PRIZNAKDOC.ID = ZHURNAL.Priznak_doc INNER JOIN LGOTAVNEKONK ON LGOTAVNEKONK.ID = ZHURNAL.lgot_vne WHERE ZHURNAL.IDstud = ".$ab_id." AND ZHURNAL.priznak_vozvrata is NULL ORDER BY ZHURNAL.priority";
		$res_st = mysql_query($sql_st);
		$i = 1;
		while ($row_st = mysql_fetch_array($res_st, MYSQL_ASSOC)) 
		
		{
			echo '<form action="class/save_anket_data.php" method="get">';
			echo '<tr><td><input name="id_st_'.$i.'" type="text" class="input-small" value="'.$row_st["IDstud"].'">';
			echo '<input type="hidden" name="id_zh_'.$i.'" value="'.$row_st["ID_zh"].'">';
			echo '<input type="hidden" name="fl" value="'.$i.'">';
			echo '<input type="hidden" name="fio" value="'.$_GET["fio"].'">';
			echo '</td><td>'.$row_st["Nomer_po_zhurn"].'-'.$row_st["KratkoeName"].'/'.$row_st["leter"].'</td>';
			echo '<td>'.$row_st["Protokol"].'</td>';
			echo '<td>'.$row_st["Date_podachi"].'</td>';
			echo '<td>'.$row_st["KONTRAKT"].'</td>';
			//echo '<td>'.$row_st["PRIZNAKDOC"].'</td>';
			echo '<td><select class="input-small" name="priz_d_'.$i.'">'; $obj->priznak_selected($row_st["Priznak_doc"]); echo'</select></td>';
			echo '<td>'.$row_st["LGOTAVNEKONK"].'</td>';
			echo '<td><input name="dat_sob_'.$i.'" type="text" class="input-small" value="'.$row_st["dat_sob"].'">';
			echo '<select name="exzam_'.$i.'" class="input-small">'; $obj->mesto($row_st["ekzam"]); echo '</select></td>';
			echo '<td>'.$row_st["fio_emploeyee"].'</td>';
			echo '<td><input type="image" src="css/img/save.png" action="class/save_anket_data.php"></td></tr>';
			$i=$i+1;
			echo '</form>';
		}
		echo '</tbody></table>';
		//echo '2 - ЕГЭ, 3 - Собеседование, 4 - Тестирование';
		
		}
		
		}
	function saveZhurnalChangeID1($id_zh, $id_st, $fio){
		$this->config();
		$obr = "UPDATE ZHURNAL SET IDstud='".$id_st."' WHERE ID_zh='".$id_zh."'";	
		$res_obr = mysql_query($obr);
		mysql_close($dbcnx);
		header('Location: index.php?pages=23&cl=24&fio='.$fio);
			
	}
	
	function fio_abitur(){
		
		$obr = "SELECT DISTINCT INFO.fam, INFO.name, INFO.otch FROM INFO ORDER BY INFO.fam";	
		$res_obr = mysql_query($obr);
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='");
			printf ($row["fam"]." ".$row["name"]." ".$row["otch"]);
			printf("'/>");
			
		}
		mysql_free_result($res_obr);
		}
		

	
	function config()
	{
		$dblocation = "192.168.5.112";
		$dbname = "Abitur";
		$dbuser = "asu";
		$dbpassword = "5Y7jwSzL2DyEAApt";
		
		$dbcnx = @mysql_connect($dblocation, $dbuser, $dbpassword);
		mysql_select_db($dbname, $dbcnx);
		
		@mysql_query("SET NAMES 'utf8'");
	}
}
?>