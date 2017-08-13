<?php
	require_once('include/header.php');
?>
    <section id="rewards" class="container content-section rewards">
        <div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h3>Block Rewards by Date</h3>
				<div id="chart_rewards_date""></div>
				<br/>
			</div>
		</div>
        <div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h3>Block Rewards by Height</h3>
				<div id="chart_rewards_height"></div>
			</div>
		</div>
	</section>
    <section id="difficulty" class="container content-section difficulty">
        <div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h3>Network Difficulty</h3>
				<form class="form-horizontal">
					<div class="form-group">
						<label for="algo" class="col-sm-1 control-label">Algorithm</label>
						<div class="col-sm-4">
							<select class="form-control" name="algo" id="algo" onChange="drawDiff();">
								<option value="0">Lyra2re2</option>
								<option value="1">Skein</option>
								<option value="2">Qubit</option>
								<option value="3">Yescrypt</option>
								<option value="4">X11</option>
							</select>
						</div>
					</div>
				</form>
				<div id="chart_difficulty"></div>
			</div>
		</div>
	</section>
	
<?php	
	require_once('include/footer.php');
?>
