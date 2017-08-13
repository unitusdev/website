<?php
	require_once('config.inc.php');
 	require_once('database.inc.php');

 	$dblink = dbinit();

	
	$url = "https://www.cryptopia.co.nz/api/GetMarket/2922";
	$data = json_decode(file_get_contents($url));
	if($data->Success)
	{
		$last = floatval($data->Data->LastPrice);
		$high = floatval($data->Data->High);
		$low = floatval($data->Data->Low);
		$volume = floatval($data->Data->Volume);
		
		save_xrate('Cryptopia',$last,$high,$low,$volume,$dblink);
	}
	
	$url = "http://api.coindesk.com/v1/bpi/currentprice.json";
	$data = json_decode(file_get_contents($url));
	if(isset($data->time))
	{
		$rate = floatval($data->bpi->USD->rate_float);
		save_xrate('CoinDesk',$rate,0,0,0,$dblink);
	}
	
	$xrate = 0;
	$vol = 0;
	$query = "SELECT last,volume FROM tblxrate WHERE exchange!='CoinDesk' GROUP BY exchange ORDER BY moment DESC ";
	$result = $dblink->query($query) OR dberror($dblink,$query);
	while($row = $result->fetch_row())
	{
		$xrate += $row[0] * $row[1];
		$vol += $row[1];
	}
	$xrate = roundsat($xrate / $vol);
	
	$query = "SELECT last FROM tblxrate WHERE exchange='CoinDesk' ORDER BY moment DESC LIMIT 0,1";
	$result = $dblink->query($query) OR dberror($dblink,$query);
	$row = $result->fetch_row();
	$usdbtc = $row[0];
	
	$supply = get_supply($dblink);	
	
	$query = "INSERT INTO tblmarketcap VALUES(NOW(),$supply," . roundsat($supply * $xrate) . "," . roundsat($supply * $xrate * $usdbtc) . ")";
	$dblink->query($query) OR dberror($dblink,$query);
	
	function save_xrate($exchange,$last,$high,$low,$volume,$dblink)
	{
		$query = "INSERT INTO tblxrate VALUES (NOW(),'$exchange',$last,$high,$low,$volume)";
		$dblink->query($query) OR dberror($dblink,$query);
	}
	
	function get_supply($dblink)
	{
		$query = "SELECT * FROM tblmiscdata WHERE name='uisinfo'";
		$result = $dblink->query($query) OR dberror($dblink,$query);
		$row = $result->fetch_row();
		$height = json_decode($row[2])->blocks;
		
		$query = "SELECT * FROM tblrewards WHERE $height>=start AND $height<=end";
		$result = $dblink->query($query) OR dberror($dblink,$query);
		$row = $result->fetch_row();

		$total = roundsat($row[3] + ($height-$row[0]) * $row[2]);
		return sprintf("%02.08f",$total);
	}
	
	function roundsat($value)
	{
		return floor($value*100000000)/100000000;
	}
?>
