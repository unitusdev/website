    <!-- Footer -->
    <footer class="container footer">
        <div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="row">
					<div class="col-md-4">
						<h3><i class="fa fa-users" aria-hidden="true"></i> About Unitus</h3>
						<p class="small">Unitus uses 5 independant algorithms to ensure the blockchain remains secure and can be mined by anyone, regardless of the hardware they have available to them.</p>
					</div>
					<div class="col-md-4">
						<h3><i class="fa fa-envelope-o" aria-hidden="true"></i> Contact Us</h3>
						<p class="small">Should you require any additional information or have some question please feel free to contact us!</br>
						<a href="mailto:squirrell@nutty.one">E-mail</a></p>
					</div>
					<div class="col-md-4">
						<h3><i class="fa fa-twitter" aria-hidden="true"></i> Follow Us</h3>
						<ul class="list-unstyled">
							<li><a href="https://bitcointalk.org/index.php?topic=1121974" target="_blank"><i class="fa fa-bitcoin"></i>&nbsp;&nbsp;Bitcointalk</a></li>
							<li><a href="http://unitus.herokuapp.com/" target="_blank"><i class="fa fa-slack"></i>&nbsp;&nbsp;Slack</a></li>
							<li><a href="http://www.reddit.com/r/Unitus" target="_blank"><i class="fa fa-reddit"></i>&nbsp;&nbsp;Reddit</a></li>
							<li><a href="https://twitter.com/UnitusCoin" target="_blank"><i class="fa fa-twitter"></i>&nbsp;&nbsp;Twitter</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<hr/>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<a href="/"><img src="images/unitus-logo.png" width="70" height="70" class="img-responsive left-block" /></a>
					</div>
					<div class="col-md-6">
						<div class="text-right">Unitus &copy; 2017 Unitus Developers</div>
					</div>
				</div>
			</div>
		</div>
    </footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

	<!-- Google Analytics -->
	<script src="js/googleana.js"></script>
	
    <!-- Theme JavaScript -->
    <script src="js/unitus.js"></script>
<?php
	if($path=='network')
	{
		print '<script src="js/network.js"></script>';
	}
	elseif($path=='stats')
	{
		print '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>';
		print '<script src="js/stats.js"></script>';
	}
?>

</body>
</html>