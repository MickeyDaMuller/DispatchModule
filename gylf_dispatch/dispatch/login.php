<?php
$message = "";
if(isset($_POST['submit']))
{
	if($_POST['username'] != "")
	{
		if($_POST['password'] != "")
		{
			if($_POST['username'] == "admin1")
			{
				if($_POST['password'] == "subscr1bers")
				{
					session_start();
					$_SESSION['login_webservice'] = "yes";
					header("Location: index.php");
				}
				else
					$message = "Incorrect password specified";
			}
			else
				$message = "Incorrect Username specified";
		}
		else
		{
			$message = "Please fill in password field";	
		}
	}
	else
	{
		$message = "Please fill in username field";	
	}
}
?>
<!DOCTYPE HTML>
<!--
	Striped 2.5 by HTML5 Up!
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Dispatch Page</title>
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
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
		<!--[if lte IE 7]><link rel="stylesheet" href="css/ie7.css" /><![endif]-->
	<style type="text/css">
<!--
@import url("style.css");
-->
</style>
	</head>
	<!--
		Note: Set the body element's class to "left-sidebar" to position the sidebar on the left.
		Set it to "right-sidebar" to, you guessed it, position it on the right.
	-->
	<body class="left-sidebar">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Content -->
					<div id="content">
						<div id="content-inner">
					
							<!-- Post -->
								<article class="is-post is-post-excerpt">
									<header>
										<!--
											Note: Titles and bylines will wrap automatically when necessary, so don't worry
											if they get too long. You can also remove the "byline" span entirely if you don't
											need a byline.
										-->
										<h2><a href="#">GYLF Dispatch Page </a></h2>
										<span class="byline">Login </span>
									</header>
									<div class="info">
										<!--
											Note: The date should be formatted exactly as it's shown below. In particular, the
											"least significant" characters of the month should be encapsulated in a <span>
											element to denote what gets dropped in 1200px mode (eg. the "uary" in "January").
											Oh, and if you don't need a date for a particular page or post you can simply delete
											the entire "date" element.
											
										-->
										<span class="date"><span class="month"><?php echo date('d'); ?><span></span></span> <span class="day"><?php echo date('M'); ?></span><span class="year">, <?php echo date('Y'); ?></span></span>
										<!--
											Note: You can change the number of list items in "s(tats" to whatever you want.
										-->
										
									</div>
									
									
									
									<div class="license-form">
									<?php echo $message ?>
<form method="post" action="">
Username:<br />
<input name="username" type="text" id="username" size="30" /><br />
Password<br />
<input name="password" type="password" id="password" size="30"  /><br /><br />
<input type="submit" name="submit" id="submit" value="Login"  />
</form>
									
									</div>
									
								</article>
						
							<!-- Post -->
								

							<!-- Pager -->
								

						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
					
						<!-- Logo -->
							<div id="logo">
								<h1>GYLF DP</h1>
							</div>
					
						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li class="current_page_item"><a href="index.php">Home</a></li>
									
								</ul>
							</nav>

						<!-- Search -->
							<section class="is-search">
								<form method="post" action="search.php">
									<input type="text" class="text" name="search" placeholder="Search" />
								</form>
							</section>
					
						
					
						<!-- Recent Posts -->
							
					
						<!-- Recent Comments -->
							
					
						<!-- Calendar -->
							
						
						<!-- Copyright -->
							<div id="copyright">
								<p>
									&copy; <?php echo date('Y'); ?> GYLF <br />
									
								</p>
							</div>

					</div>

			</div>

	</body>
</html>