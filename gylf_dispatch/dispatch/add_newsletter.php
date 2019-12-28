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
		<title>Add Template</title>
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

<script src="tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
  tinymce.init({
    selector: '#message',  // note the comma at the end of the line!
  toolbar: 'addPersonal undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code paste'
  ,
  setup: function(editor) {
    editor.addButton('addPersonal', {
      type: 'menubutton',
      text: 'Mail Merge',
      icon: false,
      menu: [{
        text: 'Title',
        onclick: function() {
          editor.insertContent('&nbsp;|tl|&nbsp;');
        }
      }, {
        text: 'Firstname',
        onclick: function() {
          editor.insertContent('&nbsp;|f|&nbsp;');
        }
      }, {
        text: 'Lastname',
        onclick: function() {
          editor.insertContent('&nbsp;|l|&nbsp;');
        }
      }, {
        text: 'Email',
        onclick: function() {
          editor.insertContent('&nbsp;|e|&nbsp;');
        }
      }, {
        text: 'Country',
        onclick: function() {
          editor.insertContent('&nbsp;|cn|&nbsp;');
        }
      }, {
        text: 'Zone',
        onclick: function() {
          editor.insertContent('&nbsp;|z|&nbsp;');
        }
      }, {
        text: 'Region',
        onclick: function() {
          editor.insertContent('&nbsp;|r|&nbsp;');
        }
      }, {
        text: 'Designation',
        onclick: function() {
          editor.insertContent('&nbsp;|d|&nbsp;');
        }
      }, {
        text: 'Department',
        onclick: function() {
          editor.insertContent('&nbsp;|dp|&nbsp;');
        }
      }, {
        text: 'Rank',
        onclick: function() {
          editor.insertContent('&nbsp;|rk|&nbsp;');
        }
      }, {
        text: 'Office Location',
        onclick: function() {
          editor.insertContent('&nbsp;|ol|&nbsp;');
        }
      }]
    });
  },
  content_css: [
    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
    '//www.tinymce.com/css/codepen.min.css'
  ],
  plugins: ["advlist autolink lists link image charmap print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime media table contextmenu paste jbimages"],
  height : 300
  });
  
  

  </script>
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
										<h2><a href="#"><?php echo $site_short ?> Dispatch Page </a></h2>
										<span class="byline">Newsletter Templates </span>
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
 
  
	require_once('calendar/classes/tc_calendar.php');
  	
	
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
	
	function add_newsletter($subject, $message, $dispatch_date)
	{
	$date = date('Ymd');
	$result = mysql_query("insert into dispatch_templates (subject, message, dispatch_date, date) VALUES ('$subject','$message','$dispatch_date','$date')");
	if(!$result)
	die(mysql_error());
	
	}//end fn
	
	$success = 0;
	$subject = "";
  	$message = "";
  	$dispatch_date = date('Y-m-d');
  
  if(isset($_POST['subject']))
  {
  $subject = $_POST['subject'];
  $message = addslashes($_POST['message']);
  $dispatch_date = $_POST['dispatch_date'];

 // echo "$subject, $message, $dispatch_date";
  	 if(!$subject || !$message)
	 {
	 echo "Kindly fill all fields";
	 }//end if
	 else
	 {
		
		 add_newsletter($subject, $message, $dispatch_date);
		 $success = 1;
		 echo "Newsletter Added successfully <br><br><a href='newsletters.php'>View Newsletter templates</a>";
		
	 }//end else
	 
  }//end if
	
	
	if($success == 0)
	{
 ?> 
 <form action="" id="template" name="template" method="post">
 Sender name: <br>
 <input id="sender_name" name="sender_name" type="hidden" value="" placeholder=""/> 
<br>
 Subject: <br>
 <input id="subject" name="subject" type="text" value="<?php echo $subject ?>"/>
 <br>
 Message:<br>
 <textarea name="message" id="message"><?php echo $message ?></textarea>
 
 <br>
 Dispatch date:<br>
 <?php
					$date3_default = $dispatch_date; 
				  $myCalendar = new tc_calendar("dispatch_date", true, false);
				  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
				  $myCalendar->setDate(date('d', strtotime($date3_default))
						, date('m', strtotime($date3_default))
						, date('Y', strtotime($date3_default)));
				  $myCalendar->setPath("calendar/");
				  $myCalendar->setYearInterval(1900, 2019);
				  
				  $myCalendar->setDateFormat('j F Y');
				  $myCalendar->setAlignment('left', 'bottom');
				 
				  $myCalendar->writeScript();
				  ?><br />
 <br>
 
 <input type="submit" name="Submit" value="Submit">
 </form>
								
			<?php
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
								<h1><?php echo $site_short ?></h1>
							</div>
					
						<!-- Nav -->
							<?php require("nav.php"); ?>

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
									&copy; <?php echo $site_short ?><br />
									
								</p>
							</div>

					</div>

			</div>

	</body>
</html>