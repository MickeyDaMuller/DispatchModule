<?php
session_start();
if(!isset($_SESSION['login_webservice']))
	{
		header("Location: login.php");	
	}
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Edit Subscriber</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700|Open+Sans+Condensed:300,700" rel="stylesheet" />
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
<script language="javascript" src="calendar/calendar.js"></script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
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
										<!--
											Note: Titles and bylines will wrap automatically when necessary, so don't worry
											if they get too long. You can also remove the "byline" span entirely if you don't
											need a byline.
										-->
										<h2><a href="#">Healing School Dispatch Page </a></h2>
										<span class="byline">Edit Subscriber </span>
									</header>
									<div class="info">
										
										<span class="date"><span class="month"><?php echo date('m'); ?><span></span></span> <span class="day"><?php echo date('d'); ?></span><span class="year">, 2013</span></span>
										<!--
											Note: You can change the number of list items in "s(tats" to whatever you want.
										-->
										
									</div>
									
									
									
  
  <?php
 	if(!isset($_REQUEST['s']))
	die("Kindly select a <a href='subscribers.php'>Subscriber</a> to edit");
  
  	include('../link.inc.php');
	
	function get_subscriber($list_Id)
	{
	$result = mysql_query("select * from contacts where list_Id = '$list_Id'");
	if(!$result)
	die(mysql_error());
	$record = mysql_fetch_assoc($result);
	
	return $record;
	}//end fn
	
	
	
	function edit_subscriber($title, $firstname, $lastname, $email, $phone, $country, $unsubscribe, $list_Id)
	{
	$result = mysql_query("update contacts set title = '$title', firstname = '$firstname', lastname = '$lastname', email = '$email', phone = '$phone', country = '$country', unsubscribe = '$unsubscribe' where list_Id = $list_Id");
	if(!$result)
	die(mysql_error());
	}//end fn	
	
	$list_Id = $_REQUEST['s'];
	$success = 0;
	$title = "";
	$firstname = "";
	$lastname = "";
	$email = "";
	$phone = "";
	$country = "";
	$unsubscribe = "";
  	
  
  if(isset($_REQUEST['title']))
  {
  $title = $_REQUEST['title'];
	$firstname = $_REQUEST['firstname'];
	$lastname = $_REQUEST['lastname'];
	$email = $_REQUEST['email'];
	$phone = $_REQUEST['phone'];
	$country = $_REQUEST['country'];
	$unsubscribe = $_REQUEST['unsubscribe'];
  
 // echo "$subject, $message, $dispatch_date";
  	 if(!$email)
	 {
	 echo "Email field should not be left blank";
	 }//end if
	 else
	 {
		 
		 edit_subscriber($title, $firstname, $lastname, $email, $phone, $country, $unsubscribe, $list_Id);
		 $success = 1;
		 echo "Subscriber edited successfully <br><br><a href='subscribers.php'>View Subscribers</a>";
		 
	 }//end else
	 
  }//end if
	
	
	if($success == 0)
	{
	$list_rec = get_subscriber($list_Id);
	$title = $list_rec['title'];
	$firstname = $list_rec['firstname'];
	$lastname = $list_rec['lastname'];
	$email = $list_rec['email'];
	$phone = $list_rec['phone'];
	$country = $list_rec['country'];
	$unsubscribe = $list_rec['unsubscribe'];
 ?> 
 <form action="" id="template" name="template" method="post">
 Title: <br>
 <input id="title" name="title" type="text" value="<?php echo $title ?>"/>
 <br>
	Firstname: <br>
 <input id="firstname" name="firstname" type="text" value="<?php echo $firstname ?>"/>
 <br>
 Lastname: <br>
 <input id="lastname" name="lastname" type="text" value="<?php echo $lastname ?>"/>
 <br>
 Email: <br>
 <input id="email" name="email" type="text" value="<?php echo $email ?>"/>
 <br>
 Phone: <br>
 <input id="phone" name="phone" type="text" value="<?php echo $phone ?>"/>
 <br>
 Country: <br>
 <input id="country" name="country" type="text" value="<?php echo $country ?>"/>
 
  <input id="s" name="s" type="hidden" value="<?php echo $list_Id ?>"/>
 <br>
 Option
 <select name="unsubscribe" id="unsubscribe">
   <option value="0" <?php echo ($unsubscribe == 0)?'selected':'' ?>>Subscribe</option>
   <option value="1" <?php echo ($unsubscribe == 1)?'selected':'' ?>>Unsubscribe</option>
   <option value="2" <?php echo ($unsubscribe == 2)?'selected':'' ?>>Wrong Email</option>
 </select>
 <br>
<br>

 <input type="submit" name="Submit" value="Submit">
 </form>
								
			<?php
			}//end if
			?>						
								</article>
						
						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
					
						<!-- Logo -->
							<div id="logo">
								<h1>HS DP</h1>
							</div>
					
						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li ><a href="index.php">Latest Dispatch</a></li>
									<li><a href="newsletters.php">Archives</a></li>
									<li><a href="subscriptions.php">Subscriptions</a></li>
									<li class="current_page_item"><a href="subscribers.php">Subscribers</a></li>
									<li><a href="logout.php">Logout</a></li>
								</ul>
							</nav>

						<!-- Search -->
							<section class="is-search">
								<form method="post" action="#">
									<input type="text" class="text" name="search" placeholder="Search" />
								</form>
							</section>
					
						
					
						<!-- Recent Posts -->
							
					
						<!-- Recent Comments -->
							
					
						<!-- Calendar -->
							
						
						<!-- Copyright -->
							<div id="copyright">
								<p>
									&copy; 2014 Healing School<br />
									
								</p>
							</div>

					</div>

			</div>

	</body>
</html>