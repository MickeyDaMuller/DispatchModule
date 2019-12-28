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
		<title>Send Test</title>
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
										<h2><a href="#">Global Youth Leaders Forum Dispatch Page </a></h2>
										<span class="byline">Send Test </span></header>
									<div class="info">
										<!--
											Note: The date should be formatted exactly as it's shown below. In particular, the
											"least significant" characters of the month should be encapsulated in a <span>
											element to denote what gets dropped in 1200px mode (eg. the "uary" in "January").
											Oh, and if you don't need a date for a particular page or post you can simply delete
											the entire "date" element.
											
										-->
										<span class="date"><span class="month"><?php echo date('m'); ?><span></span></span> <span class="day"><?php echo date('d'); ?></span><span class="year">, 2013</span></span>
										<!--
											Note: You can change the number of list items in "s(tats" to whatever you want.
										-->
										
									</div>
									
									
									
  
  <?php
 	if(!isset($_REQUEST['t']))
	die("Kindly select a <a href='newsletters.php'>Newsletter</a> to edit");
  
	
  	include('../link.inc.php');
	include('dispatch_functions.php');
 	require("../pmailer/class.phpmailer.php");
	
	function get_newsletter($template_id)
	{
	$result = mysql_query("select * from dispatch_templates where template_id = '$template_id'");
	if(!$result)
	die(mysql_error());
	$record = mysql_fetch_assoc($result);
	
	return $record;
	}//end fn
	
	function check_newsletter($subject)
	{
	$result = mysql_query("select subject from dispatch_templates where subject = '$subject'");
	if(!$result)
	die(mysql_error());
	if(mysql_num_rows($result) == 0)
	return false;
	else
	return true;
	}//end fn
	
	function edit_newsletter($subject, $message, $dispatch_date, $template_id)
	{
	$result = mysql_query("update dispatch_templates set subject = '$subject', message = '$message', dispatch_date = '$dispatch_date' where template_id = '$template_id'");
	if(!$result)
	die(mysql_error());
	}//end fn	
	
	$template_id = $_REQUEST['t'];
	$success = 0;
	$subject = "";
  	$message = "";
  	$dispatch_date = date('Y-m-d');
  
  if(isset($_REQUEST['subject']))
  {
  $template_record = get_newsletter($template_id);
	$subject = stripslashes($template_record['subject']);
  	$message = stripslashes($template_record['message']);
  	$dispatch_date = $template_record['date'];
	
  $email = $_POST['email'];
  // echo "$subject, $message, $dispatch_date";
  		$mail = new PHPMailer();
		$mail->IsSMTP();  // telling the class to use SMTP
		$mail->SMTPAuth = true;
		$mail->IsHTML(true);
		
		$mail->SetFrom('no-reply@globalyouthleadersforum.org', 'Global Youth Leaders Forum');
		$mail->Subject  = $subject; 
		if(check_email_address($email))
					{
					$mail->AddAddress($email);
					$mail->Body = $message.$extra;
					
							if(!$mail->Send()) {
							  echo 'Message was not sent.';
							  echo 'Mailer error: ' . $mail->ErrorInfo;
							}//end if 
							else {
							  echo 'Message has been sent. ';
							  $success = 1;
							  echo "<br><br>Newsletter sent: <br>$subject<br><br>$message";
							}//end else
							
					echo $email."<br>";
					}//end if
					else echo $email." (incorrect)<br>";
					
					$mail->ClearAddresses();
	 
  }//end if
	
	
	if($success == 0)
	{
	$template_record = get_newsletter($template_id);
	$subject = stripslashes($template_record['subject']);
  	$message = stripslashes($template_record['message']);
  	$dispatch_date = $template_record['date'];
 ?> 
 <form action="" id="template" name="template" method="post">
 
 <input id="subject" name="subject" type="hidden" value='<?php echo $subject ?>'/>
 <input id="t" name="t" type="hidden" value="<?php echo $template_id ?>"/>
 <br>

 
 <input id="message" name="message" type="hidden" value=""/>
 
 <br>
 Send test mail to email
 :<br>
 <input id="email" name="email" type="text" value=""/>
 <br />
 <br>
 
 <input type="submit" name="Submit" value="Submit">
 </form>
								
			<?php
			
			echo "<br><br>Newsletter: <br>$subject<br><br>$message";
			}//end if
			?>						
								</article>
						
							<!-- Post -->
								

							<!-- Pager -->
								

						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
					
						<!-- Logo -->
							<div id="logo">
								<h1>GLYF DP</h1>
							</div>
					
						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li ><a href="index.php">Latest Dispatch</a></li>
									<li class="current_page_item"><a href="newsletters.php">Archives</a></li>
									<li><a href="subscriptions.php">Subscriptions</a></li>
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
									&copy; 2018 Global Youth Leaders Forum<br />
									
								</p>
							</div>

					</div>

			</div>

	</body>
</html>