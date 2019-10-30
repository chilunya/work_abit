<?php session_start();
include_once("get_string.php");
include_once("get_function.php");
class prikazAbiturZhur{
	function formaPrikazAbitur(){
		$obj = new get_function();
		$txt = new get_String_Form();
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		//echo $ip;
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
	if (($intip < 3232301055 and $intip > 3232235520)){
		$obj->config();
		echo '<div class="alert"><p align="left">'; echo $txt->getStringForm("view_prik"); echo '</p></div>';
		$sql = "SELECT DISTINCT n_prikaza, data_prikaza FROM ZHURNAL WHERE n_prikaza <> ''";
		$result = mysql_query($sql);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				echo '<p align="left"><a href="index.php?pages=22&cl=23&prik='.$row['n_prikaza'].'&dat='.$row['data_prikaza'].'">';
				$txt->getStringForm('prikaz'); echo $row['n_prikaza'];
				$txt->getStringForm('ot'); echo date("d.m.Y", strtotime($row['data_prikaza']));
				$txt->getStringForm('year_dot'); echo '</a></p>';
			}
		
		
	}
	else {
		echo $title->getStringForm('close');}
	}
	function showPrikazAbitur($nameprik, $datprik){
		$obj = new get_function();
		$txt = new get_String_Form();
		//$obj->spec_priklad();
		//echo ($if_napr[1]);
		
		echo '<h4 align="left">';
		$txt->getStringForm('prikaz'); echo $nameprik;
		$txt->getStringForm('ot'); echo date("d.m.Y", strtotime($datprik));
		$txt->getStringForm('year_dot'); echo '</h4>';
		echo '<table border="0" width=100% class="table table-striped">';
		echo '<tr>';
		echo '<th>'; $txt->getStringForm("nn"); echo '</th>';
		echo '<th>'; $txt->getStringForm("fio_abit"); echo '</th>';
		echo '<th>'; $txt->getStringForm("self_del"); echo '</th>';
		echo '<th>'; $txt->getStringForm("summ_ege"); echo '</th>';
		echo '</tr>';
		$obj->config();
		$nn=1;
		for ($idspec=1; $idspec<17; $idspec++){
			
			//if (($idspec == 11) or ($idspec == 4) or ($idspec == 5) or ($idspec == 6)){
				$prik = $obj->spec_bak($idspec);
				if ($prik == 1){
				for ($b=1; $b<3; $b++){
			
		$sql = "SELECT ZHURNAL.ID_zh, INFO.ID, INFO.fam, INFO.name, INFO.otch, ZHURNAL.Nomer_po_zhurn, SPEC.ID, SPEC.KratkoeName, SPEC.KodSpec, SPEC.NameSpec, FORMAOBUCH.leter, ZHURNAL.Zachislen, ZHURNAL.Kontrakt, ZHURNAL.priznak_vozvrata, ZHURNAL.n_prikaza, ZHURNAL.data_prikaza, ZHURNAL.akad_bak, ZHURNAL.prik_bak, INFO.bal1, INFO.bal2, INFO.bal3, INFO.bal4, INFO.bal5, INFO.kompdiz, INFO.komparh, INFO.grafdiz, INFO.grafarh, INFO.risunok, INFO.sochin, INFO.individ, INFO.bal1 + INFO.bal5 + INFO.kompdiz + INFO.grafdiz + INFO.risunok + INFO.sochin + INFO.individ AS dis, INFO.bal1 + INFO.bal2 + INFO.bal3 + INFO.sochin + INFO.individ AS fiz, INFO.bal1 + INFO.bal2 + INFO.komparh + INFO.grafarh + INFO.risunok + INFO.sochin + INFO.individ AS arh, INFO.bal1 + INFO.bal2 + INFO.bal4 + INFO.sochin + INFO.individ AS obw, ZHURNAL.lgot_vne FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN FORMAOBUCH   ON FORMAOBUCH.ID = ZHURNAL.Otdelenie INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special WHERE ZHURNAL.priznak_vozvrata IS NULL AND ZHURNAL.Zachislen = 1 AND ZHURNAL.n_prikaza = '".$nameprik."' AND SPEC.ID = ".$idspec."";
		if ($b==1){
			$sql = $sql. " AND akad_bak = 1";
			}
		else{
			$sql = $sql. " AND prik_bak = 1";
			}
		
		switch($idspec){
		case 1:	
		$sql = $sql. " ORDER BY dis DESC, INFO.bal5 DESC, INFO.bal1 DESC";
		break;
		case 2:	
		$sql = $sql. " ORDER BY obw DESC, INFO.bal2 DESC, INFO.bal4 DESC, INFO.bal1 DESC";
		break;
		case 3:	
		$sql = $sql. " ORDER BY obw DESC, INFO.bal2 DESC, INFO.bal4 DESC, INFO.bal1 DESC";
		break;
		case 4:	
		$sql = $sql. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 5:	
		$sql = $sql. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 6:	
		$sql = $sql. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 7:	
		$sql = $sql. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 8:	
		$sql = $sql. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 9:	
		$sql = $sql. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 10:	
		$sql = $sql. " ORDER BY arh DESC, INFO.bal2 DESC, INFO.bal1 DESC";
		break;
		case 11:	
		$sql = $sql. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 12:	
		$sql = $sql. " ORDER BY arh DESC, INFO.bal2 DESC, INFO.bal1 DESC";
		break;
		case 13:	
		$sql = $sql. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 14:	
		$sql = $sql. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 15:	
		$sql = $sql. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 16:	
		$sql = $sql. " ORDER BY obw DESC, INFO.bal2 DESC, INFO.bal4 DESC, INFO.bal1 DESC";
		break;
		}
	
		$kod = '';
		$result = mysql_query($sql);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				
				if ($kod != $row['KodSpec']){
					if ($b==1){$bak = ' (академический бакалавриат)';}
					else{$bak = ' (прикладной бакалавриат)';}
				echo '<tr><td colspan="4" align="center"><strong>'.$row['KodSpec'].' '.$row['NameSpec'].$bak.'</strong></td></tr>';
				$kod = $row['KodSpec'];
				$nn=1;
				}
			
				echo '<tr><td>'.$nn.'</td>';
				echo '<td>'.$row['fam'].' '.$row['name'].' '.$row['otch'].'</td>';
				echo '<td>'.$row['KratkoeName'].'-'.$row['Nomer_po_zhurn'].'/'.$row['leter'].'</td>';
				
				switch($idspec){
				case 1:	
				echo '<td>'.$row['dis'].'</td></tr>';
				break;
				case 2:	
				echo '<td>'.$row['obw'].'</td></tr>';
				break;
				case 3:	
				echo '<td>'.$row['obw'].'</td></tr>';
				break;
				case 4:	
				echo '<td>'.$row['fiz'].'</td></tr>';
				break;
				case 5:	
				echo '<td>'.$row['fiz'].'</td></tr>';
				break;
				case 6:	
				echo '<td>'.$row['fiz'].'</td></tr>';
				break;
				case 7:	
				echo '<td>'.$row['fiz'].'</td></tr>';
				break;
				case 8:	
				echo '<td>'.$row['fiz'].'</td></tr>';
				break;
				case 9:	
				echo '<td>'.$row['fiz'].'</td></tr>';
				break;
				case 10:	
				echo '<td>'.$row['arh'].'</td></tr>';
				break;
				case 11:	
				echo '<td>'.$row['fiz'].'</td></tr>';
				break;
				case 12:	
				echo '<td>'.$row['arh'].'</td></tr>';
				break;
				case 13:	
				echo '<td>'.$row['fiz'].'</td></tr>';
				break;
				case 14:	
				echo '<td>'.$row['fiz'].'</td></tr>';
				break;
				case 15:	
				echo '<td>'.$row['fiz'].'</td></tr>';
				break;
				case 16:	
				echo '<td>'.$row['obw'].'</td></tr>';
				break;
				}
				//echo '<td></td></tr>';
				$nn++;
			}
			}
			}
			else {		
		$sql = "SELECT ZHURNAL.ID_zh, INFO.ID, INFO.fam, INFO.name, INFO.otch, ZHURNAL.Nomer_po_zhurn, SPEC.ID, SPEC.KratkoeName, SPEC.KodSpec, SPEC.NameSpec, FORMAOBUCH.leter, ZHURNAL.Zachislen, ZHURNAL.Kontrakt, ZHURNAL.priznak_vozvrata, ZHURNAL.n_prikaza, ZHURNAL.data_prikaza, ZHURNAL.akad_bak, ZHURNAL.prik_bak, INFO.bal1, INFO.bal2, INFO.bal3, INFO.bal4, INFO.bal5, INFO.kompdiz, INFO.komparh, INFO.grafdiz, INFO.grafarh, INFO.risunok, INFO.sochin, INFO.individ, INFO.bal1 + INFO.bal5 + INFO.kompdiz + INFO.grafdiz + INFO.risunok + INFO.sochin + INFO.individ AS dis, INFO.bal1 + INFO.bal2 + INFO.bal3 + INFO.sochin + INFO.individ AS fiz, INFO.bal1 + INFO.bal2 + INFO.komparh + INFO.grafarh + INFO.risunok + INFO.sochin + INFO.individ AS arh, INFO.bal1 + INFO.bal2 + INFO.bal4 + INFO.sochin + INFO.individ AS obw, ZHURNAL.lgot_vne FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN FORMAOBUCH   ON FORMAOBUCH.ID = ZHURNAL.Otdelenie INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special WHERE ZHURNAL.priznak_vozvrata IS NULL AND ZHURNAL.Zachislen = 1 AND ZHURNAL.n_prikaza = '".$nameprik."' AND SPEC.ID = ".$idspec."";
		
		switch($idspec){
		case 1:	
		$sql = $sql. " ORDER BY dis DESC, INFO.bal5 DESC, INFO.bal1 DESC";
		break;
		case 2:	
		$sql = $sql. " ORDER BY obw DESC, INFO.bal2 DESC, INFO.bal4 DESC, INFO.bal1 DESC";
		break;
		case 3:	
		$sql = $sql. " ORDER BY obw DESC, INFO.bal2 DESC, INFO.bal4 DESC, INFO.bal1 DESC";
		break;
		case 4:	
		$sql = $sql. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 5:	
		$sql = $sql. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 6:	
		$sql = $sql. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 7:	
		$sql = $sql. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 8:	
		$sql = $sql. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 9:	
		$sql = $sql. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 10:	
		$sql = $sql. " ORDER BY arh DESC, INFO.bal2 DESC, INFO.bal1 DESC";
		break;
		case 11:	
		$sql = $sql. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 12:	
		$sql = $sql. " ORDER BY arh DESC, INFO.bal2 DESC, INFO.bal1 DESC";
		break;
		case 13:	
		$sql = $sql. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 14:	
		$sql = $sql. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 15:	
		$sql = $sql. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 16:	
		$sql = $sql. " ORDER BY obw DESC, INFO.bal2 DESC, INFO.bal4 DESC, INFO.bal1 DESC";
		break;
		}
	
		$kod = '';
		$result = mysql_query($sql);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				
				if ($kod != $row['KodSpec']){
				echo '<tr><td colspan="4" align="center"><strong>'.$row['KodSpec'].' '.$row['NameSpec'].'</strong></td></tr>';
				$kod = $row['KodSpec'];
				$nn=1;
				}
			
				echo '<tr><td>'.$nn.'</td>';
				echo '<td>'.$row['fam'].' '.$row['name'].' '.$row['otch'].'</td>';
				echo '<td>'.$row['KratkoeName'].'-'.$row['Nomer_po_zhurn'].'/'.$row['leter'].'</td>';
				
				switch($idspec){
				case 1:	
				echo '<td>'.$row['dis'].'</td></tr>';
				break;
				case 2:	
				echo '<td>'.$row['obw'].'</td></tr>';
				break;
				case 3:	
				echo '<td>'.$row['obw'].'</td></tr>';
				break;
				case 4:	
				echo '<td>'.$row['fiz'].'</td></tr>';
				break;
				case 5:	
				echo '<td>'.$row['fiz'].'</td></tr>';
				break;
				case 6:	
				echo '<td>'.$row['fiz'].'</td></tr>';
				break;
				case 7:	
				echo '<td>'.$row['fiz'].'</td></tr>';
				break;
				case 8:	
				echo '<td>'.$row['fiz'].'</td></tr>';
				break;
				case 9:	
				echo '<td>'.$row['fiz'].'</td></tr>';
				break;
				case 10:	
				echo '<td>'.$row['arh'].'</td></tr>';
				break;
				case 11:	
				echo '<td>'.$row['fiz'].'</td></tr>';
				break;
				case 12:	
				echo '<td>'.$row['arh'].'</td></tr>';
				break;
				case 13:	
				echo '<td>'.$row['fiz'].'</td></tr>';
				break;
				case 14:	
				echo '<td>'.$row['fiz'].'</td></tr>';
				break;
				case 15:	
				echo '<td>'.$row['fiz'].'</td></tr>';
				break;
				case 16:	
				echo '<td>'.$row['obw'].'</td></tr>';
				break;
				}
				//echo '<td></td></tr>';
				$nn++;
	
			} 
			}
			}
		
		echo '</table>';
		
	}
}
	
?>