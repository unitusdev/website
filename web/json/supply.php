<?php
	require_once('../include/database.inc.php');
	require_once('../include/functions.inc.php');
	
	
	$dblink = dbinit();

	echo json_encode(get_supply($dblink));

	
?>