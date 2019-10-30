<?php session_start();
class get_function{
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
/*++++++++++++++++++++++++++++++++++

fun -  sortirovka spiskov abiturientov

+++++++++++++++++++++++++++++++++++*/	
function abit_sort()
	{
		//$this->config();
		$sql="SELECT setting.id, setting.sort FROM setting"; 
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		return $row['sort'];
	
	}
/*++++++++++++++++++++++++++++++++++

fun -  napravleniya prikladnogo bakalavriata

+++++++++++++++++++++++++++++++++++*/	
function spec_bak($id)
	{
		//$this->config();
		$sql="SELECT setting_spec.id_spec, setting_spec.prik_spec, setting_spec.id FROM setting_spec WHERE setting_spec.id_spec = ".$id.""; 
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		return $row['prik_spec'];
	
	}
/*++++++++++++++++++++++++++++++++++

fun -  statistika po napravleniyam

+++++++++++++++++++++++++++++++++++*/	
	function stat_po_naprav($otd, $id_spec)
	{
		$this->config();
		//$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Zachislen, ZHURNAL.Special, INFO.fam, INFO.name, INFO.otch, PRIZNAKDOC.PRIZNAKDOC, LGOTAVNEKONK.LGOTAVNEKONK, KONTRAKT.KONTRAKT, INFO.bal1, INFO.bal2, INFO.bal3, INFO.bal4, INFO.bal5, INFO.kompdiz, INFO.komparh, INFO.grafarh, INFO.grafdiz, INFO.risunok, INFO.bal1+INFO.bal5+INFO.kompdiz+INFO.grafdiz+INFO.risunok AS expr1 FROM KONTRAKT INNER JOIN (PRIZNAKDOC INNER JOIN (LGOTAVNEKONK INNER JOIN (INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud) ON LGOTAVNEKONK.ID = ZHURNAL.lgot_vne) ON PRIZNAKDOC.ID = ZHURNAL.Priznak_doc) ON KONTRAKT.ID = ZHURNAL.Kontrakt WHERE (((ZHURNAL.Otdelenie)=".$otd.") AND ((ZHURNAL.Special)=".$id_spec.")) AND ZHURNAL.Zachislen<>1 ORDER BY INFO.fam";
		$obr = "SELECT ZHURNAL.ID_zh, ZHURNAL.Kontrakt, ZHURNAL.Zachislen, ZHURNAL.Priznak_doc, ZHURNAL.Nomer_po_zhurn, ZHURNAL.Otdelenie, INFO.fam, INFO.name, INFO.otch, SPEC.KratkoeName, ZHURNAL.Special, FORMAOBUCH.leter, INFO.bal1, INFO.bal2, INFO.bal3, INFO.bal4, INFO.bal5, INFO.kompdiz, INFO.komparh, INFO.grafdiz, INFO.grafarh, INFO.risunok, INFO.bal1 + INFO.bal5 + INFO.kompdiz + INFO.grafdiz + INFO.risunok AS dis, INFO.bal1 + INFO.bal2 + INFO.bal3 AS fiz, INFO.bal1 + INFO.bal2 + INFO.komparh + INFO.grafarh + INFO.risunok AS arh, INFO.bal1 + INFO.bal2 + INFO.bal4 AS obw, ZHURNAL.lgot_vne FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie WHERE ZHURNAL.Special = ".$id_spec." AND ZHURNAL.Zachislen <> 1 AND ZHURNAL.Otdelenie = ".$otd." ORDER BY INFO.fam";
// ORDER BY ".$sort." DESC";
		$res_obr = mysql_query($obr);
		
		$row_ball = mysql_fetch_array($res_obr, MYSQL_ASSOC);
	}
/*++++++++++++++++++++++++++++++++++

fun -  count_md5_pass

+++++++++++++++++++++++++++++++++++*/	
	function count_md5_pass()
	{
		$this->config();
		$obr = "SELECT (COUNT(*)-COUNT(pass.md5_pass)) AS expr1 FROM pass ";	
		$res_obr = mysql_query($obr);
	  	$row = mysql_fetch_array($res_obr, MYSQL_ASSOC);
		echo $row['expr1'];
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  DECAN

+++++++++++++++++++++++++++++++++++*/	
	function selected_decanat($selected){
		$this->config();
		$sql="SELECT DECAN.id_decan, DECAN.FIO_Decan, DECAN.decanat FROM DECAN "; 
		$res_obr = mysql_query($sql);
		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row["id_decan"]){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row["id_decan"]."'>");
        	printf ($row["decanat"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
		}

/*++++++++++++++++++++++++++++++++++

TABLE -  selected SPEC (kratkoe_spec)

+++++++++++++++++++++++++++++++++++*/	
	function selected_spec($selected){
		$this->config();
		$sql="SELECT SPEC.ID, SPEC.KratkoeName, SPEC.KodSpec, SPEC.NameSpec FROM SPEC ORDER BY ID"; 
		$res_obr = mysql_query($sql);
		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row["ID"]){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row["ID"]."'>");
        	printf ($row["KratkoeName"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
		}

/*++++++++++++++++++++++++++++++++++

TABLE -  mesto

+++++++++++++++++++++++++++++++++++*/	
	function mesto($selected)
	{
		
		$obr = "SELECT PREDMET_MESTO.ID, PREDMET_MESTO.mesto_predmet FROM PREDMET_MESTO ORDER BY PREDMET_MESTO.ID";	
		$res_obr = mysql_query($obr);
    /* show result */
	
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row["ID"]){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row["ID"]."'>");
        	printf ($row["mesto_predmet"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

OPTION type_prik

+++++++++++++++++++++++++++++++++++*/	
	function type_prik()
	{
		echo "<option value='1'>Льготный</option>";
		echo "<option value='2'>Целевой приём</option>";
		echo "<option value='3'>I волна</option>";
		echo "<option value='4'>II волна</option>";
		
	}
/*++++++++++++++++++++++++++++++++++

OPTION data na sobesedovanie

+++++++++++++++++++++++++++++++++++	*/
	function dat_sob()
	{
		$this->config();
		$obr = "SELECT id, date_sob FROM date_sobes ORDER BY id";	
		$res_obr = mysql_query($obr);
    /* show result */
	
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["date_sob"]."'>");
        	printf (date("d.m.Y", strtotime($row['date_sob'])));
			printf("</option>");
		}
		mysql_free_result($res_obr);

	}

/*++++++++++++++++++++++++++++++++++

OPTION data na sobesedovanie

+++++++++++++++++++++++++++++++++++	*/
	function dat_ekzam($selected)
	{
		$this->config();
		$obr = "SELECT id, date_sob FROM date_sobes ORDER BY id";	
		$res_obr = mysql_query($obr);
		
	
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row["id"]){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row["id"]."'>");
        	printf (date("d.m.Y", strtotime($row['date_sob'])));
			printf("</option>");
		}
		mysql_free_result($res_obr);

	}

/*++++++++++++++++++++++++++++++++++

Function pricak

+++++++++++++++++++++++++++++++++++*/
	function prikazForAbitur($otd, $spec, $kont, $sort, $limit, $lgt, $typ_pr)
	{
		if ($typ_pr < 3) {
		$sql = "SELECT ZHURNAL.ID_zh, ZHURNAL.Kontrakt, ZHURNAL.Zachislen, ZHURNAL.Priznak_doc, ZHURNAL.Nomer_po_zhurn, ZHURNAL.Otdelenie, INFO.fam, INFO.name, INFO.otch, SPEC.KratkoeName, ZHURNAL.Special, FORMAOBUCH.leter, INFO.bal1, INFO.bal2, INFO.bal3, INFO.bal4, INFO.bal5, INFO.kompdiz, INFO.komparh, INFO.grafdiz, INFO.grafarh, INFO.risunok, INFO.bal1 + INFO.bal5 + INFO.kompdiz + INFO.grafdiz + INFO.risunok AS dis, INFO.bal1 + INFO.bal2 + INFO.bal3 AS fiz, INFO.bal1 + INFO.bal2 + INFO.komparh + INFO.grafarh + INFO.risunok AS arh, INFO.bal1 + INFO.bal2 + INFO.bal4 AS obw, ZHURNAL.lgot_vne, ZHURNAL.priznak_vozvrata FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie WHERE ZHURNAL.Special = ".$spec." AND ZHURNAL.Kontrakt = ".$kont." AND ZHURNAL.Priznak_doc = 1 AND ZHURNAL.Zachislen <> 1 AND ZHURNAL.Otdelenie = ".$otd." AND ZHURNAL.priznak_vozvrata is null";
		}
		else {
		$sql = "SELECT SubQuery.Priznak_doc, SubQuery.Kontrakt, SubQuery.Zachislen, SubQuery.Nomer_po_zhurn, SubQuery.Otdelenie, SubQuery.ID_zh, SubQuery.fam, SubQuery.name, SubQuery.otch, SubQuery.KratkoeName, SubQuery.Special, SubQuery.leter, SubQuery.dis, SubQuery.fiz, SubQuery.arh, SubQuery.obw, SubQuery.lgot_vne FROM (SELECT ZHURNAL.ID_zh, ZHURNAL.Kontrakt, ZHURNAL.Zachislen, ZHURNAL.Priznak_doc, ZHURNAL.Nomer_po_zhurn, ZHURNAL.Otdelenie, INFO.fam, INFO.name, INFO.otch, SPEC.KratkoeName, ZHURNAL.Special, FORMAOBUCH.leter, INFO.bal1, INFO.bal2, INFO.bal3, INFO.bal4, INFO.bal5, INFO.kompdiz, INFO.komparh, INFO.grafdiz, INFO.grafarh, INFO.risunok, INFO.bal1 + INFO.bal5 + INFO.kompdiz + INFO.grafdiz + INFO.risunok AS dis, INFO.bal1 + INFO.bal2 + INFO.bal3 AS fiz, INFO.bal1 + INFO.bal2 + INFO.komparh + INFO.grafarh + INFO.risunok AS arh, INFO.bal1 + INFO.bal2 + INFO.bal4 AS obw, ZHURNAL.lgot_vne, ZHURNAL.priznak_vozvrata FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie WHERE ZHURNAL.Special = ".$spec." AND ZHURNAL.Kontrakt = ".$kont." AND ZHURNAL.Zachislen <> 1 AND ZHURNAL.Otdelenie = ".$otd." AND ZHURNAL.priznak_vozvrata is null ORDER BY ".$sort." DESC LIMIT ".$limit.") SubQuery WHERE SubQuery.Priznak_doc = 1";
		}
	if ($lgt == 1) {
		$sql = $sql." AND ZHURNAL.lgot_vne IN (3,4,6)";
		//$sql = $sql." AND SubQuery.lgot_vne > 1 AND SubQuery.lgot_vne < 5";
	}
	elseif ($lgt == 5) {
		$sql = $sql." AND ZHURNAL.lgot_vne = 5";
	}
	$sql = $sql." ORDER BY ".$sort." DESC LIMIT ".$limit."";
	//$sql = $sql." ORDER BY SubQuery.".$sort." DESC";
		$result = mysql_query($sql);
		$nn=1;
		//echo $sql;
	  	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		printf("<tr>");
		printf("<td>".$nn."</td>");
		printf("<td>".$row["fam"]." ".$row["name"]." ".$row["otch"]."</td>");
		printf("<td>".$row["KratkoeName"]."-".$row["Nomer_po_zhurn"]."/".$row["leter"]."</td>");
		printf("<td>".$row[$sort]."</td>");
		printf("</tr>");
		$nn = $nn+1;
		
		}
		//echo $sql;
	}
/*++++++++++++++++++++++++++++++++++

skolko zachisleno na spec

+++++++++++++++++++++++++++++++++++*/	
	function zachislenSpec($id, $otd, $kont){
		$sql = "SELECT ZHURNAL.Otdelenie, ZHURNAL.Special, ZHURNAL.Kontrakt, ZHURNAL.Zachislen FROM ZHURNAL WHERE ZHURNAL.Otdelenie = ".$otd." AND ZHURNAL.Special = ".$id." AND ZHURNAL.Kontrakt = ".$kont." AND ZHURNAL.Zachislen = 1";
		$result = mysql_query($sql);
		$i=0;
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$i=$i+1;
			}
		return $i;
		}
/*++++++++++++++++++++++++++++++++++

TABLE -  plan_budget

+++++++++++++++++++++++++++++++++++*/	
	function plan_budget($otd)
	{
		$sql = "SELECT plan_budg.IDspec, plan_budg.IDformaobuch_budg, plan_budg.IDkontrakt_budg, plan_budg.plan_budg FROM plan_budg WHERE plan_budg.IDformaobuch_budg = ".$otd." AND plan_budg.IDkontrakt_budg = 1";
		$result = mysql_query($sql);
		//$row = mysql_fetch_array($result, MYSQL_ASSOC);
		return $result;
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  spec_vostan

+++++++++++++++++++++++++++++++++++*/	
	function plan_kontrakt($otd)
	{
		$sql = "SELECT plan_kont.IDspec, plan_kont.IDformaobuch_kont, plan_kont.IDkontrakt_kont, plan_kont.plan_kont FROM plan_kont WHERE plan_kont.IDspec = ".$spec." AND plan_kont.IDformaobuch_kont = ".$otd." AND plan_kont.IDkontrakt_kont = 2";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		echo $row["plan_kont"];
	}	
/*++++++++++++++++++++++++++++++++++

TABLE -  spec_vostan

+++++++++++++++++++++++++++++++++++*/	
	function spec_vostan()
	{
		$obr = "SELECT ID, ID_spec, spec FROM SPEC_VOSTAN ORDER BY spec";	
		$res_obr = mysql_query($obr);
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["ID_spec"].' - '.$row["spec"]);
			printf("</option>");
		}
		return $res_obr;
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

function -  view_all_change_zhurnal

+++++++++++++++++++++++++++++++++++*/
	function view_all_change_zhurnal($lgt) {
		$obr = "SELECT INFO.fam, INFO.name, INFO.otch, SPEC.KratkoeName, FORMAOBUCH.leter, update_zhur.date_change, update_zhur.fio_emplour, update_zhur.before_change, update_zhur.after_change, update_zhur.type_change, ZHURNAL.Nomer_po_zhurn FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN update_zhur ON ZHURNAL.ID_zh = update_zhur.id_zhurnal INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie";
		if (isset($lgt) and $lgt != ""){
			$obr = $obr . " WHERE update_zhur.type_change = ".$lgt;
			}
		$obr = $obr . " ORDER BY update_zhur.date_change";
		$res_obr = mysql_query($obr); 
		return $res_obr;
	}
/*++++++++++++++++++++++++++++++++++

function -  view_all_change_zhurnal

+++++++++++++++++++++++++++++++++++*/
	function view_change_zhurnal($dt, $lgt) {
		$dat_ch = str_replace(".", "-", $dt);
		$obr = "SELECT INFO.fam, INFO.name, INFO.otch, SPEC.KratkoeName, FORMAOBUCH.leter, update_zhur.date_change, update_zhur.fio_emplour, update_zhur.before_change, update_zhur.after_change, update_zhur.type_change, ZHURNAL.Nomer_po_zhurn FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN update_zhur ON ZHURNAL.ID_zh = update_zhur.id_zhurnal INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie WHERE update_zhur.date_change LIKE '".$dat_ch."%'";
		if (isset($lgt) and $lgt != ""){
			$obr = $obr . " AND update_zhur.type_change = ".$lgt;
			}
		$obr = $obr . " ORDER BY update_zhur.date_change";
		$res_obr = mysql_query($obr); 
		return $res_obr;
	}
/*++++++++++++++++++++++++++++++++++

function -  doc_lgota

+++++++++++++++++++++++++++++++++++*/
	function doc_lgota($id_change) {
		$sql_doc = "SELECT LGOTAVNEKONK.ID, LGOTAVNEKONK.LGOTAVNEKONK FROM LGOTAVNEKONK WHERE LGOTAVNEKONK.ID = ".$id_change;
		$res_doc = mysql_query($sql_doc); 
		$row_doc = mysql_fetch_array($res_doc, MYSQL_ASSOC);
		$dat = $row_doc['LGOTAVNEKONK'];
		return $dat;
	}
/*++++++++++++++++++++++++++++++++++

function -  doc_kontrakt

+++++++++++++++++++++++++++++++++++*/
	function doc_kontrakt($id_change) {
		$sql_doc = "SELECT KONTRAKT.ID, KONTRAKT.KONTRAKT FROM KONTRAKT WHERE KONTRAKT.ID = ".$id_change;
		$res_doc = mysql_query($sql_doc); 
		$row_doc = mysql_fetch_array($res_doc, MYSQL_ASSOC);
		$dat = $row_doc['KONTRAKT'];
		return $dat;
	}
/*++++++++++++++++++++++++++++++++++

function -  doc_change

+++++++++++++++++++++++++++++++++++*/
	function doc_change($id_change) {
		$sql_doc = "SELECT PRIZNAKDOC.ID, PRIZNAKDOC.PRIZNAKDOC FROM PRIZNAKDOC WHERE PRIZNAKDOC.ID = ".$id_change;
		$res_doc = mysql_query($sql_doc); 
		$row_doc = mysql_fetch_array($res_doc, MYSQL_ASSOC);
		$dat = $row_doc['PRIZNAKDOC'];
		return $dat;
	}
/*++++++++++++++++++++++++++++++++++

function -  view all deleted zhurnal

+++++++++++++++++++++++++++++++++++*/
	function view_all_deleted_zhurnal($lgt) {
		$obr = "SELECT INFO.fam, INFO.name, INFO.otch, ZHURNAL.ID_zh, ZHURNAL.Nomer_po_zhurn, SPEC.KratkoeName, FORMAOBUCH.leter, PRIZNAKDOC.PRIZNAKDOC, KONTRAKT.KONTRAKT, LGOTAVNEKONK.LGOTAVNEKONK, ZHURNAL.date_vozvrata, ZHURNAL.priznak_vozvrata, ZHURNAL.employee_vozvrata FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN PRIZNAKDOC ON PRIZNAKDOC.ID = ZHURNAL.Priznak_doc INNER JOIN KONTRAKT ON KONTRAKT.ID = ZHURNAL.Kontrakt INNER JOIN LGOTAVNEKONK ON LGOTAVNEKONK.ID = ZHURNAL.lgot_vne AND ZHURNAL.priznak_vozvrata is not null";
		if (isset($lgt) and $lgt != ""){
			$obr = $obr . " AND ZHURNAL.priznak_vozvrata = ".$lgt;
			}
		$obr = $obr . " ORDER BY ZHURNAL.date_vozvrata";
		$res_obr = mysql_query($obr);  
		return $res_obr;
	}
/*++++++++++++++++++++++++++++++++++

function -  view deleted zhurnal

+++++++++++++++++++++++++++++++++++*/
	function view_deleted_zhurnal($dt, $lgt) {
		$dat_ch = str_replace(".", "-", $dt);
		$obr = "SELECT INFO.fam, INFO.name, INFO.otch, ZHURNAL.ID_zh, ZHURNAL.Nomer_po_zhurn, SPEC.KratkoeName, FORMAOBUCH.leter, PRIZNAKDOC.PRIZNAKDOC, KONTRAKT.KONTRAKT, LGOTAVNEKONK.LGOTAVNEKONK, ZHURNAL.date_vozvrata, ZHURNAL.priznak_vozvrata, ZHURNAL.employee_vozvrata FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN PRIZNAKDOC ON PRIZNAKDOC.ID = ZHURNAL.Priznak_doc INNER JOIN KONTRAKT ON KONTRAKT.ID = ZHURNAL.Kontrakt INNER JOIN LGOTAVNEKONK ON LGOTAVNEKONK.ID = ZHURNAL.lgot_vne WHERE ZHURNAL.date_vozvrata LIKE '".$dat_ch."%' AND ZHURNAL.priznak_vozvrata is not null";
		if (isset($lgt) and $lgt != ""){
			$obr = $obr . " AND ZHURNAL.priznak_vozvrata = ".$lgt;
			}
		$obr = $obr . " ORDER BY ZHURNAL.date_vozvrata";
		$res_obr = mysql_query($obr);  
		return $res_obr;
	}
/*++++++++++++++++++++++++++++++++++

function -  return doc to abitur

+++++++++++++++++++++++++++++++++++*/
	function return_doc_to_abitur($data_voz, $idzh) {
		$obr="UPDATE ZHURNAL SET vozvrat_doc='".$data_voz."' WHERE ID_zh=".$idzh;
		$res_obr = mysql_query($obr);
		return $res_obr;
	}
/*++++++++++++++++++++++++++++++++++

why are you should to dell the data?

+++++++++++++++++++++++++++++++++++*/	
	function why_dell_zh()
	{
		printf("<option value=''>- Причина удаления -</option>");
		printf("<option value='1'>Возврат документов</option>");
		printf("<option value='2'>Неверно внесена запись</option>");
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  pol selected

+++++++++++++++++++++++++++++++++++*/	
	function selected_pol($selected)
	{

		$obr = "SELECT ID, POL FROM POL ORDER BY ID";	
		$res_obr = mysql_query($obr);
	/* show result */
		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
		if ($selected == $row['ID']){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row['ID']."'>");
			printf ($row["POL"]);
			printf("</option>");
		}
		return $res_obr;
		mysql_free_result($res_obr);
		
	}
/*++++++++++++++++++++++++++++++++++
 
TABLE -  TYPYOFPLASE selected

+++++++++++++++++++++++++++++++++++*/	
	function selected_typeofobjects($selected)
	{
		$obr = "SELECT ID, name_st FROM TYPYOFPLASE ORDER BY ID";	
		$res_obr = mysql_query($obr);
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row['ID']){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row['ID']."'>");
        	printf ($row["name_st"]);
			printf("</option>");
		}
		return $res_obr;
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  VIDKURSOV selected

+++++++++++++++++++++++++++++++++++*/	
	function selected_kyrsy($selected)
	{
		$obr = "SELECT ID, VIDKURSOV FROM VIDKURSOV ORDER BY ID";	
		$res_obr = mysql_query($obr);
	/* show result */
		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row['ID']){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row['ID']."'>");
			printf ($row["VIDKURSOV"]);
			printf("</option>");
		}
		return $res_obr;
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  otdelenie selected

+++++++++++++++++++++++++++++++++++*/	
	function selected_otdelenie($selected)
	{
		$obr = "SELECT ID, FORMAOBUCH FROM FORMAOBUCH ORDER BY ID";	
		$res_obr = mysql_query($obr);
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row['ID']){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row["ID"]."'>");
        	printf ($row["FORMAOBUCH"]);
			printf("</option>");
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  DOCUMENT selected

+++++++++++++++++++++++++++++++++++*/	
	function selected_document($selected)
	{
		$obr = "SELECT ID, DOCUMENT FROM DOCUMENT ORDER BY ID";	
		$res_obr = mysql_query($obr);
	/* show result */
		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row['ID']){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row['ID']."'>");
			printf ($row["DOCUMENT"]);
			printf("</option>");
		}
		return $res_obr;
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  INYAZ selected

+++++++++++++++++++++++++++++++++++*/	
	function selected_language($selected)
	{
		$obr = "SELECT ID, INYAZ FROM INYAZ ORDER BY ID";	
		$res_obr = mysql_query($obr);
	/* show result */
		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row['ID']){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option ".$check." value='".$row['ID']."'>");
			printf ($row["INYAZ"]);
			printf("</option>");
		}
		return $res_obr;
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  MEDAL selected

+++++++++++++++++++++++++++++++++++*/	
	function selected_medal($selected)
	{
		$obr = "SELECT ID, MEDAL FROM MEDAL ORDER BY ID";	
		$res_obr = mysql_query($obr);
	/* show result */
		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row['ID']){
					$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row['ID']."'>");
			printf ($row["MEDAL"]);
			printf("</option>");
		}
		return $res_obr;
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  POSELOK selected

+++++++++++++++++++++++++++++++++++*/	
	function selected_poselok($selected)
	{
	$obr = "SELECT ID, POSELOK FROM POSELOK ORDER BY ID";	
		$res_obr = mysql_query($obr);
	/* show result */
		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row["ID"]){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row["ID"]."'>");
			printf ($row["POSELOK"]);
			printf("</option>");
		}
		return $res_obr;
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  OBRAZOVANIE selected

+++++++++++++++++++++++++++++++++++*/	
	function selected_obrazovanie($selected)
	{
		$obr = "SELECT ID, OBRAZOVANIE FROM OBRAZOVANIE ORDER BY ID";	
		$res_obr = mysql_query($obr);
	/* show result */
		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row["ID"]){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row["ID"]."'>");
			printf ($row["OBRAZOVANIE"]);
			printf("</option>");
		}
		return $res_obr;
		mysql_free_result($res_obr);
	}
	
/*++++++++++++++++++++++++++++++++++

TABLE -  OBWEZHITIE selected

+++++++++++++++++++++++++++++++++++*/	
	function selected_obwezhitie($selected)
	{
		$obr = "SELECT ID, OBWEZHITIE FROM OBWEZHITIE ORDER BY ID";	
		$res_obr = mysql_query($obr);
	/* show result */
		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row["ID"]){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row["ID"]."'>");
			printf ($row["OBWEZHITIE"]);
			printf("</option>");
		}
		return $res_obr;
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  prospect selected

+++++++++++++++++++++++++++++++++++*/	
	function selected_prospect($selected)
	{
		$obr = "SELECT ID, prospect FROM prospect ORDER BY ID";	
		$res_obr = mysql_query($obr);
	/* show result */
		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row["ID"]){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row["ID"]."'>");
			printf ($row["prospect"]);
			printf("</option>");
		}
		return $res_obr;
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  UCHZAVEDENIE selected

+++++++++++++++++++++++++++++++++++*/	
	function selected_uchzavedenie($selected)
	{
		$obr = "SELECT ID, UCHZAVEDENIE FROM UCHZAVEDENIE ORDER BY ID";	
		$res_obr = mysql_query($obr);
	/* show result */
		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row["ID"]){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row["ID"]."'>");
			printf ($row["UCHZAVEDENIE"]);
			printf("</option>");
		}
		return $res_obr;
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  country selected

+++++++++++++++++++++++++++++++++++*/	
	function selected_country($selected)
	{
		$obr = "SELECT id, country FROM country ORDER BY id";	
		$res_obr = mysql_query($obr);
	/* show result */
		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row["id"]){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row["id"]."'>");
			printf ($row["country"]);
			printf("</option>");
		}
		return $res_obr;
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

Look self data choosed abiturients

/+++++++++++++++++++++++++++++++++++*/	
	function look_zaurnal_of_abitur($idstud){
		$zhurn = "SELECT ZHURNAL.IDstud, SPEC.KodSpec, ZHURNAL.priznak_vozvrata, ZHURNAL.akad_bak, ZHURNAL.prik_bak, ZHURNAL.Nomer_po_zhurn, INFO.fam, INFO.pasport_ser, INFO.pasport_nom, INFO.name, INFO.otch, FORMAOBUCH.leter, SPEC.KratkoeName, PRIZNAKDOC.PRIZNAKDOC, ZHURNAL.Protokol, ZHURNAL.Date_podachi, KONTRAKT.KONTRAKT, ZHURNAL.ID_zh, ZHURNAL.priority, LGOTAVNEKONK.LGOTAVNEKONK, INFO.to_edit FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN PRIZNAKDOC ON PRIZNAKDOC.ID = ZHURNAL.Priznak_doc INNER JOIN KONTRAKT ON KONTRAKT.ID = ZHURNAL.Kontrakt INNER JOIN LGOTAVNEKONK ON LGOTAVNEKONK.ID = ZHURNAL.lgot_vne WHERE (ZHURNAL.IDstud = ".$idstud." AND ZHURNAL.priznak_vozvrata is NULL) ORDER BY ZHURNAL.priority";
		$res_zhurn = mysql_query($zhurn);
		return $res_zhurn;
		}
/*++++++++++++++++++++++++++++++++++

Look self data choosed abiturients

/+++++++++++++++++++++++++++++++++++*/	
	function look_selfdata_choosed_abitur($abitur)
	{
		$sql = "SELECT INFO.ID, INFO.fam, INFO.name, INFO.otch, INFO.data_rozhd, INFO.pol, INFO.pasport_ser, INFO.pasport_nom, INFO.pasport_kemvidan, INFO.birth_place, INFO.pasport_data, 
		INFO.gosudarstvo, INFO.type_sity, INFO.name_sity, INFO.rayon_centr, 
		INFO.selo, INFO.type_str, INFO.ulica, INFO.dom, INFO.kvart, INFO.mail, 
		INFO.telefon, INFO.obrazov, INFO.uch_zavedenie, INFO.nazvanie, INFO.nom_uch_zaved, 
		INFO.god_okonch, INFO.document, INFO.doc_type_sity, INFO.doc_name_sity, INFO.doc_ser, 
		INFO.doc_nom, INFO.doc_data, INFO.inostr_yaz, INFO.medal, INFO.obwezhit, 
		INFO.vozvrat, INFO.ege_ser, INFO.ege_reg, INFO.bal1, INFO.bal2, INFO.bal3, INFO.bal4, INFO.bal5, INFO.inostran, INFO.to_edit FROM INFO WHERE INFO.ID='". $abitur ."'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		return $row;
	}
/*++++++++++++++++++++++++++++++++++

nameOfStud

+++++++++++++++++++++++++++++++++++*/
function nameOfStud($idstud)
	{
		
		$obr = "SELECT ID, fam, name, otch FROM INFO WHERE ID=".$idstud."";	
		$res_obr = mysql_query($obr);
		$row = mysql_fetch_array($res_obr, MYSQL_ASSOC);       	printf ($row["fam"]." ".$row["name"]." ".$row["otch"]);
		mysql_free_result($res_obr);
		
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  ekzam

+++++++++++++++++++++++++++++++++++*/	
	function ekzam()
	{
		$obr = "SELECT PREDMET_MESTO.ID, PREDMET_MESTO.mesto_predmet FROM PREDMET_MESTO";	
		$res_obr = mysql_query($obr);
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["mesto_predmet"]);
			printf("</option>");
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  protokol

+++++++++++++++++++++++++++++++++++*/	
	function protokol()
	{	
		$dat_tuday = date("Y-m-d");
		$obr = "SELECT PROTOKOL.Nom_prot, PROTOKOL.Data1, PROTOKOL.Data2 FROM PROTOKOL WHERE PROTOKOL.Data1 <= '".$dat_tuday."' AND PROTOKOL.Data2 >= '".$dat_tuday."'";	
		$res_obr = mysql_query($obr);
    /* show result */
		$row = mysql_fetch_array($res_obr, MYSQL_ASSOC);       echo $row["Nom_prot"];
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  lgot_konk

+++++++++++++++++++++++++++++++++++*/	
	function lgot_konk()
	{
		$obr = "SELECT ID, LGOTAKONK FROM LGOTAKONK ORDER BY ID";	
		$res_obr = mysql_query($obr);
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["LGOTAKONK"]);
			printf("</option>");
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  lgot_vne

+++++++++++++++++++++++++++++++++++*/	
	function lgot_vne()
	{
		$obr = "SELECT ID, LGOTAVNEKONK FROM LGOTAVNEKONK ORDER BY ID";	
		$res_obr = mysql_query($obr);
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["LGOTAVNEKONK"]);
			printf("</option>");
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  kontrakt

+++++++++++++++++++++++++++++++++++*/	
	function kontrakt()
	{
		$obr = "SELECT ID, KONTRAKT FROM KONTRAKT ORDER BY ID";	
		$res_obr = mysql_query($obr);
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["KONTRAKT"]);
			printf("</option>");
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  otdelenie

+++++++++++++++++++++++++++++++++++*/	
	function otdelenie()
	{
		$this->config();
		$obr = "SELECT ID, FORMAOBUCH FROM FORMAOBUCH ORDER BY ID";	
		$res_obr = mysql_query($obr);
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["FORMAOBUCH"]);
			printf("</option>");
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  inostranec

+++++++++++++++++++++++++++++++++++*/	
	function inostranec()
	{
			echo '<option value="1">Российское</option>';
			echo '<option value="3">Иностранное</option>';
		
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  priznak

+++++++++++++++++++++++++++++++++++*/	
	function priznak()
	{
		$obr = "SELECT ID, PRIZNAKDOC FROM PRIZNAKDOC ORDER BY ID";	
		$res_obr = mysql_query($obr);
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["PRIZNAKDOC"]);
			printf("</option>");
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  priznak selected

+++++++++++++++++++++++++++++++++++*/	
	function priznak_selected($selected)
	{
		$obr = "SELECT ID, PRIZNAKDOC FROM PRIZNAKDOC ORDER BY ID";	
		$res_obr = mysql_query($obr);
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row['ID']){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row['ID']."'>");
        	printf ($row["PRIZNAKDOC"]);
			printf("</option>");
		}
		mysql_free_result($res_obr);
	}

/*++++++++++++++++++++++++++++++++++

TABLE -  spec

+++++++++++++++++++++++++++++++++++*/	
	function spec()
	{

		if ($_SESSION['levl'] < 3){
			$obr = "SELECT ID, NameSpec FROM SPEC ORDER BY ID ";

		}

		else {
			$obr = "SELECT ID, NameSpec FROM SPEC WHERE ID < 17 ORDER BY ID ";

		}
			

		//$obr = "SELECT ID, NameSpec FROM SPEC ORDER BY ID ";	
		$res_obr = mysql_query($obr);

	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{

			printf("<option value='".$row["ID"]."'>");
        	printf ($row["NameSpec"]);
			printf("</option>");

		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  spec_name

+++++++++++++++++++++++++++++++++++*/	
	function spec_name($id)
	{
		$obr = "SELECT ID, NameSpec FROM SPEC WHERE ID = ".$id;	
		$res_obr = mysql_query($obr);
	    $row = mysql_fetch_array($res_obr, MYSQL_ASSOC); 
		echo $row["NameSpec"];
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  KratkoeName

+++++++++++++++++++++++++++++++++++*/	
	function spec_kratkoe($id)
	{
		$obr = "SELECT ID, KratkoeName FROM SPEC WHERE ID = ".$id;	
		$res_obr = mysql_query($obr);
	    $row = mysql_fetch_array($res_obr, MYSQL_ASSOC); 
		echo $row["KratkoeName"];
	}
/*++++++++++++++++++++++++++++++++++

photoOfStud

+++++++++++++++++++++++++++++++++++*/	
function photoOfStud($idstud)
	{
		
		$obr = "SELECT ID, fam, name, otch FROM INFO WHERE ID=".$idstud."";	
		$res_obr = mysql_query($obr);
		$row = mysql_fetch_array($res_obr, MYSQL_ASSOC); 
        	printf ($row["fam"]."_".$row["name"]."_".$row["otch"]);
		mysql_free_result($res_obr);
		
	}
/*++++++++++++++++++++++++++++++++++

Choose abiturient LIKE fam

+++++++++++++++++++++++++++++++++++*/	
	function choose_abitur_like_fam($like_fam)
	{
		
		$sql = "SELECT INFO.ID, INFO.fam, INFO.name, INFO.otch, INFO.data_rozhd FROM INFO WHERE INFO.fam LIKE '". $like_fam ."%' ORDER BY INFO.fam";	
		$result = mysql_query($sql);
		return $result;
	}
/*++++++++++++++++++++++++++++++++++

Choose abiturient LIKE fam with zhur

+++++++++++++++++++++++++++++++++++*/	
	function choose_abitur_like_fam_with_zhur($like_fam)
	{
		
		$sql = "SELECT DISTINCT ZHURNAL.IDstud, INFO.ID, INFO.fam, INFO.name, INFO.otch, INFO.data_rozhd FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud WHERE INFO.fam LIKE '". $like_fam ."%' ORDER BY INFO.fam";	
		$result = mysql_query($sql);
		return $result;
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  pol

+++++++++++++++++++++++++++++++++++*/	
	function pol()
	{

		$obr = "SELECT ID, POL FROM POL ORDER BY ID";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["POL"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  predmet

+++++++++++++++++++++++++++++++++++*/	
	function predmet($selected)
	{
		$obr = "SELECT ID, predmet FROM predmet ORDER BY ID";	
		$res_obr = mysql_query($obr);
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row['ID']){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row['ID']."'>");
        	printf ($row["predmet"]);
			printf("</option>");
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  predmet1

+++++++++++++++++++++++++++++++++++	

	function predme_name($id)
	{
		$obr = "SELECT ID, predmet FROM predmet WHERE ID = ".$id;	
		$res_obr = mysql_query($obr);
		$row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		echo $row["predmet"];
		mysql_free_result($res_obr);
	}*/	
/*++++++++++++++++++++++++++++++++++

TABLE -  VIDKURSOV

+++++++++++++++++++++++++++++++++++*/	
	function kyrsy()
	{
		$obr = "SELECT ID, VIDKURSOV FROM VIDKURSOV ORDER BY ID";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["VIDKURSOV"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  DOCUMENT

+++++++++++++++++++++++++++++++++++*/	
	function document()
	{
		$obr = "SELECT ID, DOCUMENT FROM DOCUMENT ORDER BY ID";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["DOCUMENT"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  INYAZ

+++++++++++++++++++++++++++++++++++*/	
	function language()
	{
		$obr = "SELECT ID, INYAZ FROM INYAZ ORDER BY ID";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["INYAZ"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  MEDAL

+++++++++++++++++++++++++++++++++++*/	
	function medal()
	{
		$obr = "SELECT ID, MEDAL FROM MEDAL ORDER BY ID";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["MEDAL"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  TYPYOFPLASE

+++++++++++++++++++++++++++++++++++*/	
	function typeofobjects()
	{
		$obr = "SELECT ID, name_st FROM TYPYOFPLASE ORDER BY ID";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["name_st"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  POSELOK

+++++++++++++++++++++++++++++++++++*/	
	function poselok()
	{
		$obr = "SELECT ID, POSELOK FROM POSELOK ORDER BY ID";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["POSELOK"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  OBRAZOVANIE

+++++++++++++++++++++++++++++++++++*/	
	function obrazovanie()
	{
		$obr = "SELECT ID, OBRAZOVANIE FROM OBRAZOVANIE ORDER BY ID";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["OBRAZOVANIE"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
	
/*++++++++++++++++++++++++++++++++++

TABLE -  OBWEZHITIE

+++++++++++++++++++++++++++++++++++*/	
	function obwezhitie()
	{
		$obr = "SELECT ID, OBWEZHITIE FROM OBWEZHITIE ORDER BY ID";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["OBWEZHITIE"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  prospect

+++++++++++++++++++++++++++++++++++*/	
	function prospect()
	{
		$obr = "SELECT ID, prospect FROM prospect ORDER BY ID";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["prospect"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  UCHZAVEDENIE

+++++++++++++++++++++++++++++++++++*/	
	function uchzavedenie()
	{
		$obr = "SELECT ID, UCHZAVEDENIE FROM UCHZAVEDENIE ORDER BY ID";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["UCHZAVEDENIE"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  subject

+++++++++++++++++++++++++++++++++++*/	
	function subject()
	{
		$obr = "SELECT rus_objects.id, rus_objects.russobject FROM rus_objects ORDER BY id";	
		$res_obr = mysql_query($obr);
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='");
        	printf ($row["russobject"]);
			printf("'/>");
		}
		mysql_free_result($res_obr);
	}

/*++++++++++++++++++++++++++++++++++

TABLE -  rus_penz_area

+++++++++++++++++++++++++++++++++++*/	
	function rus_penz_area()
	{
		$obr = "SELECT rus_penz_area.id, rus_penz_area.area FROM rus_penz_area ORDER BY rus_penz_area.id";	
		$res_obr = mysql_query($obr);
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='");
        	printf ($row["area"]);
			printf("'/>");
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  rus_penz_area_center

+++++++++++++++++++++++++++++++++++*/	
	function rus_penz_area_center()
	{
		$obr = "SELECT rus_penz_area_center.id, rus_penz_area_center.name FROM rus_penz_area_center ORDER BY rus_penz_area_center.id";	
		$res_obr = mysql_query($obr);
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='");
        	printf ($row["name"]);
			printf("'/>");
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++
TABLE -  country

+++++++++++++++++++++++++++++++++++*/	
	function country()
	{
		$obr = "SELECT id, country FROM country ORDER BY id";	
		$res_obr = mysql_query($obr);
		
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["id"]."'>");
        	printf ($row["country"]);
			printf("</option>");
			
		}
		mysql_free_result($res_obr);
	}

}


?>