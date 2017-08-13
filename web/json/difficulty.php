<?php
	require_once('../include/database.inc.php');
	require_once('../include/functions.inc.php');
	
	$dblink = dbinit();
	
	$info = new stdClass;

	$info->data = array();
	$info->sucess = true;
	
	$algo = 0;
	if(isset($_GET['algo']))
	{
		$algo = intval($dblink->real_escape_string($_GET['algo']));
	}
	
	$info->data[0][0] = 'Height';
	$info->data[0][1] = 'Difficulty';
	
	$query = "SELECT height,difficulty FROM tblnetworkblocks WHERE pow_algo=$algo AND moment>=DATE_ADD(NOW(),INTERVAL -4 WEEK) ORDER BY height";
	$result = $dblink->query($query) OR dberror($dblink,$query);
	$i = 1;
	while($row = $result->fetch_row())
	{
		$info->data[$i][0] = intval($row[0]);
		$info->data[$i][1] = floatval($row[1]);
		$i++;
	}
	

	header('Content-type: application/json');
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	header('Expires: 0');

	echo json_encode($info);

?>