<?php

	require_once('config.inc.php');
 	require_once('database.inc.php');
	require_once('rpc.php');

 	$dblink = dbinit();

	$COIN = 100000000;

	$total = 1 * $COIN;
	$start = 1;
	$end = 0;
	$reward = 0;
	
	// print "Max INT: ";
	// var_dump(PHP_INT_MAX);
	// print "\r\n\r\n";
	
	
	
	for($i=1; $i<=4000000; $i++)
	{

		if($i<1999)
		{
			$newreward = (1 << floor(($i+1)/300)) * $COIN;

		}
		else
		{
			$newreward = floor(100 * pow(0.99,floor(($i-1999)/10080)) * $COIN);
			if($newreward < (2 * $COIN))
			{
				$newreward = 2 * $COIN;
			}
		}

		if($newreward!=$reward)
		{
			if($reward!=0)
			{
				$end = $i-1;
				print "Start: $start, End: $end, Reward: $reward, Total: " . sprintf("%d",$total) . " \r\n";
				//$query = "INSERT INTO tblrewards VALUES($start,$end,$reward,$total)";
				$query = "UPDATE tblrewards SET blocksat=$reward, startsat=$total WHERE start=$start AND end=$end";
				//$dblink->query($query) OR dberror($dblink,$query);
			}
			$reward = $newreward;
			$start = $i;
			//print "Height $i, Reward = $reward, Total = $total.\r\n";
		}
		$total += $newreward;
	}	
	
	
function roundsat($value)
{
	return floor($value*100000000)/100000000;
}
	
	
	
?>
