<?php

	require_once('config.inc.php');
 	require_once('database.inc.php');
	require_once('rpc.php');

 	$dblink = dbinit();

	function rpc_getblock($wallet,$hash)
	{
		$command = '{"jsonrpc": "1.0", "id":"curltest", "method": "getblock", "params": [ "' . $hash . '" ] }';
		$result = rpc_base($wallet,$command);
		return $result;
	}

	function rpc_getpeerinfo($wallet)
	{
		$command = '{"jsonrpc": "1.0", "id":"curltest", "method": "getpeerinfo", "params": [  ] }';
		$result = rpc_base($wallet,$command);
		return $result;
	}

	function rpc_getblockhash($wallet,$index)
	{
		$command = '{"jsonrpc": "1.0", "id":"curltest", "method": "getblock", "params": [ "' . $index . '" ] }';
		$result = rpc_base($wallet,$command);
		return $result;
	}

	function get_iptype($address)
	{
		$address = trim($address);
		if($address==filter_var($address,FILTER_VALIDATE_IP))
		{
			if($address==filter_var($address,FILTER_VALIDATE_IP,FILTER_FLAG_IPV4))
			{
				if($address!=filter_var($address,FILTER_VALIDATE_IP,FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE))
				{
					return 'IPV4_PRIVATE';
				}
				elseif($address!=filter_var($address,FILTER_VALIDATE_IP,FILTER_FLAG_IPV4 | FILTER_FLAG_NO_RES_RANGE))
				{
					return 'IPV4_RESERVED';
				}
				else
				{
					return 'IPV4';
				}
			}
			elseif($address==filter_var($address,FILTER_VALIDATE_IP,FILTER_FLAG_IPV6))
			{
				if($address!=filter_var($address,FILTER_VALIDATE_IP,FILTER_FLAG_IPV6 | FILTER_FLAG_NO_PRIV_RANGE))
				{
					return 'IPV6_PRIVATE';
				}
				elseif($address!=filter_var($address,FILTER_VALIDATE_IP,FILTER_FLAG_IPV6 | FILTER_FLAG_NO_RES_RANGE))
				{
					return 'IPV6_RESERVED';
				}
				else
				{
					return 'IPV6';
				}			
			}
			else
			{
				return 'INVALID';
			}
		}
		else
		{
			return 'INVALID';
		}
	}
	
	print "UIS| " . date("H:i:s");

	$info = rpc_getinfo($wallet);
	if($info->status == 'SUCCESS')
	{
		$myrinfo = json_encode($info->json_output->result);
		$query = "UPDATE tblmiscdata SET updated=NOW(),data='$myrinfo' WHERE name='uisinfo'";
		$dblink->query($query) OR dberror($dblink,$query);
		$blocks = $info->json_output->result->blocks;
		print " Best Block: $blocks.\r\n";
	}
	else
	{
		echo $info->statusmsg;
	}



	$query = "SELECT hash,height FROM tblnetworkblocks ORDER BY height DESC LIMIT 0,1";
	$result = $dblink->query($query) OR dberror($dblink,$query);
	if($result->num_rows==0)
	{
		$hash = 'd8a2b2439d013a59f3bfc626a33487a3d7d27e42a3c9e0b81af814cd8e592f31';
	}
	else
	{
		$row = $result->fetch_row();
		$hash = $row[0];
		//print "Checking block $row[1], hash $row[0]\r\n";
		$info = rpc_getblock($wallet,$hash);
		if($info->status == 'SUCCESS')
		{
			if(isset($info->json_output->result->nextblockhash))
			{
				$hash = $info->json_output->result->nextblockhash;
			}
			else
			{
				if($row[1]<$blocks) // is best block in DB less than blockchain, yet no next hash available? Orphan found in last block
				{
					// delete top block from DB
					print " Deleting Orphan block $hash.";
					$query = "DELETE FROM tblnetworkblocks WHERE hash='$hash'";
					$dblink->query($query) OR dberror($dblink,$query);

					$query = "SELECT hash,height FROM $tableName ORDER BY height DESC LIMIT 0,1";
					$result = $dblink->query($query) OR dberror($dblink,$query);
					$row = $result->fetch_row();
					$hash = $row[0];
					$info = rpc_getblock($wallet,$hash);
					if($info->status == 'SUCCESS')
					{
						if(isset($info->json_output->result->nextblockhash))
						{
							$hash = $info->json_output->result->nextblockhash;
						}
						else
						{
							$hash = '';
						}
					}
				}
				else
				{
					$hash = '';
				}
			}
		}
		else
		{
			echo $info->statusmsg;
			$hash = '';
		}
	}

	$algo_last = array();
	$last = 0;
	for($a=0; $a<=4; $a++)
	{
		$query = "SELECT time FROM tblnetworkblocks WHERE pow_algo=$a ORDER BY height DESC LIMIT 0,1";
		$result = $dblink->query($query) OR dberror($dblink,$query);
		$row = $result->fetch_row();
		$algo_last[$a] = $row[0];
		if($row[0]>$last)
		{
			$last = $row[0];
		}
	}


	while($hash!='')
	{
		$info = rpc_getblock($wallet,$hash);
		if($info->status == 'SUCCESS')
		{
			$height = $info->json_output->result->height;
			$algo = $info->json_output->result->pow_algo_id;
			$version = $info->json_output->result->version;
			$pow_hash = $info->json_output->result->pow_hash;
			$time = $info->json_output->result->time;
			$diff = $info->json_output->result->difficulty;
			$nonce = $info->json_output->result->nonce;
			$coinbase = '';
			if(isset($info->json_output->result->auxpow))
			{
				$auxpow = 1;
				$nonce = $info->json_output->result->auxpow->parent_block->nonce;
				$coinbase = $info->json_output->result->auxpow->coinbasetx->vin[0]->coinbase;
			}
			else
			{
				$auxpow = 0;
			}
			$algo_elapsed = $time - $algo_last[$algo];
			$algo_last[$algo] = $time;
			$elapsed = $time - $last;
			$last = $time;

			$query = "INSERT INTO tblnetworkblocks VALUES('$hash',$height,$algo,'$pow_hash',$diff,$time,FROM_UNIXTIME($time),$elapsed,$algo_elapsed,$nonce,$auxpow,$version,'$coinbase','')";
			$dblink->query($query) OR dberror($dblink,$query);

			print " $height";

			if(isset($info->json_output->result->nextblockhash))
			{
				$hash = $info->json_output->result->nextblockhash;
			}
			else
			{
				$hash = '';
			}
		}
		else
		{
			echo $info->statusmsg;
			$hash = '';
		}
	}

	print "\r\n";

	$peers = rpc_getpeerinfo($wallet);

	if($peers->status == 'SUCCESS')
	{
		foreach($peers->json_output->result as $peer)
		{
			if(substr(trim($peer->addr),0,1)=='[')
			{
				
				$ip = substr(trim($peer->addr),1,strpos($peer->addr,']:')-1);
				//print "$peer->addr -> $ip \r\n";
			}
			else
			{
				$ip = trim(substr($peer->addr,0,strpos($peer->addr,':')));
			}
			$iptype = get_iptype($ip);
			if($iptype=='IPV4' || $iptype=='IPV6')
			{
				if($peer->inbound)
				{
					$dir = "Inbound";
				}
				else
				{
					$dir = "Outbound";
				}
				$version = trim(substr($peer->subver,strpos($peer->subver,':')+1)," \t\n\r\0\x0B/");
				//print "IP: $ip, Direction: $dir, Version: $version \r\n";

				$query = "SELECT address FROM tblpeers WHERE address = '$ip'";
				$result = $dblink->query($query) OR dberror($dblink,$query);
				if($result->num_rows==0)
				{
					if($iptype=='IPV4')
					{
						$query = "INSERT INTO tblpeers VALUES('$ip','$dir','$version',NOW(),1,'$iptype',HEX(INET_ATON('$ip')))";
					}
					else
					{
						$query = "INSERT INTO tblpeers VALUES('$ip','$dir','$version',NOW(),1,'$iptype',HEX(INET6_ATON('$ip')))";
					}
				}
				else
				{
					$query = "UPDATE tblpeers SET direction='$dir',version='$version',lastseen=NOW(),connected=1 WHERE address='$ip'";
				}
				$dblink->query($query) OR dberror($dblink,$query);
			}
		}

		$query = "UPDATE tblpeers SET connected=0 WHERE lastseen<DATE_ADD(NOW(),INTERVAL -5 MINUTE)";
		$dblink->query($query) OR dberror($dblink,$query);
	}
	else
	{
		echo $peers->statusmsg;
	}


	$data = json_decode(file_get_contents("http://explorer.unitus.online/json/address.php?address=UMz1xPGbHGWacUUtfXefyXWVoJX9Q2kNtF"));
	
	if(isset($data->balance))
	{
		$query = "UPDATE tblmiscdata SET data='$data->balance',updated=NOW() WHERE name='burnt'";
		$dblink->query($query) OR dberror($dblink,$query);
	}

?>
