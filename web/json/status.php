<?php
	require_once('../include/database.inc.php');
	require_once('../include/functions.inc.php');

	$algos[0] = 'Blake';
	$algos[1] = 'Skein';
	$algos[2] = 'Qubit';
	$algos[3] = 'Yescrypt';
	$algos[4] = 'X11';

	$dblink = dbinit();
	$info = new stdClass;


	$info->Peers = array();

	$query = "SELECT address,direction,version,addressType FROM tblpeers WHERE connected=1 ORDER BY addressType,addressHex";
	$result = $dblink->query($query) OR dberror($dblink,$query);
	$i=0;
	while($row = $result->fetch_row())
	{
		$info->Peers[$i] = new stdClass;
		$info->Peers[$i]->address = $row[0];
		$info->Peers[$i]->direction = $row[1];
		$info->Peers[$i]->version = $row[2];
		$info->Peers[$i]->versionid = wallet_versionid($row[2]);
		$info->Peers[$i]->ip = (int)substr($row[3],3,1);
		$i++;
	}

	$info->PeerCount = $i;

	function wallet_versionid($version)
	{
		$parts = explode('.',$version);
		if(!isset($parts[3]))
		{
			$parts[3] = 0;
		}
		$id = $parts[3] + 100 * $parts[2] + 10000 * $parts[1] + 1000000 * $parts[0];
		return $id;
	}

	function wallet_version($versionid)
	{
		$p3 = ($versionid % 100);
		$versionid = floor($versionid/100);
		$p2 = ($versionid % 100);
		$versionid = floor($versionid/100);
		$p1 = ($versionid % 100);
		$versionid = floor($versionid/100);
		$p0 = ($versionid % 100);

		$v = $p0 . '.' . $p1 . '.' . $p2 . '.' . $p3;

		return $v;
	}

	$query = "SELECT updated,data FROM tblmiscdata WHERE name='uisinfo'";
	$result = $dblink->query($query) OR dberror($dblink,$query);
	$row = $result->fetch_row();

	$info->Updated = gmdate('D jS M H:i:s e',strtotime($row[0]));

	$data = json_decode($row[1]);

	$info->VersionID = $data->version;
	$info->Version = wallet_version($data->version);
	$info->Blocks = $data->blocks;
	$supply = get_supply($dblink);
	$info->Supply =  $supply->mined . ' UIS';
	$info->Burnt = $supply->burnt . ' UIS (' . $supply->burntprop . '%)';
	$info->Remaining = $supply->remaining . ' UIS';
	$info->BLK_diff = $data->difficulty_lyra2re2;
	$info->SKN_diff = $data->difficulty_skein;
	$info->QUB_diff = $data->difficulty_qubit;
	$info->YES_diff = $data->difficulty_yescrypt;
	$info->X11_diff = $data->difficulty_X11;

	$info->BLK_hash = scale_rate($data->difficulty_lyra2re2 * pow(2,32) / 300);
	$info->SKN_hash = scale_rate($data->difficulty_skein * pow(2,32) / 300);
	$info->QUB_hash = scale_rate($data->difficulty_qubit * pow(2,32) / 300);
	$info->X11_hash = scale_rate($data->difficulty_X11 * pow(2,32) / 300);
	$info->YES_hash = scale_rate($data->difficulty_yescrypt * pow(2,32) / 300);

	if($data->blocks<1999)
	{
		$info->BlockValue = sprintf("%01.08f UIS",roundsat(1 << floor(($data->blocks+1)/300)));
	}
	elseif($data->blocks<3933199)
	{
		$info->BlockValue = sprintf("%01.08f UIS",roundsat(100 * pow(0.99,floor(($data->blocks-1999)/10080))));
	}
	else
	{
		$info->BlockValue = sprintf("%01.08f UIS",2);
	}	
	
	$xrate = 0;
	$vol = 0;
	$query = "SELECT last,volume FROM tblxrate WHERE exchange='Cryptopia' ORDER BY moment DESC LIMIT 0,1";
	$result = $dblink->query($query) OR dberror($dblink,$query);
	$row = $result->fetch_row();
	$xrate = $row[0];
	
	$query = "SELECT last FROM tblxrate WHERE exchange='CoinDesk' ORDER BY moment DESC LIMIT 0,1";
	$result = $dblink->query($query) OR dberror($dblink,$query);
	$row = $result->fetch_row();
	$usdbtc = $row[0];

	$info->RateBTC = sprintf("%02.08f BTC",$xrate);
	$info->RateUSD = sprintf("$%02.04f USD",round($xrate * $usdbtc,4));
	$info->MarketCapBTC = sprintf("%02.08f BTC",round($xrate * floatval($supply->remaining),8));
	$info->MarketCapUSD = sprintf("$%02.02f USD",round($xrate * floatval($supply->remaining) * $usdbtc,2));
	
	$dblink->close();

	header('Content-type: application/json');
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	header('Expires: 0');

	echo json_encode($info);


?>