<?php
	require_once('../include/database.inc.php');
	require_once('../include/functions.inc.php');
	
	$dblink = dbinit();
	
	$info = new stdClass;

	$info->data = array();
	$info->sucess = true;
	$info->data[0][0] = 'Height';
	$info->data[0][1] = 'Reward';
	$info->data[0][2] = 'Total';
	
	$query = "SELECT start,blockval,startval FROM tblrewards";
	$result = $dblink->query($query) OR dberror($dblink,$query);
	$i = 1;
	while($row = $result->fetch_row())
	{
		$info->data[$i][0] = intval($row[0]);
		$info->data[$i][1] = floatval($row[1]);
		$info->data[$i][2] = floatval($row[2]);
		$i++;
	}
	

	header('Content-type: application/json');
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	header('Expires: 0');

	echo json_encode($info);

?>