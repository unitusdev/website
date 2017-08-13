<?php
	require_once('include/header.php');
?>
    <!-- Intro Header -->
    <header class="intro" id="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
						<img src="images/unitus-header.png" class="img-responsive center-block" />
						<h3>Superior Blockchain Technology</h3>
						<img src="images/batman_polygon.png" class="img-responsive center-block" />
                        <a href="#multialgo" class="btn btn-lg page-scroll" style="color: white"><i class="fa fa-angle-down animated"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Multi Algorithm Section -->
    <section id="multialgo" class="container content-section multialgo">
        <div class="row">
            <div class="col-md-4 col-md-offset-2">
                <h1>Multi Algorithm</h1>
				<h2>5 independent algorithms</h2>
                <p>Unitus uses 5 independent algorithms to ensure the blockchain remains secure and can be mined by anyone, regardless of the hardware they have available to them. CPU, GPU or ASIC.<br/>No arms race here.</p>
				<a href="#intro" class="btn btn-lg page-scroll" style="color: black"><i class="fa fa-angle-up animated"></i></a>
				<a href="#mergemine" class="btn btn-lg page-scroll" style="color: black"><i class="fa fa-angle-down animated"></i></a>
            </div>
			<div class="col-md-4">
				<img width="540" height="324" src="images/cloud_image.jpg" class="img-responsive center-block" />
			</div>
        </div>
    </section>

    <!-- Merge Mineable Section -->
    <section id="mergemine" class="container content-section mergemine">
        <div class="row">
			<div class="col-md-4 col-md-offset-2">
				<img width="490" height="372" src="images/puzzle.jpg" class="img-responsive center-block" />
			</div>
            <div class="col-md-4">
                <h1>Merge Mineable</h1>
				<h2>Energy efficient</h2>
                <p>Merge mining allows a miner to mine a parent coin, whilst at the same time contribute network hashrate to Unitus - and earn both the parent coin's mining rewards and Unitus at the same time.</p>
				<a href="#multialgo" class="btn btn-lg page-scroll" style="color: white"><i class="fa fa-angle-up animated"></i></a>
				<a href="#distribution" class="btn btn-lg page-scroll" style="color: white"><i class="fa fa-angle-down animated"></i></a>
            </div>
        </div>
    </section>

    <!-- Distribution Section -->
    <section id="distribution" class="container content-section distribution">
        <div class="row">
            <div class="col-md-4 col-md-offset-2">
                <h1>Fair Distribution</h1>
				<h2>No Premine / ICO / Developer Tax</h2>
                <p>No Premine, ICO or Developer Tax. Just pure miner reward. Gradual decline in block rewards, more resembling the natural decline of a valuable resource.</p>
				<a href="#mergemine" class="btn btn-lg page-scroll" style="color: black"><i class="fa fa-angle-up animated"></i></a>
				<a href="#video" class="btn btn-lg page-scroll" style="color: black"><i class="fa fa-angle-down animated"></i></a>
            </div>
			<div class="col-md-4">
				<img width="319" height="409" src="images/deer.jpg" class="img-responsive center-block" />
			</div>
        </div>
    </section>

    <!-- Video Section -->
    <section id="video" class="container content-section video">
        <div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="embed-responsive embed-responsive-16by9 center-block">
					<iframe src="https://player.vimeo.com/video/213761358" width="1280" height="720" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					<p><a href="https://vimeo.com/213761358">UNITUS</a> from <a href="https://vimeo.com/user65573426">Marianne</a> on <a href="https://vimeo.com">Vimeo</a>.</p>				
				</div>
				<a href="#distribution" class="btn btn-lg page-scroll" style="color: white"><i class="fa fa-angle-up animated"></i></a>
				<a href="#history" class="btn btn-lg page-scroll" style="color: white"><i class="fa fa-angle-down animated"></i></a>
			</div>
        </div>
    </section>
	
    <!-- History Section -->
    <section id="history" class="container content-section history">
        <div class="row">
			<div class="col-md-4 col-md-offset-2">
				<img width="370" height="144" src="images/evolve.png" class="img-responsive center-block" />
			</div>
            <div class="col-md-4">
                <h1>History</h1>
				<h2>Key moments in the history of Unitus</h2>
                <ul class="list-unstyled">
					<li>December 2014 - Announcement of Unitus</li>
					<li>27th December 2014 - Release of Unitus, mining begins</li>
					<li>29th December 2014 - Unitus begins trading on major crypto-currency exchanges</li>
					<li>11th January 2015 - Version 0.9.3.1 released (bug fixes & maintenance)</li>
					<li>30th May 2015 - Version 0.9.5 released, core code updated to Bitcoin 0.9.5</li>
					<li>11th January 2016 - Version 0.9.6 released, changes to sequential block rules and changes one algorithm from Blake256 to Lyra2re2</li>
					<li>February 2016 - Hardfork occurs, Blake256 replaced with Lyra2re2</li>
					<li>3rd January 2017 - Version 0.9.6.4 released, (bug fixes & maintenance)</li>
					<li>30th April 2017 - Version 0.9.7.0 released, replaces Qubit with Argon2d (hardfork @ June 3rd 2017)</li>
				</ul>
				<a href="#video" class="btn btn-lg page-scroll" style="color: white"><i class="fa fa-angle-up animated"></i></a>
            </div>
        </div>
    </section>
	
<?php	
	require_once('include/footer.php');
?>