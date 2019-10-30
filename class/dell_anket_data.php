<?php session_start();
include_once("get_function.php");
if (isset($_GET['id'])){
	$obj = new get_function();
	$obj->config();
	$sql = "DELETE FROM INFO WHERE ID=".$_GET['id'].";";
	//echo $sql;
	$result = mysql_query($sql);
	header('Location: ../index.php?pages=23&cl=24&fio='.$_GET['abit'].'');
	}
else {
	header('Location: ../index.php?pages=23&cl=24&fio='.$_GET['abit'].'');
	}
?>