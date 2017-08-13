<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
    <title>
<?php
	$path = pathinfo($_SERVER['SCRIPT_FILENAME'],PATHINFO_FILENAME);
	
	if($path=='technology')
	{
		echo 'Unitus: Technology';
	}
	else if($path=='getstarted')
	{
		echo 'Unitus: Getting Started';
	}
	else if($path=='network')
	{
		echo 'Unitus: Network Status';
	}
	else
	{
		echo 'Unitus: Superior Blockchain Technology.';
	}
?>	
</title>

    <!-- Bootstrap Core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Custom Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!--<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Open+Sans%3A300%2C300italic%2C400%2C400italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2Cregular%2Cregular%2Cregular%2C300%2C300%2C300%2C300%2Cregular%2C600%2C&amp;subset=latin,latin-ext&amp;ver=4.4.2' type='text/css' media='all' />-->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">
    

    <!-- Theme CSS -->
    <link href="css/unitus.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <img src="images/unitus-logo.png" class="img-responsive block-left" />
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
<?php $class = $path=='home' ? 'active' : ''; ?>
                    <li class="<?php echo $class; ?>">
                        <a href="/home">Home</a>
                    </li>
<?php $class = $path=='technology' ? 'active' : ''; ?>
                    <li class="<?php echo $class; ?>">
                        <a href="/technology">Technology</a>
                    </li>
<?php $class = $path=='getstarted' ? 'active' : ''; ?>
                    <li class="<?php echo $class; ?>">
                        <a href="/getstarted">Getting Started</a>
                    </li>
<?php $class = $path=='network' ? 'active' : ''; ?>
                    <li class="<?php echo $class; ?>">
                        <a href="/network">Network Status</a>
                    </li>
<?php $class = $path=='stats' ? 'active' : ''; ?>
                    <li class="<?php echo $class; ?>">
                        <a href="/stats">Statistics</a>
                    </li>
                    <li>
                        <a href="https://explorer.unitus.online" target="_blank">Block Explorer</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
			
<?php
	if($path!='home')
	{
?>	
	<div class="container page-top hidden-xs">
	</div>
<?php
	}
?>
            <!-- Header part section END -->