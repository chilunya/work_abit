<?php session_start();
include_once("get_string.php");
include_once("get_function.php");
class vazvratAbiturOriginal{
	function formaDataAbitur(){
		
		$txt = new get_String_Form();
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		//echo $ip;
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3232235520)){
		echo '<div class="alert">'; echo $txt->getStringForm("forma10"); echo '</div>';
		
		echo '<table class="table" width="250"><thead>';
		echo '<tr><th><p>'; echo $txt->getStringForm('dat_vozv'); echo '</p>';
		echo '</th></tr></thead><tbody><tr><td>';
			
		echo '<form action="index.php" method="GET" class="form-inline">';
		echo '<input type="hidden" name="pages" value="18"><input type="hidden" name="cl" value="19">';	
		echo '<input type="text" id="datepicker_orig" name="vozv_date">&nbsp;<label class="checkbox"><input type="checkbox" name="all">'; 
		echo $txt->getStringForm('pr_all'); echo '</label><br><br>';	
		echo '<input type="submit" action="index.php?pages=18&cl=19" class="btn" value="'; 
		echo $txt->getStringForm('show'); echo '">';
		echo '</form></td>';
		echo '</tr></tbody></table>';	
			
		
		}
	else {
		echo $txt->getStringForm('close');
		}
	}
	
	function datAbiturVozvrat($dt){
		$obj = new get_function();
		$obj->config();
		//$this->config();
		$dat_ch = str_replace(".", "-", $dt);
		$obr = "SELECT INFO.fam, INFO.name, INFO.otch, ZHURNAL.Date_podachi, ZHURNAL.IDstud, ZHURNAL.Nomer_po_zhurn, SPEC.KratkoeName, FORMAOBUCH.leter, PRIZNAKDOC.PRIZNAKDOC, INFO.bal1, INFO.bal2, INFO.bal3, INFO.bal4, INFO.bal5, ZHURNAL.Priznak_doc, ZHURNAL.date_vozvrata, ZHURNAL.priznak_vozvrata, ZHURNAL.Otdelenie, ZHURNAL.employee_vozvrata FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie INNER JOIN PRIZNAKDOC ON PRIZNAKDOC.ID = ZHURNAL.Priznak_doc WHERE ZHURNAL.Otdelenie = 1 AND ZHURNAL.Priznak_doc = 1 AND ZHURNAL.priznak_vozvrata = 1 AND ZHURNAL.date_vozvrata LIKE '".$dat_ch."%' ORDER BY ZHURNAL.date_vozvrata";	
		echo '<p style="color:red;">Красным отмечены абитуриенты переложившие оригиналы документов на другое направление!</p>';
		echo '<table class="table table-bordered">';
		echo '<thead><tr>';
      	echo '<th rowspan="2">№п/п </th>';
      	echo '<th rowspan="2">ФИО абитуриента </th>';
      	echo '<th rowspan="2">Номер дела </th>';
      	echo '<th rowspan="2">Дата возврата док. </th>';
      	echo '<th rowspan="2">Причина удаления </th>';
      	echo '<th colspan="5">Балл ЕГЭ </th>';
      	echo '<th rowspan="2">Логин </th>';
   		echo '</tr><tr>';
      	echo '<th>Р</th>';
      	echo '<th>М</th>';
      	echo '<th>Ф</th>';
      	echo '<th>О</th>';
     	echo '<th>Л</th>';
    	echo '</tr></thead>';
		
		 $i=1;
		
		$res_obr = mysql_query($obr);  
		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{ 
	
	  	
			printf("<tr>");
			printf("<td>".$i."</td>");
			$sql="SELECT ZHURNAL.IDstud, ZHURNAL.Priznak_doc FROM ZHURNAL WHERE ZHURNAL.Priznak_doc = 1 AND ZHURNAL.IDstud = ".$row["IDstud"]." AND ZHURNAL.priznak_vozvrata is null";
			$res_sql = mysql_query($sql);  
			$row_sql = mysql_fetch_array($res_sql, MYSQL_ASSOC);
			if ($row_sql) {
			printf("<td style='color:red;'>".$row["fam"]." ".$row["name"]." ".$row["otch"]."</td>");
			}
			else {
			printf("<td>".$row["fam"]." ".$row["name"]." ".$row["otch"]."</td>");	
			}
			printf("<td>".$row["Nomer_po_zhurn"]."-".$row["KratkoeName"]."/".$row["leter"]."</td>");
			printf("<td>".$row["date_vozvrata"]."</td>");
			switch($row["priznak_vozvrata"]){
				case 1:
				$whdll = "Возврат документов";
				break;
				case 2:
				$whdll = "Неверно внесены данные";
				break;
			}
			printf("<td>".$whdll."</td>");
			printf("<td>".$row["bal1"]."</td>");
			printf("<td>".$row["bal2"]."</td>");
			printf("<td>".$row["bal3"]."</td>");
			printf("<td>".$row["bal4"]."</td>");
			printf("<td>".$row["bal5"]."</td>");
			printf("<td>".$row["fio_sess"]."</td></tr>");
			$i++;
			
		}
		
		echo '</tbody></table>';
		mysql_free_result($res_obr);

	}

	function allAbiturVozvrat($all){
		$obj = new get_function();
		$obj->config();
		$obr = "SELECT INFO.fam, INFO.name, INFO.otch, ZHURNAL.Date_podachi, ZHURNAL.IDstud, ZHURNAL.Nomer_po_zhurn, SPEC.KratkoeName, FORMAOBUCH.leter, PRIZNAKDOC.PRIZNAKDOC, INFO.bal1, INFO.bal2, INFO.bal3, INFO.bal4, INFO.bal5, ZHURNAL.Priznak_doc, ZHURNAL.date_vozvrata, ZHURNAL.priznak_vozvrata, ZHURNAL.Otdelenie, ZHURNAL.employee_vozvrata FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie INNER JOIN PRIZNAKDOC ON PRIZNAKDOC.ID = ZHURNAL.Priznak_doc WHERE ZHURNAL.Otdelenie = 1 AND ZHURNAL.Priznak_doc = 1 AND ZHURNAL.priznak_vozvrata = 1 ORDER BY ZHURNAL.date_vozvrata";	
		//echo $obr;
		echo '<p style="color:red;">Красным отмечены абитуриенты переложившие оригиналы документов на другое направление!</p>';
		echo '<table class="table table-bordered">';
				echo '<thead><tr>';
      	echo '<th rowspan="2">№п/п </th>';
      	echo '<th rowspan="2">ФИО абитуриента </th>';
      	echo '<th rowspan="2">Номер дела </th>';
      	echo '<th rowspan="2">Дата возврата док. </th>';
      	echo '<th rowspan="2">Причина удаления </th>';
      	echo '<th colspan="5">Балл ЕГЭ </th>';
      	echo '<th rowspan="2">Логин </th>';
   		echo '</tr><tr>';
      	echo '<th>Р</th>';
      	echo '<th>М</th>';
      	echo '<th>Ф</th>';
      	echo '<th>О</th>';
     	echo '<th>Л</th>';
    	echo '</tr></thead>';
		 $i=1;
		
		$res_obr = mysql_query($obr);  
		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{ 
	
	  	
			printf("<tr>");
			printf("<td>".$i."</td>");
			$sql="SELECT ZHURNAL.IDstud, ZHURNAL.Priznak_doc FROM ZHURNAL WHERE ZHURNAL.Priznak_doc = 1 AND ZHURNAL.IDstud = ".$row["IDstud"]." AND ZHURNAL.priznak_vozvrata is null";
			$res_sql = mysql_query($sql);  
			$row_sql = mysql_fetch_array($res_sql, MYSQL_ASSOC);
			if ($row_sql) {
			printf("<td style='color:red;'>".$row["fam"]." ".$row["name"]." ".$row["otch"]."</td>");
			}
			else {
			printf("<td>".$row["fam"]." ".$row["name"]." ".$row["otch"]."</td>");	
			}
			printf("<td>".$row["Nomer_po_zhurn"]."-".$row["KratkoeName"]."/".$row["leter"]."</td>");
			printf("<td>".$row["date_vozvrata"]."</td>");
			switch($row["priznak_vozvrata"]){
				case 1:
				$whdll = "Возврат документов";
				break;
				case 2:
				$whdll = "Неверно внесены данные";
				break;
			}
			printf("<td>".$whdll."</td>");
			printf("<td>".$row["bal1"]."</td>");
			printf("<td>".$row["bal2"]."</td>");
			printf("<td>".$row["bal3"]."</td>");
			printf("<td>".$row["bal4"]."</td>");
			printf("<td>".$row["bal5"]."</td>");
			printf("<td>".$row["employee_vozvrata"]."</td></tr>");
			$i++;
			
		}
		
		echo '</tbody></table>';
		mysql_free_result($res_obr);
		
		
	}

}
?>