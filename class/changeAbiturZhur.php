<?php session_start();
include_once("get_string.php");
include_once("get_function.php");
class changeAbiturZhur{
	function formaDataAbitur(){
		$txt = new get_String_Form();
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		//echo $ip;
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3232235520)){
		echo '<div class="alert">'; echo $txt->getStringForm("forma10"); echo '</div>';
		
		echo '<table class="table" width="250"><thead>';
		echo '<tr><th><p>'; echo $txt->getStringForm('dat_change'); echo '</p>';
		echo '</th><th><p>'; echo $txt->getStringForm('type_change'); echo '</p>';
		echo '</th></tr></thead><tbody><tr><td>';
			
		echo '<form action="index.php" method="GET" class="form-inline">';
		echo '<input type="hidden" name="pages" value="20"><input type="hidden" name="cl" value="21">';	
		echo '<input type="text" id="datepicker_orig" name="change_date">&nbsp;<label class="checkbox"><input type="checkbox" name="all">'; 
		echo $txt->getStringForm('pr_all'); echo '</label><br><br>';	
		echo '<input type="submit" action="index.php?pages=20&cl=21" class="btn" value="'; 
		echo $txt->getStringForm('show'); echo '">';
		echo '</td><td>';

		echo '<select name="sort_type_change">';
		echo '<option value="">&nbsp;</option>';	
		echo '<option value="1">'; echo $txt->getStringForm('nomer_po_zhurn'); echo '</option>';	
		echo '<option value="2">'; echo $txt->getStringForm('pr_doc'); echo '</option>';	
		echo '<option value="3">'; echo $txt->getStringForm('kont'); echo '</option>';	
		echo '<option value="4">'; echo $txt->getStringForm('lgt'); echo '</option>';	
		echo '</select></form></td>';
		echo '</tr></tbody></table>';	
			
		
		}
	else {
		echo $txt->getStringForm('close');
		}
	}
	
	function datAbiturChange($dt, $lgt){
		$obj = new get_function();
		$txt = new get_String_Form();
		$obj->config();
		$res_obr = $obj->view_change_zhurnal($dt, $lgt);
		echo '<table class="table table-bordered"><thead>';
		echo '<tr><th>'; echo $txt->getStringForm('nn'); echo '</option>';
		echo '</th><th>'; echo $txt->getStringForm('fio_abit'); echo '</option>';
		echo '</th><th>'; echo $txt->getStringForm('kr_spec'); echo '</option>';
		echo '</th><th>'; echo $txt->getStringForm('dat_chan'); echo '</option>';
		echo '</th><th>'; echo $txt->getStringForm('before_ch'); echo '</option>';
		echo '</th><th>'; echo $txt->getStringForm('after_ch'); echo '</option>';
		echo '</th><th>'; echo $txt->getStringForm('type_change'); echo '</option>';
		echo '</th><th>'; echo $txt->getStringForm('log'); echo '</option>';
		echo '</th></tr></thead>';
		 $i=1;
		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{ 
			printf("<tr>");
			printf("<td>".$i."</td>");
			printf("<td>".$row["fam"]." ".$row["name"]." ".$row["otch"]."</td>");	
			printf("<td>".$row["Nomer_po_zhurn"]."-".$row["KratkoeName"]."/".$row["leter"]."</td>");
			printf("<td>".$row["date_change"]."</td>");
			switch($row["type_change"]){
				case 1:
				$type = "Номер по журналу";
				$before_ch = $row["before_change"];
				$after_ch = $row["after_change"];
				break;
				case 2:
				$type = "Документ";
				$before_ch = $obj->doc_change($row["before_change"]);
				$after_ch = $obj->doc_change($row["after_change"]);
				break;
				case 3:
				$type = "Контракт";
				$before_ch = $obj->doc_kontrakt($row["before_change"]);
				$after_ch = $obj->doc_kontrakt($row["after_change"]);
				break;
				case 4:
				$type = "Льгота";
				$before_ch = $obj->doc_lgota($row["before_change"]);
				$after_ch = $obj->doc_lgota($row["after_change"]);
				break;
				}			
			printf("<td>".$before_ch."</td>");
			printf("<td>".$after_ch."</td>");
			printf("<td>".$type."</td>");
			printf("<td>".$row["fio_emplour"]."</td>");
			printf("</tr>");
			$i++;
		}
		echo '</tbody></table>';
		mysql_free_result($res_obr);
	}
	function allAbiturChange($lgt){
		$obj = new get_function();
		$txt = new get_String_Form();
		$obj->config();
		$res_obr = $obj->view_all_change_zhurnal($lgt);
		echo '<table class="table table-bordered"><thead>';
		echo '<tr><th>'; echo $txt->getStringForm('nn'); echo '</option>';
		echo '</th><th>'; echo $txt->getStringForm('fio_abit'); echo '</option>';
		echo '</th><th>'; echo $txt->getStringForm('kr_spec'); echo '</option>';
		echo '</th><th>'; echo $txt->getStringForm('dat_chan'); echo '</option>';
		echo '</th><th>'; echo $txt->getStringForm('before_ch'); echo '</option>';
		echo '</th><th>'; echo $txt->getStringForm('after_ch'); echo '</option>';
		echo '</th><th>'; echo $txt->getStringForm('type_change'); echo '</option>';
		echo '</th><th>'; echo $txt->getStringForm('log'); echo '</option>';
		echo '</th></tr></thead><tbody>';
		 $i=1;
		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{ 
			printf("<tr>");
			printf("<td>".$i."</td>");
			printf("<td>".$row["fam"]." ".$row["name"]." ".$row["otch"]."</td>");	
			printf("<td>".$row["Nomer_po_zhurn"]."-".$row["KratkoeName"]."/".$row["leter"]."</td>");
			printf("<td>".$row["date_change"]."</td>");
			switch($row["type_change"]){
				case 1:
				$type = "Номер по журналу";
				$before_ch = $row["before_change"];
				$after_ch = $row["after_change"];
				break;
				case 2:
				$type = "Документ";
				$before_ch = $obj->doc_change($row["before_change"]);
				$after_ch = $obj->doc_change($row["after_change"]);
				break;
				case 3:
				$type = "Контракт";
				$before_ch = $obj->doc_kontrakt($row["before_change"]);
				$after_ch = $obj->doc_kontrakt($row["after_change"]);
				break;
				case 4:
				$type = "Льгота";
				$before_ch = $obj->doc_lgota($row["before_change"]);
				$after_ch = $obj->doc_lgota($row["after_change"]);
				break;
				}			
			printf("<td>".$before_ch."</td>");
			printf("<td>".$after_ch."</td>");
			printf("<td>".$type."</td>");
			printf("<td>".$row["fio_emplour"]."</td>");
			printf("</tr>");
			$i++;
		}
		echo '</tbody></table>';
		mysql_free_result($res_obr);
	}
}
?>