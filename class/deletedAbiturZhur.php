<?php session_start();
include_once("get_string.php");
include_once("get_function.php");
class deletedAbiturZhur{
	function formaDataAbitur(){
		$obj = new get_function();
		$txt = new get_String_Form();
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		//echo $ip;
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3232235520)){
		echo '<div class="alert">'; echo $txt->getStringForm("forma10"); echo '</div>';
		
		echo '<table class="table" width="250"><thead>';
		echo '<tr><th><p>'; echo $txt->getStringForm('dat_change'); echo '</p></th>';
		//echo '<th><p>Фамилия абитуриента</p></th>';
		echo '<th><p>'; echo $txt->getStringForm('type_change'); echo '</p>';
		echo '</th></tr></thead><tbody><tr><td>';
			
		echo '<form action="index.php" method="GET" class="form-inline">';
		echo '<input type="hidden" name="pages" value="21"><input type="hidden" name="cl" value="22">';	
		echo '<input type="text" id="datepicker_orig" name="change_date">&nbsp;<label class="checkbox"><input type="checkbox" name="all">'; 
		echo $txt->getStringForm('pr_all'); echo '</label><br><br>';	
		echo '<input type="submit" action="index.php?pages=21&cl=22" class="btn" value="'; 
		echo $txt->getStringForm('show'); echo '">';
		echo '</td>';
		//echo '<td><input type="text" name="fio_dell" placeholder="Фамилия"></td>';

		echo '<td><select name="sort_type_change">';
		$obj->why_dell_zh();
		echo '</select>';
		
		
		echo '</form></td>';
		echo '</tr></tbody></table>';	
			
		
		}
	else {
		echo $txt->getStringForm('close');
		}
	}
	
	function datAbiturDel($dt, $lgt){
		$obj = new get_function();
		$txt = new get_String_Form();
		$obj->config();
		$res_obr = $obj->view_deleted_zhurnal($dt, $lgt);
		echo '<table class="table table-bordered"><thead>';
		echo '<tr><th>'; echo $txt->getStringForm('nn'); 
		echo '</th><th>'; echo $txt->getStringForm('fio_abit'); 
		echo '</th><th>'; echo $txt->getStringForm('kr_spec');  
		echo '</th><th>'; echo $txt->getStringForm('pr_doc'); 
		echo '</th><th>'; echo $txt->getStringForm('lgt');
		echo '</th><th>'; echo $txt->getStringForm('kont');
		echo '</th><th>'; echo $txt->getStringForm('dat_dell');
		echo '</th><th>'; echo $txt->getStringForm('why_dell'); 
		echo '</th><th>'; echo $txt->getStringForm('log'); 
		echo '</th></tr></thead><tbody>';
		$i=1;
		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{ 
			printf("<tr>");
			printf("<td>".$i."</td>");
			printf("<td>".$row["fam"]." ".$row["name"]." ".$row["otch"]."</td>");	
			printf("<td>".$row["Nomer_po_zhurn"]."-".$row["KratkoeName"]."/".$row["leter"]."</td>");
			printf("<td>".$row["PRIZNAKDOC"]."</td>");
			printf("<td>".$row["LGOTAVNEKONK"]."</td>");
			printf("<td>".$row["KONTRAKT"]."</td>");
			printf("<td>".$row["date_vozvrata"]."</td>");
			switch ($row["priznak_vozvrata"]){
				case 1:
				$whdll = "Возврат документов";
				break;
				case 2:
				$whdll = "Неверно внесены данные";
				break;
				}
			printf("<td>".$whdll."</td>");
			printf("<td>".$row["employee_vozvrata"]."</td>");
			printf("<td><a href='class/save_retur.php?id_zh=".$row["ID_zh"]."'>Восстановить</a></td>");

			printf("</tr>");
			$i++;
		}
		echo '</tbody></table>';
		mysql_free_result($res_obr);
	}
	function allAbiturDel($lgt){
		$obj = new get_function();
		$txt = new get_String_Form();
		$obj->config();
		$res_obr = $obj->view_all_deleted_zhurnal($lgt);	
		echo '<table class="table table-bordered"><thead>';
		echo '<tr><th>'; echo $txt->getStringForm('nn'); 
		echo '</th><th>'; echo $txt->getStringForm('fio_abit'); 
		echo '</th><th>'; echo $txt->getStringForm('kr_spec');  
		echo '</th><th>'; echo $txt->getStringForm('pr_doc'); 
		echo '</th><th>'; echo $txt->getStringForm('lgt');
		echo '</th><th>'; echo $txt->getStringForm('dat_dell');
		echo '</th><th>'; echo $txt->getStringForm('why_dell'); 
		echo '</th><th>'; echo $txt->getStringForm('log'); 
		echo '</th></tr></thead><tbody>';
		 $i=1; 
		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{ 
			printf("<tr>");
			printf("<td>".$i."</td>");
			printf("<td>".$row["fam"]." ".$row["name"]." ".$row["otch"]."</td>");	
			printf("<td>".$row["Nomer_po_zhurn"]."-".$row["KratkoeName"]."/".$row["leter"]."</td>");
			printf("<td>".$row["PRIZNAKDOC"]."</td>");
			printf("<td>".$row["LGOTAVNEKONK"]."</td>");
			printf("<td>".$row["date_vozvrata"]."</td>");
			switch ($row["priznak_vozvrata"]){
				case 1:
				$whdll = "Возврат документов";
				break;
				case 2:
				$whdll = "Неверно внесены данные";
				break;
				}
			printf("<td>".$whdll."</td>");
			printf("<td>".$row["employee_vozvrata"]."</td>");
			printf("<td><a href='class/save_retur.php?id_zh=".$row["ID_zh"]."'>Восстановить</a></td>");
			printf("</tr>");
			$i++;
		}
		echo '</tbody></table>';
		mysql_free_result($res_obr);
		
	}
}
?>