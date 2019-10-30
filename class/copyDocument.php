<?php 

		$dblocation = "192.168.5.112";
		$dbname = "Abitur";
		$dbuser = "asu";
		$dbpassword = "5Y7jwSzL2DyEAApt";
		
		$dbcnx = @mysql_connect($dblocation, $dbuser, $dbpassword);
		mysql_select_db($dbname, $dbcnx);
		
		@mysql_query("SET NAMES 'utf8'");
	
	$dell="DELETE FROM copyDocument";
	$dell_res = mysql_query($dell);

		
	$sql = "SELECT DISTINCT ZHURNAL.Otdelenie, ZHURNAL.IDstud FROM ZHURNAL WHERE ZHURNAL.Otdelenie = 1";
	$result = mysql_query($sql);

	  	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$priznak = 2;	
			$cop = "SELECT ZHURNAL.IDstud, ZHURNAL.Priznak_doc FROM ZHURNAL WHERE ZHURNAL.Otdelenie = 1 AND ZHURNAL.IDstud = ".$row['IDstud'];
			$result_cop = mysql_query($cop);
			while ($row_cop = mysql_fetch_array($result_cop, MYSQL_ASSOC)) {
				
				if ($priznak == $row_cop['Priznak_doc']) {
				$priznak = $row_cop['Priznak_doc'];
				}
				else {$priznak = 1;}
			}
			if ($priznak == 2){
				
				$first="";
				$second="";
				$third="";
				
				$delo_sql = "SELECT ZHURNAL.IDstud, ZHURNAL.Date_podachi, SPEC.KratkoeName, ZHURNAL.priznak_vozvrata, FORMAOBUCH.leter, ZHURNAL.Nomer_po_zhurn, ZHURNAL.ID_zh FROM ZHURNAL INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special WHERE ZHURNAL.IDstud = ".$row['IDstud']." AND ZHURNAL.priznak_vozvrata is null ORDER BY ZHURNAL.ID_zh";
				$delo = mysql_query($delo_sql);
				$fl=1;
				while ($row_delo = mysql_fetch_array($delo, MYSQL_ASSOC)) {
					
					if ($fl == 1){
						$first=$row_delo['KratkoeName']."-".$row_delo['Nomer_po_zhurn']."/".$row_delo['leter'];
					}
					if ($fl == 2){
						$second=$row_delo['KratkoeName']."-".$row_delo['Nomer_po_zhurn']."/".$row_delo['leter'];
					}
					if ($fl == 3){
						$third=$row_delo['KratkoeName']."-".$row_delo['Nomer_po_zhurn']."/".$row_delo['leter'];
					}	
				$fl=$fl+1;	
					$dat=$row_delo['Date_podachi'];
				}
				
				$abit_sql = "SELECT INFO.ID, INFO.fam, INFO.name, INFO.otch, country.country, INFO.type_sity, INFO.name_sity, INFO.rayon_centr, prospect.prospect, INFO.ulica, INFO.dom, INFO.kvart, INFO.telefon FROM country INNER JOIN INFO ON country.id = INFO.gosudarstvo INNER JOIN prospect ON prospect.ID = INFO.type_str WHERE INFO.ID = ".$row['IDstud']."";
				$res_abit = mysql_query($abit_sql);
				$row_abit = mysql_fetch_array($res_abit, MYSQL_ASSOC);
		
				$obr = "INSERT INTO copyDocument (id_stud, fio, first, second, third, tel, adress, date) VALUES (
				".$row['IDstud'].", 
				'".$row_abit['fam']." ".$row_abit['name']." ".$row_abit['otch']."', 
				'".$first."', 
				'".$second."', 
				'".$third."', 
				'".$row_abit['telefon']."',  				
				'".$row_abit['country']." ".$row_abit['type_sity']." ".$row_abit['name_sity']." ".$row_abit['rayon_centr']." ".$row_abit['prospect']." ".$row_abit['ulica']." ".$row_abit['dom']." ".$row_abit['kvart']."', 
				'".$dat."'	
				)";

	
	//echo $obr;
				$res_obr = mysql_query($obr);
				
				
				//echo "все копии у id ".$row['IDstud']." ".$first." ".$second." ".$third." <br>";
				}
			
				
		}
		
		header("Location: ../excel_copy.php");

?>