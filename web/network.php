<?php
	require_once('include/header.php');
	require_once('include/database.inc.php');
?>
    <!-- Status Section -->
    <section id="status" class="container content-section status">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="row">
					<div class="col-md-6 table-responsive"><!-- start of column -->
						<h2>Network Status</h2>
						<table class="table table-condensed small">
							<tr><td class="name">Last Updated</td><td id="lastupdate"></td></tr>
							<tr><td class="name">Local Wallet Version</td><td id="wallet_version"></td></tr>
							<tr><td class="name">Wallet Peer Count</td><td id="wallet_peercount"></td></tr>
							<tr><td class="name">Current Block</td><td id="net_block"></td></tr>
							<tr><td class="name">Current Block Value</td><td id="net_value"></td></tr>
							<tr><td class="name">Total Mined Value</td><td id="net_mined"></td></tr>
							<tr><td class="name">Coins Burnt (<a href="https://bitcointalk.org/index.php?topic=1121974.msg13417604#msg13417604" target="_blank">?</a>)</td><td id="net_burnt"></td></tr>
							<tr><td class="name">Remaining Supply</td><td id="net_remaining"></td></tr>
							<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
							<tr><td class="name">Lyra2RE2 Hashrate</td><td id="blake256_hashrate"></td></tr>
							<tr><td class="name">Lyra2RE2 Difficulty</td><td id="blake256_difficulty"></td></tr>
							<tr><td class="name">Skein Hashrate</td><td id="skein_hashrate"></td></tr>
							<tr><td class="name">Skein Difficulty</td><td id="skein_difficulty"></td></tr>
							<tr><td class="name">Argon2d Hashrate</td><td id="qubit_hashrate"></td></tr>
							<tr><td class="name">Argon2d Difficulty</td><td id="qubit_difficulty"></td></tr>
							<tr><td class="name">Yescrypt Hashrate</td><td id="yescrypt_hashrate"></td></tr>
							<tr><td class="name">Yescrypt Difficulty</td><td id="yescrypt_difficulty"></td></tr>
							<tr><td class="name">X11 Hashrate</td><td id="x11_hashrate"></td></tr>
							<tr><td class="name">X11 Difficulty</td><td id="x11_difficulty"></td></tr>
						</table>
						<p><small><em>Please Note: Hash rates are calculated from current algorithm difficulties</em></small></p>

						<h2>Markets</h2>
							<table class="table table-condensed small">
								<tbody>
									<tr><td>Exchange Rate BTC <sup>1</sup></td><td id="uisbtc"></td></tr>
									<tr><td>Exchange Rate USD <sup>2</sup></td><td id="uisusd"></td></tr>
									<tr><td>Market Capitalisation BTC</td><td id="capbtc"></td></tr>
									<tr><td>Market Capitalisation USD</td><td id="capusd"></td></tr>
								</tbody>
							</table>
						<small>
						<ol>
							<li>From the last trade from <a href="https://www.cryptopia.co.nz/Exchange/?market=UIS_BTC" target="_blank">Cryptopia</a></li>
							<li>Derived from the BTC / USD rate from <a href="http://www.coindesk.com/price" target="_blank">CoinDesk</a></li>
						</ol>
						</small>
						
						<br/>
						<script type="text/javascript" src="https://files.coinmarketcap.com/static/widget/currency.js"></script>
						<div class="coinmarketcap-currency-widget" data-currency="unitus" data-base="USD"  data-secondary="BTC" style="background-color: #43A3CC;"></div>
					</div> <!-- end of column -->
					
					<div class="col-md-6 table-responsive"><!-- start of column -->
						<h2>Wallet Peers</h2>
						<table class="table table-condensed small">
							<thead>
								<tr>
									<th>Address</th>
									<th>Direction</th>
									<th>Version</th>
								</tr>
							</thead>
							<tbody id="peers">
							</tbody>
						</table>
						<h2>Reward Schedule</h2>
						<table class="table table-condensed small">
							<thead>
								<tr>
									<th>Height</th>
									<th>Reward</th>
								</tr>
							</thead>
							<tbody>
<?php
	$dblink = dbinit();
	
	$query = "SELECT height FROM tblnetworkblocks ORDER BY height DESC LIMIT 0,1";
	$result = $dblink->query($query) OR dberror($dblink,$query);
	$row = $result->fetch_row();
	
	$query = "SELECT start,end,blockval FROM tblrewards WHERE start>=($row[0]-30000) ORDER BY start LIMIT 0,12";
	$result = $dblink->query($query) OR dberror($dblink,$query);
	while($row = $result->fetch_row())
	{
		print "<tr>";
		print "<td>$row[0] - $row[1]</td>";
		print "<td>$row[2] UIS</td>";
		print "</tr>\n";
	}
?>
							</tbody>
						</table>
						<p><small><em>Table updated as each reduction is reached</em></small></p>
					</div> <!-- end of column -->
				</div> <!-- end of row -->
			</div>
		</div>
	</section>
				
    <section id="statistics" class="container content-section statistics">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="row table-responsive">
					<h2>Block Statistics</h2>
					<table class="table table-condensed small">
						<thead>
							<tr>
								<th rowspan="2">Period</th>
								<th rowspan="2">Total Blocks</th>
								<th colspan="3">Lyra2RE2</th>
								<th colspan="3">Skein</th>
								<th colspan="3">Argon2d</th>
								<th colspan="3">Yescrypt</th>
								<th colspan="3">X11</th>
							</tr>
							<tr>
								<th>Blocks</th>
								<th>Avg. Difficulty</th>
								<th>Avg. Hashrate</th>
								<th>Blocks</th>
								<th>Avg. Difficulty</th>
								<th>Avg. Hashrate</th>
								<th>Blocks</th>
								<th>Avg. Difficulty</th>
								<th>Avg. Hashrate</th>
								<th>Blocks</th>
								<th>Avg. Difficulty</th>
								<th>Avg. Hashrate</th>
								<th>Blocks</th>
								<th>Avg. Difficulty</th>
								<th>Avg. Hashrate</th>
							</tr>
						</thead>
						<tbody id="block_stats">
						</tbody>
					</table>					
				</div>
			</div>
		</div>
	</section>

    <section id="blocks" class="container content-section blocks">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="row table-responsive">
					<h2>Recent Blocks</h2>
					<table class="table table-condensed small">
						<thead>
							<tr>
								<th>Height</th>
								<th>Time</th>
								<th>Algorithm</th>
								<th>Difficulty</th>
								<th>Merge Mined</th>
								<th>Hash</th>
							</tr>
						</thead>
						<tbody id="recent_blocks">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>

<?php	
	require_once('include/footer.php');
?>
