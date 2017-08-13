<?php
	require_once('config.inc.php');

	function seconds2time($seconds)
	{
		$seconds = round($seconds/60,0);
		$m = $seconds % 60;
		$seconds = floor($seconds/60);
		$h = $seconds % 24;
		$d = floor($seconds/24);

		if($d>1)
		{
			$r = $d . ' days, ';
		}
		elseif($d==1)
		{
			$r = '1 day, ';
		}
		else
		{
			$r='';
		}
		if($h==1)
		{
			$r .= sprintf("%01.0f hour, ",$h);
		}
		else
		{
			$r .= sprintf("%01.0f hours, ",$h);
		}
		if($m==1)
		{
			$r .= sprintf("%01.0f minute",$m);
		}
		else
		{
			$r .= sprintf("%01.0f minutes",$m);
		}
		return $r;
	}

	function scale_rate($rate)
	{
		$output = '';

		if($rate<1e6)
		{
			$output = sprintf("%02.02f kH/s",round($rate/1e3,2));
		}
		elseif($rate<1e9)
		{
			$output = sprintf("%02.02f MH/s",round($rate/1e6,2));
		}
		elseif($rate<1e12)
		{
			$output = sprintf("%02.02f GH/s",round($rate/1e9,2));
		}
		elseif($rate<1e15)
		{
			$output = sprintf("%02.02f TH/s",round($rate/1e12,2));
		}
		else
		{
			$output = sprintf("%02.02f PH/s",round($rate/1e15,2));
		}


		return $output;
	}
	
	function roundsat($value)
	{
		return floor($value*100000000)/100000000;
	}
	
	function get_supply($dblink)
	{
		$COIN = 100000000;
		
		$query = "SELECT * FROM tblmiscdata WHERE name='uisinfo'";
		$result = $dblink->query($query) OR dberror($dblink,$query);
		$row = $result->fetch_row();
		$height = json_decode($row[2])->blocks;
		
		$query = "SELECT * FROM tblrewards WHERE $height>=start AND $height<=end";
		$result = $dblink->query($query) OR dberror($dblink,$query);
		$row = $result->fetch_row();

		$total = ($row[5] + ($height-$row[0]) * $row[4]) / $COIN;
		
		$output = new stdClass;
		$output->mined = sprintf("%02.08f",$total);
		
		$query = "SELECT data FROM tblmiscdata WHERE name='burnt'";
		$result = $dblink->query($query) OR dberror($dblink,$query);
		$row = $result->fetch_row();
		$output->burnt = sprintf("%02.08f",$row[0]);
		$output->burntprop = sprintf("%02.02f",round(100 * $row[0] / $total,2));
		$output->remaining = sprintf("%02.08f",$total - $row[0]);
		
		return $output;
	}
	
	
	function get_blockvalue($height)
	{
		$COIN = 100000000;
		
		if($height<1999)
		{
			$BlockValue = (1 << floor(($height+1)/300)) * $COIN;
		}
		elseif($height<3933199)
		{
			$BlockValue = floor(100 * pow(0.99,floor(($height-1999)/10080)) * $COIN);
		}
		else
		{
			$BlockValue = 2 * $COIN;
		}	
		return ($BlockValue / $COIN);
	}
	
	function get_uisxrate($dblink)
	{
		$xrate = 0;
		$vol = 0;
		$query = "SELECT last,volume FROM tblxrate WHERE exchange!='CoinDesk' ORDER BY moment DESC LIMIT 0,3";
		$result = $dblink->query($query) OR dberror($dblink,$query);
		while($row = $result->fetch_row())
		{
			$xrate += $row[0] * $row[1];
			$vol += $row[1];
		}
		$xrate = round($xrate / $vol,8);
		return $xrate;
	}
	
	function get_btcxrate($dblink)
	{
		$query = "SELECT last FROM tblxrate WHERE exchange='CoinDesk' ORDER BY moment DESC LIMIT 0,1";
		$result = $dblink->query($query) OR dberror($dblink,$query);
		$row = $result->fetch_row();
		return $row[0];
	}
?>