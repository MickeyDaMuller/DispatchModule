<?php
session_start();
if(!isset($_SESSION['login_webservice']))
	{
		header("Location: login.php");	
	}
	include('../link.inc.php');
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Subscribers</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
		</noscript>
		
		<style type="text/css">
<!--
@import url("style.css");
-->
</style>
<script language="javascript" src="calendar/calendar.js"></script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
<link href="pagination/css/pagination.css" rel="stylesheet" type="text/css" />
	<link href="pagination/css/grey.css" rel="stylesheet" type="text/css" />
	</head>
	
	<body class="left-sidebar">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Content -->
					<div id="content">
						<div id="content-inner">
					
							<!-- Post -->
								<article class="is-post is-post-excerpt">
									<header>
										
										<h2><a href="#"><?php echo $site_short ?> Dispatch Page </a></h2>
										<span class="byline">Import Subscribers </span>
									</header>
									<div class="info">
										
										<span class="date"><span class="month"><?php echo date('m'); ?><span></span></span> <span class="day"><?php echo date('d'); ?></span><span class="year">, 2013</span></span>
										
										
									</div>
									
									
									<div class="license-form">
<iframe src="import_followers.php" width="100%" height="400px" scrolling="yes"></iframe>
  
</div>

							
									
								</article>
						

						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
					
						<!-- Logo -->
							<div id="logo">
								<h1><?php echo $site_short ?></h1>
							</div>
					
						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li ><a href="index.php">Home</a></li>
									<li><a href="newsletters.php">Archives</a></li>
									<li><a href="subscriptions.php">Subscriptions</a></li>
									<li class="current_page_item"><a href="subscribers.php">Subscribers</a></li>
									<li><a href="logout.php">Logout</a></li>
								</ul>
							</nav>

						<!-- Search -->
							<section class="is-search">
								
									<input type="text" class="text" name="email" placeholder="Search Email" />
								</form>
							</section>
					
						
						<!-- Copyright -->
							<div id="copyright">
								<p>
									&copy; <?php echo $site_name ?><br />
									
								</p>
							</div>

					</div>

			</div>

	</body>
</html>