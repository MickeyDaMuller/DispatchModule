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
		<title>Add Template</title>
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
										<span class="byline">Add to pool </span>
									</header>
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
 
  if(!isset($_REQUEST['tid']))
  die('No newsletter selected');
	
  	include('../link.inc.php');
	
	function check_pool($template_id)
	{
	$result = mysql_query("select pool_id from dispatch_pool where template_id = '$template_id'");
	if(!$result)
	die(mysql_error());
	if(mysql_num_rows($result) == 0)
	return false;
	else
	return true;
	}//end fn
	
	function get_template_title($template_id)
	{
	$result = mysql_query("select subject from dispatch_templates where template_id = $template_id");
	if(!$result)
	die(mysql_error());
	$record = mysql_fetch_assoc($result);
	return $record['subject'];
	}//end fn
	
	function get_newsletter_subscriptions()
	{
	$result = mysql_query("select newsletterId, newsletter_name from newsletters order by newsletter_name asc");
	if(!$result)
	die(mysql_error());
	return $result;
	}//end fn
	
	function add_newsletter($template_id, $target)
	{
	
	$result = mysql_query("insert into dispatch_pool (template_id, target) VALUES ('$template_id','$target') ON DUPLICATE KEY UPDATE status = status");
	if(!$result)
	die(mysql_error());
	
	}//end fn
	
	$success = 0;
	$template_id = $_REQUEST['tid'];
	$subject = get_template_title($template_id);
  
  if(isset($_POST['newsletters']))
  {
  $newsletters = $_POST['newsletters'];
  if(isset($_POST['selectControl']))
	  {
	  add_newsletter($template_id, "*");
		
		echo "Template ($subject) Queued to all subscribers "; 
	  }//end if
  else
	  {
	  add_newsletter($template_id, implode(",",$newsletters));
	  
	  echo "Template ($subject) Queued to subscribers ".implode(",",$newsletters); 
	 // echo "$subject, $message, $dispatch_date";
	  }//end else	 
	$success = 1; 
  }//end if
	
	
	if($success == 0)
	{
	$newsletter_subscriptions = get_newsletter_subscriptions();
 ?> 
 <form action="" id="poolForm" name="poolForm" method="post">
 <strong>Subject</strong>: <?php echo $subject ?><br>
<br>
 <input id="tid" name="tid" type="hidden" value="<?php echo $template_id ?>"/>
 <br>
 <strong>Send to subscribers</strong>:<br>
 <div width='20%' style='float:left'><input type="checkbox" id="selectControl" name="selectControl" /></div> &nbsp;&nbsp;Select All <br>
 <br>

 <?php 
 while($news_subs = mysql_fetch_assoc($newsletter_subscriptions) )
 {
 $newsletter_name = $news_subs['newsletter_name'];
 $newsletterId = $news_subs['newsletterId'];
 echo "<div width='20%' style='float:left'><input type='checkbox' name='newsletters[]' value='$newsletterId'></div> &nbsp;&nbsp;$newsletter_name<br>";
 }//end foreach
  ?>
 
 
 <br>

 
 <br>
 
 <input type="submit" name="Submit" value="Add to Pool">
 </form>
								
			<?php
			}//end if
			?>		
			<script>
    function Check(frm){
      var checkBoxes = frm.elements['newsletters[]'];
      for (i = 0; i < checkBoxes.length; i++){
        checkBoxes[i].checked = (selectControl.checked) ? 'checked' : '';
      }
     
    }
    
    window.onload = function(){
      var selectControl = document.getElementById("selectControl");
      selectControl.onclick = function(){Check(document.poolForm)};
    };
  </script>				
								</article>
						
							<!-- Post -->
								

							<!-- Pager -->
								

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
									<li class="current_page_item"><a href="newsletters.php">Archives</a></li>
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