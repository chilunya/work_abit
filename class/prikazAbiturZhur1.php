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
		echo '<div class="alert"><p>'; echo $txt->getStringForm("forma11"); echo '</p></div>';
		echo '<form action="index.php?pages=22&cl=23" method="get" class="form-inline">';
		echo '<input type="hidden" name="pages" value="22">';
		echo '<input type="hidden" name="cl" value="23">';
		//echo '<select required name="spec"><option value="">'; echo $txt->getStringForm('namespec'); echo '</option>'; $obj->spec(); echo '</select>&nbsp;';
		echo '<select required name="otdelenie"><option value="">'; echo $txt->getStringForm('otdelenie'); echo '</option>'; $obj->otdelenie(); echo '</select>&nbsp;';
		echo '<select required name="kontrakt"><option value="">'; echo $txt->getStringForm('kontrakt'); echo '</option>'; $obj->kontrakt(); echo '</select>&nbsp;';
		echo '<select name="type_prik"><option value="">'; echo $txt->getStringForm('type_prik'); echo '</option>'; $obj->type_prik(); echo '</select>&nbsp;';
		echo '<input class="btn" action="index.php?pages=22&cl=23" type="submit" value="'; echo $txt->getStringForm('prik'); echo '">';
		echo '</form>';
	}
	else {
		echo $title->getStringForm('close');}
	}
	function showPrikazAbitur($otd, $kontr, $typ_pr){
		$obj = new get_function();
		echo '<table border="0" width=100% class="table table-striped">';
		echo '<tr>';
		echo '<td>№</td>';
		echo '<td>ФИО абитуриента</td>';
		echo '<td>Номер личного дела</td>';
		echo '<td>Сумма баллов</td>';
		echo '</tr>';
		$obj->config();
	
		if($typ_pr == 1){
			$delitel = 0.1;
			$lgt = 1;}
		elseif($typ_pr == 2){
			$delitel = 0.15;
			$lgt = 5;}
		else {
			$delitel = 1;}
		if ($kontr == 1){
			$sql = "SELECT plan_budg.IDspec, plan_budg.IDformaobuch_budg, plan_budg.IDkontrakt_budg, plan_budg.plan_budg FROM plan_budg WHERE plan_budg.IDformaobuch_budg = ".$otd." AND plan_budg.IDkontrakt_budg = 1";
			$plan = "plan_budg";
			}
		elseif ($kontr == 2){
			$sql = "SELECT plan_kont.IDspec, plan_kont.IDformaobuch_kont, plan_kont.IDkontrakt_kont, plan_kont.plan_kont FROM plan_kont WHERE plan_kont.IDformaobuch_kont = ".$otd." AND plan_kont.IDkontrakt_kont = 2";
			$plan = "plan_kont";
			}
			//$sql = "SELECT plan_budg.IDspec, plan_budg.IDformaobuch_budg, plan_budg.IDkontrakt_budg, plan_budg.plan_budg FROM plan_budg WHERE plan_budg.IDformaobuch_budg = ".$otd." AND plan_budg.IDkontrakt_budg = 1";
			$result = mysql_query($sql);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				if ($row["IDspec"] == 1){$sort = "dis";}
				elseif ($row["IDspec"] == 2){$sort = "obw";}
				elseif ($row["IDspec"] == 3){$sort = "obw";}
				elseif ($row["IDspec"] == 15){$sort = "obw";}
				elseif ($row["IDspec"] == 10){$sort = "arh";}
				elseif ($row["IDspec"] == 12){$sort = "arh";}
				else {$sort = "fiz";}
			$limit = floor($row[$plan]*$delitel-$obj->zachislenSpec($row["IDspec"], $otd, $kontr));	
			echo '<tr><td colspan="4"><strong>'; $obj->spec_name($row["IDspec"]); echo '<font color="gray"> '.$limit.'</font></strong>';
			//echo $obj->zachislenSpec($row["IDspec"], $otd, $kontr);
			echo '</td></tr>';
			$obj->prikazForAbitur($otd, $row["IDspec"], $kontr, $sort, $limit, $lgt, $typ_pr);	
		}
		echo '</table>';
		
		echo '<form action="word_prikaz.php" method="GET">';
		echo '<input type="hidden" value="'.$_GET["otdelenie"].'" name="otdelenie">';
		echo '<input type="hidden" value="'.$_GET["kontrakt"].'" name="kontrakt">';
		echo '<input type="hidden" value="'.$_GET["type_prik"].'" name="type_prik">';
		echo '<input type="submit" name="but" value="Печать" class="btn">';
		echo '</form>';
	}
}
	
?>