$(document).ready(function() {
	$(document).trigger('init');
});

var intervalFigures = 60;

$(document).on('init', function(e, eventInfo) {
	$(document).trigger('update_blocks');
	$(document).trigger('update_status');
});

setInterval(function() {
	$(document).trigger('update_blocks');
	$(document).trigger('update_status');
}, intervalFigures * 1000);

$(document).on('update_status', function(e, eventInfo) {
	$.getJSON('/json/status.php', function(data) {
		if(data) {
			$('#peers').empty();
			$.each(data.Peers, function(key, peer) {
				if(peer.direction=='Inbound')
				{
					dir = '<span class="glyphicon glyphicon-arrow-left"></span> Inbound';
				}
				else
				{
					dir = '<span class="glyphicon glyphicon-arrow-right"></span> Outbound';
				}
				if(peer.versionid<data.VersionID)
				{
					ver = '<span class="label label-danger">' + peer.version + '</span>';
				}
				else
				{
					ver = '<span class="label label-success">' + peer.version + '</span>';
				}
				var ip = '';
				if(peer.ip==6)
				{
					ip = ' <span class="label label-success">IPv6!</span>'
				}
				tr = $('<tr/>').append($('<td/>').text(peer.address).append(ip)).append($('<td/>').append(dir)).append($('<td/>').append(ver));
				$('#peers').append(tr);
			});

			$('#lastupdate').text(data.Updated);
			$('#blake256_hashrate').text(data.BLK_hash);
			$('#blake256_difficulty').text(data.BLK_diff);
			$('#skein_hashrate').text(data.SKN_hash);
			$('#skein_difficulty').text(data.SKN_diff);
			$('#qubit_hashrate').text(data.QUB_hash);
			$('#qubit_difficulty').text(data.QUB_diff);
			$('#yescrypt_hashrate').text(data.YES_hash);
			$('#yescrypt_difficulty').text(data.YES_diff);
			$('#x11_hashrate').text(data.X11_hash);
			$('#x11_difficulty').text(data.X11_diff);

			$('#net_block').text(data.Blocks);
			$('#net_value').text(data.BlockValue);
			$('#net_mined').text(data.Supply);
			$('#net_burnt').text(data.Burnt);
			$('#net_remaining').text(data.Remaining);
			$('#uisbtc').text("1 UIS = " + data.RateBTC);
			$('#uisusd').text("1 UIS = " + data.RateUSD);
			$('#capbtc').text(data.MarketCapBTC);
			$('#capusd').text(data.MarketCapUSD);
			$('#wallet_version').text(data.Version);
			$('#wallet_peercount').text(data.PeerCount);
		};
	});
});

$(document).on('update_blocks', function(e, eventInfo) {
	$.getJSON('/json/blocks.php', function(data) {
		if(data) {
			$('#recent_blocks').empty();
			$.each(data.Blocks, function(key, block) {
				block_explorer = $('<a/>').attr('href','http://explorer.unitus.online/block/' + block.Hash).attr('target', '_blank').text(block.Height);
				
				tr = $('<tr/>').attr('id', block.Height);
				tr.append($('<td/>').append(block_explorer));

				tr.append($('<td/>').append(block.Time));
				tr.append($('<td/>').append(block.Algorithm));
				tr.append($('<td/>').append(block.Difficulty));
				if(block.AuxPoW)
				{
					tr.append($('<td/>').append('<span class="label label-success">Yes<span>'));
				}
				else
				{
					tr.append($('<td/>').append('<span class="label label-danger">No</span>'));
				}
				tr.append($('<td/>').append(block.Hash));
				$('#recent_blocks').append(tr);
			});

			$('#block_stats').empty();
			$.each(data.Stats, function(key, period) {
				tr = $('<tr/>').append($('<td/>').text(period.Period)).append($('<td/>').text(period.TotalBlocks));
				$.each(period.Algo, function(key, algo) {
					tr.append($('<td/>').text(algo.Count));
					tr.append($('<td/>').text(algo.Difficulty));
					tr.append($('<td/>').text(algo.Hashrate));
				});
				$('#block_stats').append(tr);
			});
		};
	});
});